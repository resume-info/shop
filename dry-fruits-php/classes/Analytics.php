<?php
namespace App;

use MongoDB\BSON\ObjectId;

class Analytics {
    private $db;
    private $collection = 'analytics';
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function recordVisit() {
        $today = date('Y-m-d');
        
        // Get or create analytics document
        $analytics = $this->getAnalyticsData();
        
        if (!$analytics) {
            // Create new analytics document
            $analyticsData = [
                'totalVisits' => 1,
                'uniqueVisitors' => 1,
                'totalSales' => 0,
                'totalRevenue' => 0,
                'dailyVisits' => [
                    [
                        'date' => $today,
                        'count' => 1
                    ]
                ]
            ];
            
            $this->db->insertOne($this->collection, $analyticsData);
        } else {
            // Update existing analytics document
            $id = $analytics->_id;
            
            // Increment total visits
            $updateData = [
                'totalVisits' => $analytics->totalVisits + 1,
            ];
            
            // Update or add daily visit
            $dailyVisitFound = false;
            
            if (isset($analytics->dailyVisits)) {
                foreach ($analytics->dailyVisits as $key => $visit) {
                    if ($visit->date === $today) {
                        $updateData['dailyVisits.' . $key . '.count'] = $visit->count + 1;
                        $dailyVisitFound = true;
                        break;
                    }
                }
            }
            
            if (!$dailyVisitFound) {
                $dailyVisits = isset($analytics->dailyVisits) ? (array) $analytics->dailyVisits : [];
                $dailyVisits[] = [
                    'date' => $today,
                    'count' => 1
                ];
                $updateData['dailyVisits'] = $dailyVisits;
            }
            
            $this->db->updateOne($this->collection, ['_id' => $id], $updateData);
        }
    }
    
    public function recordProductView($productId) {
        $productId = (string) $productId;
        
        // Get or create analytics document
        $analytics = $this->getAnalyticsData();
        
        if (!$analytics) {
            // Create new analytics document with product view
            $analyticsData = [
                'totalVisits' => 0,
                'uniqueVisitors' => 0,
                'totalSales' => 0,
                'totalRevenue' => 0,
                'productViews' => [
                    $productId => 1
                ]
            ];
            
            $this->db->insertOne($this->collection, $analyticsData);
        } else {
            // Update existing analytics document
            $id = $analytics->_id;
            
            $productViews = isset($analytics->productViews) ? (array) $analytics->productViews : [];
            
            if (isset($productViews[$productId])) {
                $productViews[$productId]++;
            } else {
                $productViews[$productId] = 1;
            }
            
            $this->db->updateOne(
                $this->collection, 
                ['_id' => $id], 
                ['productViews' => $productViews]
            );
        }
    }
    
    public function recordSale($orderId, $amount) {
        // Get or create analytics document
        $analytics = $this->getAnalyticsData();
        
        if (!$analytics) {
            // Create new analytics document with sale
            $analyticsData = [
                'totalVisits' => 0,
                'uniqueVisitors' => 0,
                'totalSales' => 1,
                'totalRevenue' => $amount,
                'dailySales' => [
                    [
                        'date' => date('Y-m-d'),
                        'count' => 1,
                        'revenue' => $amount
                    ]
                ]
            ];
            
            $this->db->insertOne($this->collection, $analyticsData);
        } else {
            // Update existing analytics document
            $id = $analytics->_id;
            
            $totalSales = isset($analytics->totalSales) ? $analytics->totalSales + 1 : 1;
            $totalRevenue = isset($analytics->totalRevenue) ? $analytics->totalRevenue + $amount : $amount;
            
            $updateData = [
                'totalSales' => $totalSales,
                'totalRevenue' => $totalRevenue
            ];
            
            // Update or add daily sales
            $today = date('Y-m-d');
            $dailySaleFound = false;
            
            if (isset($analytics->dailySales)) {
                foreach ($analytics->dailySales as $key => $sale) {
                    if ($sale->date === $today) {
                        $updateData['dailySales.' . $key . '.count'] = $sale->count + 1;
                        $updateData['dailySales.' . $key . '.revenue'] = $sale->revenue + $amount;
                        $dailySaleFound = true;
                        break;
                    }
                }
            }
            
            if (!$dailySaleFound) {
                $dailySales = isset($analytics->dailySales) ? (array) $analytics->dailySales : [];
                $dailySales[] = [
                    'date' => $today,
                    'count' => 1,
                    'revenue' => $amount
                ];
                $updateData['dailySales'] = $dailySales;
            }
            
            $this->db->updateOne($this->collection, ['_id' => $id], $updateData);
        }
    }
    
    public function getAnalyticsData() {
        // Get the first analytics document (we only have one)
        $result = $this->db->find($this->collection, [], ['limit' => 1]);
        
        if (empty($result)) {
            return null;
        }
        
        return $result[0];
    }
    
    public function getProductViewsData() {
        $analytics = $this->getAnalyticsData();
        
        if (!$analytics || !isset($analytics->productViews)) {
            return [];
        }
        
        $productViews = (array) $analytics->productViews;
        arsort($productViews); // Sort by views (descending)
        
        return $productViews;
    }
    
    public function getTopProducts($limit = 5) {
        $productViews = $this->getProductViewsData();
        
        $topProducts = [];
        $count = 0;
        
        foreach ($productViews as $productId => $views) {
            if ($count >= $limit) {
                break;
            }
            
            $product = (new Product())->getProductById($productId);
            
            if ($product) {
                $topProducts[] = [
                    'product' => $product,
                    'views' => $views
                ];
                
                $count++;
            }
        }
        
        return $topProducts;
    }
    
    public function getDailyVisitsData($days = 30) {
        $analytics = $this->getAnalyticsData();
        
        if (!$analytics || !isset($analytics->dailyVisits)) {
            return [];
        }
        
        $dailyVisits = (array) $analytics->dailyVisits;
        
        // Sort by date
        usort($dailyVisits, function ($a, $b) {
            return strtotime($a->date) - strtotime($b->date);
        });
        
        // Get last N days
        if (count($dailyVisits) > $days) {
            $dailyVisits = array_slice($dailyVisits, -$days);
        }
        
        return $dailyVisits;
    }
    
    public function getDailySalesData($days = 30) {
        $analytics = $this->getAnalyticsData();
        
        if (!$analytics || !isset($analytics->dailySales)) {
            return [];
        }
        
        $dailySales = (array) $analytics->dailySales;
        
        // Sort by date
        usort($dailySales, function ($a, $b) {
            return strtotime($a->date) - strtotime($b->date);
        });
        
        // Get last N days
        if (count($dailySales) > $days) {
            $dailySales = array_slice($dailySales, -$days);
        }
        
        return $dailySales;
    }
} 
<?php
namespace App;

use MongoDB\BSON\ObjectId;

class Order {
    private $db;
    private $collection = 'orders';
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getOrderById($id) {
        return $this->db->findOne($this->collection, ['_id' => new ObjectId($id)]);
    }
    
    public function getOrdersByUserId($userId) {
        return $this->db->find($this->collection, ['userId' => new ObjectId($userId)], [
            'sort' => ['createdAt' => -1]
        ]);
    }
    
    public function getAllOrders() {
        return $this->db->find($this->collection, [], [
            'sort' => ['createdAt' => -1]
        ]);
    }
    
    public function createOrder($data) {
        $data['createdAt'] = new \MongoDB\BSON\UTCDateTime();
        $data['updatedAt'] = new \MongoDB\BSON\UTCDateTime();
        
        // Set default status if not present
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }
        
        // Calculate total price
        $totalPrice = 0;
        foreach ($data['items'] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        $data['totalPrice'] = $totalPrice;
        
        return $this->db->insertOne($this->collection, $data);
    }
    
    public function updateOrderStatus($id, $status) {
        $data = [
            'status' => $status,
            'updatedAt' => new \MongoDB\BSON\UTCDateTime()
        ];
        
        return $this->db->updateOne(
            $this->collection, 
            ['_id' => new ObjectId($id)], 
            $data
        );
    }
    
    public function getOrderStats() {
        $result = $this->db->aggregation($this->collection, [
            [
                '$group' => [
                    '_id' => null,
                    'totalOrders' => ['$sum' => 1],
                    'totalRevenue' => ['$sum' => '$totalPrice'],
                    'averageOrderValue' => ['$avg' => '$totalPrice']
                ]
            ]
        ]);
        
        if (empty($result)) {
            return [
                'totalOrders' => 0,
                'totalRevenue' => 0,
                'averageOrderValue' => 0
            ];
        }
        
        return $result[0];
    }
    
    public function getOrdersByStatus($status) {
        return $this->db->find($this->collection, ['status' => $status], [
            'sort' => ['createdAt' => -1]
        ]);
    }
    
    public function getOrdersByDate($startDate, $endDate) {
        $start = new \MongoDB\BSON\UTCDateTime(strtotime($startDate) * 1000);
        $end = new \MongoDB\BSON\UTCDateTime(strtotime($endDate) * 1000);
        
        return $this->db->find($this->collection, [
            'createdAt' => [
                '$gte' => $start,
                '$lte' => $end
            ]
        ], [
            'sort' => ['createdAt' => -1]
        ]);
    }
    
    public function getMonthlySales() {
        $result = $this->db->aggregation($this->collection, [
            [
                '$group' => [
                    '_id' => [
                        'year' => ['$year' => '$createdAt'],
                        'month' => ['$month' => '$createdAt']
                    ],
                    'orders' => ['$sum' => 1],
                    'revenue' => ['$sum' => '$totalPrice']
                ]
            ],
            [
                '$sort' => [
                    '_id.year' => 1,
                    '_id.month' => 1
                ]
            ]
        ]);
        
        return $result;
    }
} 
<?php
namespace App;

use MongoDB\BSON\ObjectId;

class Product {
    private $db;
    private $collection = 'products';
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAllProducts($options = []) {
        return $this->db->find($this->collection, [], $options);
    }
    
    public function getFeaturedProducts($limit = 6) {
        return $this->db->find($this->collection, ['featured' => true], [
            'limit' => $limit,
            'sort' => ['createdAt' => -1]
        ]);
    }
    
    public function getProductById($id) {
        return $this->db->findOne($this->collection, ['_id' => new ObjectId($id)]);
    }
    
    public function getProductsByCategory($category, $limit = 12) {
        return $this->db->find($this->collection, ['category' => $category], [
            'limit' => $limit,
            'sort' => ['createdAt' => -1]
        ]);
    }
    
    public function searchProducts($query) {
        return $this->db->find($this->collection, [
            '$or' => [
                ['name' => ['$regex' => $query, '$options' => 'i']],
                ['description' => ['$regex' => $query, '$options' => 'i']],
                ['category' => ['$regex' => $query, '$options' => 'i']]
            ]
        ]);
    }
    
    public function createProduct($data) {
        $data['createdAt'] = new \MongoDB\BSON\UTCDateTime();
        $data['updatedAt'] = new \MongoDB\BSON\UTCDateTime();
        
        return $this->db->insertOne($this->collection, $data);
    }
    
    public function updateProduct($id, $data) {
        $data['updatedAt'] = new \MongoDB\BSON\UTCDateTime();
        
        return $this->db->updateOne(
            $this->collection, 
            ['_id' => new ObjectId($id)], 
            $data
        );
    }
    
    public function deleteProduct($id) {
        return $this->db->deleteOne($this->collection, ['_id' => new ObjectId($id)]);
    }
    
    public function getProductCategories() {
        $result = $this->db->aggregation($this->collection, [
            ['$group' => ['_id' => '$category']],
            ['$sort' => ['_id' => 1]]
        ]);
        
        $categories = [];
        foreach ($result as $item) {
            $categories[] = $item->_id;
        }
        
        return $categories;
    }
} 
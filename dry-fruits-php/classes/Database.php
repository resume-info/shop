<?php
namespace App;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\BSON\ObjectId;

class Database {
    private static $instance = null;
    private $client;
    private $db;
    
    private function __construct() {
        $env = require_once __DIR__ . '/../config/env.php';
        
        // Create MongoDB client
        $this->client = new Client($env['mongodb_uri']);
        $this->db = $this->client->{$env['mongodb_database']};
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    public function getCollection($collectionName) {
        return $this->db->$collectionName;
    }
    
    public function insertOne($collectionName, $document) {
        try {
            $collection = $this->getCollection($collectionName);
            $result = $collection->insertOne($document);
            return $result->getInsertedId();
        } catch (\Exception $e) {
            error_log("Error inserting document: " . $e->getMessage());
            return false;
        }
    }
    
    public function find($collectionName, $filter = [], $options = []) {
        try {
            $collection = $this->getCollection($collectionName);
            return $collection->find($filter, $options)->toArray();
        } catch (\Exception $e) {
            error_log("Error finding documents: " . $e->getMessage());
            return [];
        }
    }
    
    public function findOne($collectionName, $filter = []) {
        try {
            $collection = $this->getCollection($collectionName);
            return $collection->findOne($filter);
        } catch (\Exception $e) {
            error_log("Error finding document: " . $e->getMessage());
            return null;
        }
    }
    
    public function updateOne($collectionName, $filter, $update) {
        try {
            $collection = $this->getCollection($collectionName);
            $result = $collection->updateOne($filter, ['$set' => $update]);
            return $result->getModifiedCount();
        } catch (\Exception $e) {
            error_log("Error updating document: " . $e->getMessage());
            return false;
        }
    }
    
    public function deleteOne($collectionName, $filter) {
        try {
            $collection = $this->getCollection($collectionName);
            $result = $collection->deleteOne($filter);
            return $result->getDeletedCount();
        } catch (\Exception $e) {
            error_log("Error deleting document: " . $e->getMessage());
            return false;
        }
    }
    
    public function aggregation($collectionName, $pipeline) {
        try {
            $collection = $this->getCollection($collectionName);
            return $collection->aggregate($pipeline)->toArray();
        } catch (\Exception $e) {
            error_log("Error executing aggregation: " . $e->getMessage());
            return [];
        }
    }
} 
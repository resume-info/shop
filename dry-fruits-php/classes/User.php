<?php
namespace App;

use MongoDB\BSON\ObjectId;

class User {
    private $db;
    private $collection = 'users';
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getUserById($id) {
        return $this->db->findOne($this->collection, ['_id' => new ObjectId($id)]);
    }
    
    public function getUserByEmail($email) {
        return $this->db->findOne($this->collection, ['email' => $email]);
    }
    
    public function createUser($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Set default role if not present
        if (!isset($data['role'])) {
            $data['role'] = 'customer';
        }
        
        $data['createdAt'] = new \MongoDB\BSON\UTCDateTime();
        $data['updatedAt'] = new \MongoDB\BSON\UTCDateTime();
        
        return $this->db->insertOne($this->collection, $data);
    }
    
    public function updateUser($id, $data) {
        // Hash password if it's being updated
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $data['updatedAt'] = new \MongoDB\BSON\UTCDateTime();
        
        return $this->db->updateOne(
            $this->collection, 
            ['_id' => new ObjectId($id)], 
            $data
        );
    }
    
    public function deleteUser($id) {
        return $this->db->deleteOne($this->collection, ['_id' => new ObjectId($id)]);
    }
    
    public function authenticate($email, $password) {
        $user = $this->getUserByEmail($email);
        
        if (!$user) {
            return false;
        }
        
        if (password_verify($password, $user->password)) {
            // Start session and store user info
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $_SESSION['user_id'] = (string) $user->_id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_role'] = $user->role;
            
            return true;
        }
        
        return false;
    }
    
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Unset all session values
        $_SESSION = [];
        
        // Destroy the session
        session_destroy();
        
        return true;
    }
    
    public function isAdmin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
    
    public function isLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user_id']);
    }
    
    public function getAllUsers() {
        return $this->db->find($this->collection, []);
    }
    
    public function createAdminUser() {
        $env = require_once __DIR__ . '/../config/env.php';
        
        // Check if admin user already exists
        $admin = $this->db->findOne($this->collection, ['role' => 'admin']);
        if ($admin) {
            return false; // Admin already exists
        }
        
        // Create admin user
        $adminData = [
            'name' => 'Administrator',
            'email' => $env['admin_email'],
            'password' => $env['admin_password'],
            'role' => 'admin'
        ];
        
        return $this->createUser($adminData);
    }
} 
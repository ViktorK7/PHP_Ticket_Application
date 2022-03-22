<?php
    session_start(); 
    class Database {
        private $db;

        function __construct() {
            $this->connect_database();
        }
    
        public function getInstance() {
            return $this->db;
        }

        public function login($email, $password) {
            $stmt = $this->db->prepare('Select * from users where email = "' . $email . '"'); 
            $stmt->execute();
            if (empty($user = reset($stmt->fetchAll()))) {
                return false;
            }

            if(!isset($user['password']) || $user['password'] !== $password) {
                return false;
            }

            return isset($user['id']) ? $user['id'] : false;
        }

        public function getFullName($id) {
            $stmt = $this->db->prepare('Select * from users where id = ' . $id); 
            $stmt->execute();
            $user = reset($stmt->fetchAll());
            return $user['first_name'] . ' ' . $user['last_name'];
        }

        public function getTicketCredentials($id) {
            $stmt = $this->db->prepare('Select * from tickets where id = ' . $id);
            $stmt->execute();
            $ticket = reset($stmt->fetchAll());
            return $ticket;
        }

        public function getTickets($workPosition) {
            if (!$workPosition) {
                $stmt = $this->db->prepare('Select * from tickets'); 
            } else {
                $stmt = $this->db->prepare('Select * from tickets where type = "' . $workPosition . '"'); 
            }
            
            $stmt->execute();
            if (empty($tickets = $stmt->fetchAll())) {
                return null;
            }

            return $tickets;
        }

        public function deleteTicket($id) {
            $stmt = $this->db->prepare('Delete from tickets where id = ' . $id);
            $stmt->execute();
        } 
        
        public function getComments($ticketId) {
            $stmt = $this->db->prepare('Select * from comments where ticketId = "' . $ticketId . '"');
            $stmt->execute();
            if (empty($comments = $stmt->fetchAll())) {
                return null;
            }

            return $comments;
        }

        public function getCommentCredentials($id) {
            $stmt = $this->db->prepare('Select * from comments where id = ' . $id);
            $stmt->execute();
            $ticket = reset($stmt->fetchAll());
            return $ticket;
        }

        public function deleteComment($id){
            $stmt = $this->db->prepare('Delete from comments where id = ' . $id);
            $stmt->execute();
        }

        public function checkIsSupport($id) {
            $stmt = $this->db->prepare('Select * from users where id = ' . $id); 
            $stmt->execute();

            if (empty($user = reset($stmt->fetchAll()))) {
                return false;
            }

            if ($user['work_position'] == 'officeSupport' || $user['work_position'] == 'technicalSupport') {
                return $user['work_position'];
            } else {
                return null;
            }
        }

       
    
        private function connect_database() {
            $servername = "mysql57";
            $username = "root";
            $password = "root";
            $dbname = "proxsoft_db";

            // Database connection
            try {
                $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
                $this->db = new PDO($dsn, $username, $password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo 'Database connection established';
            }
            catch(PDOException $e) {
                $this->db = null;
            }
        }   
    }
?>
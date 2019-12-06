<?php

    class Administrator
    {
        public $name;
        public $username;
        public $password;
        private $conn;


        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function readAdmin($username, $password)
        {
            $query = "SELECT * FROM administrator WHERE username = '$username' and password = '$password'";
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }

    }

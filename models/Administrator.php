<?php

    class Administrator
    {
        public $name;
        public $username;
        public $password;
        private $conn;

        //constructor
        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        //this method reads the username and password given from the user and returns the row from the database if found
        public function readAdmin($username, $password)
        {
            //query to select the row if admin exists
            $query = "SELECT * FROM administrator WHERE username = '$username' and password = '$password'";
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }
    }

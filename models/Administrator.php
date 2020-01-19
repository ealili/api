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

        public function readAllAdmins()
        {
            //query to select the row if admin exists
            $query = "SELECT * FROM administrator ";
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }

        public function remove($username)
        {
            //query to delete admin
            $query = "DELETE FROM administrator WHERE username = \"" . $username . "\" ;";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function create()
        {
            // Create query
            $query = 'INSERT INTO administrator SET name = :name, username = :username, password = :password';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

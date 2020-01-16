<?php

    class Manufacturer
    {

        public $headquarters;
        public $mname;
        private $conn;
        private $table = "manufacturer";


        // constructor with DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Get Manufacturer names
        public function readManufacturerNames()
        {

            $query = "SELECT mname from manufacturer";
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Create manufacturer
        public function create()
        {
            // Create Query
            $query = "INSERT INTO " . $this->table ."SET headquarters = :headquarters, mname = :mname";

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->mname = htmlspecialchars(strip_tags($this->mname));
            $this->headquarters = htmlspecialchars(strip_tags($this->headquarters));

            // Bind data
            $stmt->bindParam(':mname', $this->mname);
            $stmt->bindParam(':headquarters', $this->headquarters);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: \n", $stmt->error);

            return false;
        }
    }
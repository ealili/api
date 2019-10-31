<?php

    class Manufacturer
    {

        public $headquarters;
        public $mname;
        private $conn;


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
    }
<?php

    class Phone
    {

        public $id;
        public $display_id;
        public $camera_id;

        // Properties
        public $mname;
        public $name;
        public $techonology;
        public $weight;
        public $sound;
        public $os;
        public $battery;
        public $imgSource;
        public $displayType;
        public $displayResolution;
        public $displaySize;
        public $selfieCamera;
        public $mainCamera;
        private $conn;


        // constructor with DB

        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Get Phones
        public function read()
        {

            $query = "SELECT * FROM Phone p, Display d, Camera c " .
                "WHERE p.display_id = d.display_id " .
                "AND p.camera_id = c.camera_id";
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }


        // Get single type company
        public function read_single($phoneMname)
        {
            $query = "SELECT * FROM Phone p, Display d, Camera c " .
                "WHERE p.display_id = d.display_id " .
                "AND p.camera_id = c.camera_id AND mname = \"" . $phoneMname . "\";";
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

    }
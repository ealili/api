<?php

    class Phone
    {
        public $id;
        public $mname;
        public $name;
        public $technology;
        public $weight;
        public $sound;
        public $os;
        public $battery;
        public $imgSource;
        public $displayType;
        public $displayResolution;
        public $displaySize;
        public $productionYear;
        public $selfieCamera;
        public $mainCamera;
        private $conn;



        // constructor with DB

        public function __construct($db)
        {
            $this->conn = $db;
        }

        // read all phones
        public function readAll()
        {
            $query = "SELECT * FROM phone";
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }

        // read latest phones
        public function readLatestPhones()
        {
            $query = "SELECT * FROM phone WHERE productionYear = 2019 ";
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }

        // read single phone
        public function readSinglePhone($id)
        {

            $query = "SELECT * FROM phone WHERE id = \"" . $id . "\";";
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }


        // read company phones
        public function getCompanyPhones($mname)
        {
            {
                $query = "SELECT * FROM phone WHERE mname = \"" . $mname . "\" ORDER BY productionYear DESC ;";
                // Prepare statement
                $stmt = $this->conn->prepare($query);
                // Execute query
                $stmt->execute();
                return $stmt;
            }
        }

        // Create Phone
        public function create()
        {
            // Create query
            $query = 'INSERT INTO phone SET id = 
            :id, displayType = :displayType, 
            displaySize = :displaySize, selfieCamera = :selfieCamera, displayResolution = :displayResolution, mainCamera = :mainCamera,
            mname = :mname, name = :name, technology = :technology, weight = :weight, sound = :sound, 
            os = :os, productionYear = :productionYear, battery = :battery, imgSource = :imgSource';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->displayType = htmlspecialchars(strip_tags($this->displayType));
            $this->displayResolution = htmlspecialchars(strip_tags($this->displayResolution));
            $this->displaySize = htmlspecialchars(strip_tags($this->displaySize));
            $this->selfieCamera = htmlspecialchars(strip_tags($this->selfieCamera));
            $this->mainCamera = htmlspecialchars(strip_tags($this->mainCamera));
            $this->mname = htmlspecialchars(strip_tags($this->mname));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->technology = htmlspecialchars(strip_tags($this->technology));
            $this->weight = htmlspecialchars(strip_tags($this->weight));
            $this->sound = htmlspecialchars(strip_tags($this->sound));
            $this->os = htmlspecialchars(strip_tags($this->os));
            $this->productionYear = htmlspecialchars(strip_tags($this->productionYear));
            $this->battery = htmlspecialchars(strip_tags($this->battery));
            $this->imgSource = htmlspecialchars(strip_tags($this->imgSource));


            // Bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':displayType', $this->displayType);
            $stmt->bindParam(':displayResolution', $this->displayResolution);
            $stmt->bindParam(':displaySize', $this->displaySize);
            $stmt->bindParam(':selfieCamera', $this->selfieCamera);
            $stmt->bindParam(':mainCamera', $this->mainCamera);
            $stmt->bindParam(':mname', $this->mname);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':technology', $this->technology);
            $stmt->bindParam(':weight', $this->weight);
            $stmt->bindParam(':sound', $this->sound);
            $stmt->bindParam(':os', $this->os);
            $stmt->bindParam(':productionYear', $this->productionYear);
            $stmt->bindParam(':battery', $this->battery);
            $stmt->bindParam(':imgSource', $this->imgSource);

            // Execute query
            if ($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
<?php

    class Dao{

        private $db = "FraudCoinDB";
        private $user = "root";
        private $password = $_ENV["DB_PASSWORD"];
        private $host = "localhost";

        public function getConnection(){
            return new PDO("mysql:host={$this->host};dbname={$this->db}",
            $this->user, $this->password);
        }

        public function getCoinSummary(){
            $connection = $this->getConnection();
            return $connection->query("SELECT * from coin_history WHERE change_time")->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>
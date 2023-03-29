<?php

    class Dao{

        private $db = "FraudCoinDB";
        private $user = "root";
        private $host = "localhost";

        public function getConnection(){
            return new PDO("mysql:host={$this->host};dbname={$this->db}",
            $this->user, getenv("DB_PASSWORD"));
        }

        public function getCoinSummary(){
            $connection = $this->getConnection();
            return $connection->query("SELECT * from coin_history WHERE change_time")->fetchAll(PDO::FETCH_ASSOC);
        }
    }


?>
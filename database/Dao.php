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
            return $connection->query("SELECT * 
            from coin_history 
            WHERE DAY(change_time) = DAY(NOW())
            ORDER BY change_time DESC
            GROUP BY coin_id")->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCurrentCoinValues(){
            $connection = $this->getConnection();
            return $connection->query(
                "SELECT * FROM coin"
                )->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUserLeaderboard(){

        }

        public function getCoinLeaderboard(){

        }

        public function getHomeSummary(){

        }

        public function getUserHistory(){

        }

        public function getUserWallet(){
            //
        }

        public function getLoginInformation(){
            //Need to take in username
        }

        public function createNewUser($user_name, $user_password, $user_email, $user_birthday){
            //insert into users (username, password, email, birthday, cash, rank)
            $connection = $this->getConnection();
            $ranks = $connection->query("SELECT rank FROM users DESC LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
            $nextRank = $ranks[0]+1;
            $createUser = "INSERT INTO users (user_name, user_password, user_email, user_birthday, user_cash, user_rank) 
            VALUES (:user_name, :user_password, :user_email, :user_birthday, 100000, :user_rank)";
            $q = $connection->prepare($createUser);
            $q->bindParam(":user_name", $user_name);
            $q->bindParam(":user_password", $user_password);
            $q->bindParam(":user_email", $user_email);
            $q->bindParam(":user_birthday", $user_birthday);
            $q->bindParam(":user_rank",$nextRank);
            $q->execute();
        }

        public function updateExistingUser(){
            //Check if user actually exists
            //run update query
        }

        public function createPurchaseOrder(){

        }

        public function createSaleOrder(){

        }
    }


?>
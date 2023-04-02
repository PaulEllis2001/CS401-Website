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

        public function getLoginInformation($user_name){
            //Need to take in username
        }

        public function createNewUser($user_name, $user_password, $user_email, $user_birthday){
            
            //insert into users (username, password, email, birthday, cash, rank)
            $connection = $this->getConnection();
            $currentUsers = $connection->query("SELECT user_name FROM users")->fetchAll(PDO::FETCH_ASSOC);
            if(in_array($user_name, $currentUsers)){
                //Return an error and display on the website
            }

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

        public function updateExistingUser($user_name, $new_info){
            //Check if user actually exists
            //TODO ^
            //run update query
            $connection = $this->getConnection();
            $q = $connection->prepare("SELECT * FROM users WHERE user_name = :incoming_user");
            $q->bindParam(":incoming_user", $user_name);
            if($q->execute()){
                $user = $q->fetchAll(PDO::FETCH_ASSOC);
                return $user;

                $stmt = "UPDATE users SET :column1 = :value1 WHERE user_id = :USER_ID";
            }
            return null;//Should probably return some sort of error as statement failed
        }

        public function createPurchaseOrder($user_id, $coin_id, $coin_amt = 0.0, $dollar_amt = 0.0){
            $conn = $this->getConnection();
            $insertHistory_string = "INSERT INTO transaction_history 
            (user_id, coin_id, transaction_type, transaction_amount, transaction_value, transaction_change) 
            VALUES (:user_id, :coin_id, 'buy', :transaction_amount, :transaction_value, transaction_change)";

            $changeAmt = 0.0;
            $userWalletID = 0;

            $lastTransaction_string = "SELECT * FROM transaction_history 
            WHERE user_id = :user_id AND coin_id = :coin_id 
            ORDER BY transaction_time DESC LIMIT 1";

            $updateUserWallet_string = "UPDATE user_coins 
            SET purchase_time = NOW(), purchase_value = :coin_value, 
            purchase_amount = :coin_amt WHERE purchase_id = :wallet_id";

            $userWallet_string = "SELECT * FROM user_coins WHERE user_id = :user_id AND coin_id = :coin_id";
            $uWQ = $conn->prepare($userWallet_string);
            $uWQ->bindParam(":user_id", $user_id);
            $uWQ->bindParam(":coin_id", $coin_id);
            if($uWQ->execute()){
                $userWalletID = $uWQ->fetchAll(PDO::FETCH_ASSOC)["purchase_id"];
            }

            $lTQ = $conn->prepare($lastTransaction_string);
            $lTQ->bindParam(":user_id", $user_id);
            $lTQ->bindParam(":coin_id", $coin_id);
            if($lTQ->execute()){
                $lTQ_Array = $lTQ->fetchAll(PDO::FETCH_ASSOC);
                if($coin_amt > 0){
                    $changeAmt = ($coin_amt - $lTQ_Array["transaction_amount"]) / $lTQ["transaction_amount"];
                } else {
                    $changeAmt = ($dollar_amt - $lTQ_Array["transaction_value"]) / $lTQ_Array["transaction_value"];
                }
            }
        }

        public function createSaleOrder(){

        }
    }


?>
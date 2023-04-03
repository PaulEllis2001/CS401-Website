<?php

    class Dao{

        private $db = "FraudCoinDB";
        private $user = "root";
        private $host = "localhost";

        public function debugTable($tableName = "users"){
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM $tableName")->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getConnection(){
            return new PDO("mysql:host={$this->host};dbname={$this->db}",
            $this->user, getenv("DB_PASSWORD"));
        }

        //Look At Again
        public function getCoinSummary(){
            $connection = $this->getConnection();
            return $connection->query("SELECT * 
            from coin_history 
            WHERE DAY(change_time) = DAY(NOW())
            GROUP BY coin_id")->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getCurrentCoinValues(){
            $connection = $this->getConnection();
            return $connection->query(
                "SELECT * FROM coin"
                )->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getUserLeaderboard(){
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getCoinLeaderboard(){
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM coin")->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getUserInfo($user_id){
            $conn = $this->getConnection();
            $q = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $q->bindParam(":user_id", $user_id);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        //Returns assoc array of all user's history to be processed outside of the Dao
        public function getUserHistory($user_id){
            $conn = $this->getConnection();
            $q = $conn->prepare("SELECT * FROM transaction_history WHERE user_id = :user_id");
            $q->bindParam(":user_id", $user_id);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        //Returns assoc array for all coins in a user's wallet to be processed outside of the Dao
        public function getUserWallet($user_id){
            //
            $conn = $this->getConnection();
            $prepString = "SELECT * FROM user_coins WHERE user_id = :user_id";
            $q = $conn->prepare($prepString);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getLoginInformation($user_name){
            //Need to take in username, Returns the user's row to the program for processing to be done there
            $conn = $this->getConnection();
            $q = $conn->prepare("SELECT * FROM users WHERE user_name = :user_name");
            $q->bindParam(":user_name", $user_name);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function createNewUser($user_name, $user_password, $user_email, $user_birthday){
            
            //insert into users (username, password, email, birthday, cash, rank)
            $connection = $this->getConnection();
            $currentUsers = $connection->query("SELECT user_name FROM users")->fetchAll(PDO::FETCH_ASSOC);
            if(in_array($user_name, $currentUsers)){
                //Return an error and display on the website
                return "Failed to create a new user, username already in use";
            }

            $nextRank = rand();

            $createUser = "INSERT INTO users (user_name, user_password, user_email, user_birthday, user_cash, user_rank) 
            VALUES (:user_name, :user_password, :user_email, :user_birthday, 100000, :user_rank)";
            $q = $connection->prepare($createUser);
            $q->bindParam(":user_name", $user_name);
            $q->bindParam(":user_password", $user_password);
            $q->bindParam(":user_email", $user_email);
            $q->bindParam(":user_birthday", $user_birthday);
            $q->bindParam(":user_rank",$nextRank);
            $q->execute();
            return "Success! User Created";
        }

        //Done
        public function updateExistingUser($user_id, $new_info){
            //This function will go through each item in new info and update
            //The given user with the information
            //Returns true if all succed returns the exception if sometings fails

            $connection = $this->getConnection();
            foreach($new_info as $key => $value){
                $stmt = "UPDATE users SET :column1 = :value1 WHERE user_id = :USER_ID";
                $uQ = $connection->prepare($stmt);
                $uQ->bindParam(":column1", $key);
                $uQ->bindParam(":value1", $value);
                $uQ->bindParam(":USER_ID", $user_id);
                try{
                    $uQ->execute();
                } catch (Exception $e){
                    return $e;
                }
            }
            return true;//Should probably return some sort of error as statement failed
        }

        public function createPurchaseOrder($user_id, $coin_id, $coin_amt = 0.0, $dollar_amt = 0.0){
            //TODO finish this
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
            //TODO this
        }
    }


?>
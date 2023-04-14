<?php
session_start();
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
            WHERE YEAR(change_time) = YEAR(NOW())
            ORDER BY coin_id, change_time DESC")->fetchAll(PDO::FETCH_ASSOC);
        }


        public function getCoinHistory($coin_id){
            $conn = $this->getConnection();
            $q = $conn->prepare("SELECT * FROM coin_history WHERE coin_id = :coin_id");
            $q->bindParam(":coin_id", $coin_id);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);

        }

        public function getCoinID($coinName){
           $conn = $this->getConnection();
           $q = $conn->prepare("SELECT coin_id FROM coin WHERE coin_name = :coinName");
           $q->bindParam(":coinName", $coinName);
           $q->execute();
          return $q->fetchAll(PDO::FETCH_ASSOC); 
        }

        public function getCoinInfo($coinID){

            $conn = $this->getConnection();

            $q = $conn->prepare("SELECT * FROM coin WHERE coin_id = :coinID");
            $q->bindParam(":coinID", $coinID);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }


        public function getUserCoinSpecific($user_id, $coin_id){
            $conn = $this->getConnection();
            $q = $conn->prepare("SELECT SUM(purchase_amount), SUM(purchase_value) FROM user_coins WHERE user_id = :user_id AND coin_id = :coin_id ");
            $q->bindParam(":user_id", $user_id);
            $q->bindParam(":coin_id", $coin_id);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        
        }

        //Done
        public function getCurrentCoinValues(){
            $connection = $this->getConnection();
            return $connection->query(
                "SELECT coin_name, coin_value, coin_num_circulating FROM coin ORDER BY coin_value DESC"
                )->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getUserLeaderboard($invert = false){
           $conn = $this->getConnection();
           if($invert){
              return $conn->query("SELECT u.user_rank, u.user_name, u.user_cash + SUM(uc.purchase_value), c.coin_name FROM users u JOIN user_coins uc ON u.user_id = uc.user_id JOIN coin c ON c.coin_id = uc.coin_id WHERE u.user_rank IS NOT NULL GROUP BY uc.user_id ORDER BY u.user_rank DESC")->fetchAll(PDO::FETCH_ASSOC);
           }
              return $conn->query("SELECT u.user_rank, u.user_name, u.user_cash + SUM(uc.purchase_value), c.coin_name FROM users u JOIN user_coins uc ON u.user_id = uc.user_id JOIN coin c ON c.coin_id = uc.coin_id WHERE u.user_rank IS NOT NULL GROUP BY uc.user_id ORDER BY u.user_rank ASC")->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function getCoinLeaderboard($invert = false){
            $conn = $this->getConnection();
            if($invert){
               return $conn->query("SELECT coin_name, coin_value, coin_num_circulating FROM coin ORDER BY coin_value ASC")->fetchAll(PDO::FETCH_ASSOC);
            }
            return $conn->query("SELECT coin_name, coin_value, coin_num_circulating FROM coin ORDER BY coin_value DESC")->fetchAll(PDO::FETCH_ASSOC);
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
            $q = $conn->prepare("SELECT c.coin_name, h.transaction_amount, h.transaction_value, h.transaction_change, h.transaction_type FROM transaction_history h JOIN coin c ON h.coin_id = c.coin_id WHERE user_id = :user_id ORDER BY h.transaction_time DESC");
            $q->bindParam(":user_id", $user_id);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        //Returns assoc array for all coins in a user's wallet to be processed outside of the Dao
        public function getUserWallet($user_id){
            //
            $conn = $this->getConnection();
            $prepString = "SELECT c.coin_name, SUM(u.purchase_amount), SUM(u.purchase_value) FROM user_coins u JOIN coin c ON u.coin_id = c.coin_id WHERE user_id = :user_id GROUP BY c.coin_name ORDER BY SUM(u.purchase_value) DESC";
            $q = $conn->prepare($prepString);
            $q->bindParam(":user_id", $user_id);
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

        public function getUserEmailForCheck(){
            $conn = $this->getConnection();
            return $conn->query("SELECT user_email FROM users")->fetchAll(PDO::FETCH_ASSOC);
        }

        //Done
        public function createNewUser($user_name, $user_password, $user_email, $user_birthday){
            
            //insert into users (username, password, email, birthday, cash, rank)
            $connection = $this->getConnection();
            $currentUsers = $connection->query("SELECT user_name, user_email FROM users")->fetchAll(PDO::FETCH_ASSOC);
            $response = array();
            foreach($currentUsers as $row){
                if(strcmp($row['user_email'], $user_email) == 0){
                   array_push($response, "email in use");
                }
                if(strcmp($row['user_name'], $user_name) == 0){
                   array_push($response, 'username in use'); 
                }
            }
            if(isset($response[0])){
                return $response;
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
            return "success";
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

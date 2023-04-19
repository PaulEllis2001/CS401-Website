<?php
session_start();
    class Dao{

        private $db = "FraudCoinDB";
        private $user = "root";
        private $host = "localhost";


        public function updateHistoryDate($id, $date){
            $conn = $this->getConnection();
            $q = $conn->prepare("UPDATE coin_history SET change_time = :date WHERE ch_id = :id");
            $q->bindParam(":id", $id);
            $q->bindParam(":date", $date);
            $q->execute();
        }

        public function debugTable($tableName = "users"){
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM $tableName")->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getConnection(){
            return new PDO("mysql:host={$this->host};dbname={$this->db}",
            $this->user, getenv("DB_PASSWORD"));
        }

        public function searchCoins(){
            $conn = $this->getConnection();
            return $conn->query("SELECT coin_name, coin_value, coin_num_circulating FROM coin")->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function searchUsers(){
            $conn = $this->getConnection();
            return $conn->query("SELECT user_name, user_rank, user_cash FROM users")->fetchAll(PDO::FETCH_ASSOC);
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
            $q = $conn->prepare("SELECT * FROM coin_history WHERE coin_id = :coin_id ORDER BY change_time ASC");
            $q->bindParam(":coin_id", $coin_id);
            $q->execute();
            return $q->fetchAll(PDO::FETCH_ASSOC);

        }


        public function createNewCoin($coin_name, $coin_value){
            $conn = $this->getConnection();
            $q = $conn->prepare("INSERT INTO coin (coin_name, coin_value, coin_num_circulating) VALUES (:coin_name, :coin_value, 0)");
            $q->bindParam(":coin_name", $coin_name);
            $q->bindParam(":coin_value", $coin_value);
            $q->execute();
        }

        public function updateCoin($coin_id, $percent_change){
            $conn = $this->getConnection();
            $coin_info = $this->getCoinInfo($coin_id);
            $cur_value = $coin_info[0]['coin_value'];
            $next_value = $cur_value * (1 + ($percent_change / 100));
            if($next_value <= 0.1){
                $next_value = .1;
            }
            $uQ = $conn->prepare("INSERT INTO coin_history (percent_change, coin_id, coin_new_value) VALUES (:percent_change, :coin_id, :coin_new_value)");
            $uQ->bindParam(":coin_id", $coin_id);
            $uQ->bindParam(":percent_change", $percent_change);
            $uQ->bindParam(":coin_new_value", $next_value);
            $uQ->execute();

            $q = $conn->prepare("UPDATE coin SET coin_value = :new_value WHERE coin_id = :coin_id");
            $q->bindParam(":new_value", $next_value);
            $q->bindParam(":coin_id", $coin_id);
            $q->execute();
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
            $rank = $this->getRank($connection)[0]['user_rank'];
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
            $nextRank = $rank + 1;

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

        public function createPurchaseOrder($user_id, $coin_id, $num_coins, $value_coins){
            //TODO finish this
            $conn = $this->getConnection();
            $coin_circ_update = "UPDATE coin SET coin_num_circulating = :newCirculating WHERE coin_id = :coin_id";

            $user_wallet_insert = "INSERT INTO user_coins (user_id, coin_id, purchase_value, purchase_amount) VALUES (:user_id, :coin_id, :purchase_value, :purchase_amount)";
            $transaction_history_insert = "INSERT INTO transaction_history (user_id, coin_id, transaction_type, transaction_value, transaction_amount, transaction_change) VALUES (:user_id, :coin_id, 'buy', :transaction_value, :transaction_amount, :transaction_change)";
            $user_cash_update = "UPDATE users SET user_cash = :new_cash WHERE user_id = :user_id";
            $transaction_history_get_last = "SELECT * FROM transaction_history WHERE user_id = :user_id AND coin_id = :coin_id AND transaction_type = 'buy' ORDER BY transaction_time DESC LIMIT 1";
            //Get User Cash, check if enough is there, throw error if not
            $current_user_cash = $this->getUserInfo($user_id)[0]['user_cash'];
            if($current_user_cash < $value_coins){
                //RETURN FAILURE
               return false;
            }
            $new_cash_ballance = $current_user_cash - $value_coins;
            //Get Last transaction of the same coin and user and calculate the change percentage
            $q = $conn->prepare($transaction_history_get_last);
            $q->bindParam(":user_id", $user_id);
            $q->bindParam(":coin_id", $coin_id);
            $q->execute();
            $last_transaction = $q->fetchAll(PDO::FETCH_ASSOC)[0];

            $percentChange = ($value_coins - $last_transaction['transaction_value']) / $last_transaction['transaction_value'];

            //Update user_wallet
            $uWQ = $conn->prepare($user_wallet_insert);
            $uWQ->bindParam(":user_id", $user_id);
            $uWQ->bindParam(":coin_id", $coin_id);
            $uWQ->bindParam(":purchase_value", $value_coins);
            $uWQ->bindParam(":purchase_amount", $num_coins);
            $uWQ->execute();

            //Update transaction_history
            
            $uTHQ = $conn->prepare($transaction_history_insert);
            $uTHQ->bindParam(":user_id", $user_id);
            $uTHQ->bindParam(":coin_id", $coin_id);
            $uTHQ->bindParam(":transaction_value", $value_coins);
            $uTHQ->bindParam(":transaction_amount", $num_coins);
            $uTHQ->bindParam(":transaction_change", $percentChange);
            $uTHQ->execute();

            //Update user cash

            $uUCQ = $conn->prepare($user_cash_update);
            $uUCQ->bindParam(":user_id", $user_id);
            $uUCQ->bindParam(":new_cash", $new_cash_ballance);
            $uUCQ->execute();

            //Get Current Num Circulating to update

            $current_circ = $this->getCoinInfo($coin_id)[0]['coin_num_circulating'];
            $new_circ = $current_circ + $num_coins;

            //update coin num circulating

            $uCNCQ = $conn->prepare($coin_circ_update);
            $uCNCQ->bindParam(":newCirculating", $new_circ);
            $uCNCQ->bindParam(":coin_id", $coin_id);

            //return success
            return true;
        }

        public function createSaleOrder(){
            //TODO this
        }

        public function testGetRank(){
            return $this->getRank($this->getConnection());
        }
        public function getRank($conn){

           $retVal = $conn->query("SELECT user_rank FROM users WHERE user_cash <= 100000 ORDER BY user_rank DESC")->fetchAll(PDO::FETCH_ASSOC);
           return $retVal;
        }
    }


?>

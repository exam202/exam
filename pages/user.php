<?php 
    include "connect.php";
    session_start();
    class User {
        public $first_name;
        public $last_name; 
        public $email;
        public $password;
        public $country;
        public $county;
        public $preferences;
        public $theme;
        public $level;


        function __construct($id,$first_name,$last_name,$email,$password,$country,$county,$preferences,$theme,$level){
            $this->id=$id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->password = $password;
            $this->country = $country;
            $this->county = $county;
            $this->preferences = $preferences;
            $this->theme = $theme;
            $this->level = $level;
        }

        static function login($email, $password) {
            $conn = connect();
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if ($num ==1){
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password,$row['password'])){
                    return new User($row["id"], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row["country"],$row["county"],$row["preferences"],$row["theme"],$row["level"]);
                }
            }
            return false;
        }
        
        static function load_by_id($id) {
            $conn = connect();
            $sql = "SELECT * FROM users WHERE id=".$id;
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            return new User($row["id"], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row["country"],$row["county"],$row["preferences"],$row["theme"],$row["level"]);
        }

        function add(){
            $conn = connect();
            unset($_SESSION['email_error']);

            $sql = "SELECT * FROM users WHERE email = '$this->email'";
            $em_result = mysqli_query($conn,$sql);
            $emails = mysqli_num_rows($em_result);

            if ($emails ==1){
                $_SESSION['index_error']="3";
                header("Location: ./");
            }
            
            else {
            $query = "INSERT INTO users (first_name,last_name,email,password,country,county,preferences,theme) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bind_param("ssssssss",$this->first_name,$this->last_name,$this->email,$hash,$this->country,$this->county,$this->preferences,$this->theme);
            $stmt->execute();

            header("Location: ./");
            } 
        }


        function delete(){
            $conn = connect();
            unlink($this->profilePic);
            $query = "DELETE FROM users WHERE id =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
            
        }


        
    }
?>
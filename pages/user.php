<?php 
    include "connect.php";
    session_start();
    class User {
        public $first_name;
        public $last_name; 
        public $email;
        public $password;
        public $country;
        public $postcode;
        public $preferences;
        public $theme;
        public $level;


        function __construct($id,$first_name,$last_name,$email,$password,$country,$postcode,$preferences,$theme,$level){
            $this->id=$id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->password = $password;
            $this->country = $country;
            $this->postcode = $postcode;
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
                    return new User($row["id"], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row["country"],$row["postcode"],$row["preferences"],$row["theme"],$row["level"]);
                }
            }
            return false;
        }
        
        static function load_by_id($id) {
            $conn = connect();
            $sql = "SELECT * FROM users WHERE id=".$id;
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);

            $sql = "SELECT * FROM preferences WHERE user_id=".$id;
            $result = mysqli_query($conn,$sql);
            $preferences = mysqli_fetch_assoc($result);

            return new User($row["id"], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row["country"],$row["postcode"],$preferences,$row["theme"],$row["level"]);
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
                $query = "INSERT INTO users (first_name,last_name,email,password,country,postcode,preferences,theme) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($query);
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bind_param("ssssssss",$this->first_name,$this->last_name,$this->email,$hash,$this->country,$this->postcode,$this->preferences,$this->theme);
                $stmt->execute();

                $sql = "SELECT * FROM users WHERE email='".$this->email."'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);

                $query = "INSERT INTO preferences (user_id) VALUES (?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i",$row["id"]);
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

        function update(){
            $conn = connect();
            $query = "UPDATE users SET first_name=?,last_name=?,email=?,password=?,country=?,postcode=?,preferences=?,theme=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bind_param("ssssssisi",$this->first_name,$this->last_name,$this->email,$hash,$this->country,$this->postcode,$this->preferences,$this->theme,$this->id);
            $stmt->execute();
        }
        
    }
?>
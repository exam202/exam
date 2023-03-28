<?php 
    include "connect.php";
    
    // this is used on every page other than the login and sign up and is pulled in using the require function as the website will not work without it
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
            // checks if the email is in the database and if the password matches the one in the database and logs them in
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
            // if their email or password is incorrect it will return false so that an error can be shown 
            return false;
        }
        
        static function load_by_id($id) {
            // this is used to load the user object when the user is logged in and is used on every page other than the login and sign up
            $conn = connect();
            // gets the main user info
            $sql = "SELECT * FROM users WHERE id=".$id;
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            // gets the preferences info and combines it with the main user info
            $sql = "SELECT * FROM preferences WHERE user_id=".$id;
            $result = mysqli_query($conn,$sql);
            $preferences = mysqli_fetch_assoc($result);
            // constructs the user object using the data from the database
            return new User($row["id"], $row['first_name'], $row['last_name'], $row['email'], $row['password'], $row["country"],$row["postcode"],$preferences,$row["theme"],$row["level"]);
        }

        function add(){
            $conn = connect();
            // removes the email error if one is set
            unset($_SESSION['email_error']);
            // checks if the email is already in the database
            $sql = "SELECT * FROM users WHERE email = '$this->email'";
            $em_result = mysqli_query($conn,$sql);
            $emails = mysqli_num_rows($em_result);
            // if the email is already in the database it will return an error
            if ($emails ==1){
                $_SESSION['notification']="3";
                header("Location: ./");
            }
            // if the email is not in the database it will add the user to the database
            else {
                $query = "INSERT INTO users (first_name,last_name,email,password,country,postcode,preferences,theme) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($query);
                // hashses password for security
                $hash = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bind_param("ssssssss",$this->first_name,$this->last_name,$this->email,$hash,$this->country,$this->postcode,$this->preferences,$this->theme);
                $stmt->execute();

                // gets the id of the user that was just added to the database
                $sql = "SELECT * FROM users WHERE email='".$this->email."'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);
                // adds the user id to the preferences table
                $query = "INSERT INTO preferences (user_id) VALUES (?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i",$row["id"]);
                $stmt->execute();
                $_SESSION['notification']="4";
                // sends the user to the login page
                header("Location: ./");
            } 
        }


        function delete(){
            $conn = connect();
            // deletes the user from the database
            $query = "DELETE FROM users WHERE id =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
            
        }

        function update(){
            $conn = connect();
            // takes the user object that is being updated and updates the database with the new info
            $query = "UPDATE users SET first_name=?,last_name=?,email=?,password=?,country=?,postcode=?,preferences=?,theme=?,level=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssssissi",$this->first_name,$this->last_name,$this->email,$this->password,$this->country,$this->postcode,$this->preferences,$this->theme,$this->level,$this->id);
            $stmt->execute();
        }
        
    }
?>
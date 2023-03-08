<?php 
// This file is used to connect to the database. It is used in all other files that need to connect to the database.
    function connect() {
        try
        { 
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "health_advice_group";
            $conn = new mysqli($servername, $username, $password, $dbname);
            return $conn; 
        } 
        catch (exception $e) 
        { 
            return false;
        }     
    }
?>
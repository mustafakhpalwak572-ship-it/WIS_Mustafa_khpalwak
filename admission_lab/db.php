<?php 

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'admission_db';


    $conn = new mysqli($host,$username,$password,$database);
    if($conn->connect_error){
        die("Database Connection Faild".$conn->connect_error);

    }
    $conn->set_charset("utf8mb4");
    

?>
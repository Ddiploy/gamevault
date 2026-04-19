<?php
$host = "localhost";
$user = "u600791179_usr_H4UHOjk2";
$pass = "Crakfamily99"; 
$dbname = "u600791179_db_H4UHOjk2";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
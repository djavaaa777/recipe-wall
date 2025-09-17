<?php
$host = 'localhost';
$db   = 'recipe';
$user = 'root';
$pass = '';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to DB: " . $e->getMessage());
}
?>

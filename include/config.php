<?php
$host = 'sql210.infinityfree.com';
$db   = 'if0_39172511_recipewall';
$user = 'if0_39172511';
$pass = 'wSBl1SDP00QP';
 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to DB: " . $e->getMessage());
}
?>

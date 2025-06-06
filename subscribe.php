<?php
session_start();
require("include/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare("INSERT INTO subscribers(email) VALUES(?)");
        $stmt->execute([$email]);
        $_SESSION['footer_success'] = "Вы успешно подписались!";
    } else {
        $_SESSION['footer_success'] = "Некорректный email!";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

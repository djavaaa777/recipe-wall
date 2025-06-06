<?php 
require('include/config.php');
session_start();

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (strlen($name) < 2) {
        $errors['name'] = "The name is too short";
    }

    if (strlen($email) < 5 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Incorrect email";
    }

    if (strlen($message) < 10) {
        $errors['message'] = "The message is too short";
    }

    if (empty($errors)) {
        $sql = 'INSERT INTO messages(name, email, message) VALUES (?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$name, $email, $message]);
        $_SESSION['success'] = "Message sent successfully!";
    } else {
        $_SESSION['errors'] = $errors;
    }

    header("Location: about.php");
    exit;
}

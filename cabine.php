<?php
require("include/config.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$user_id = $_SESSION['user_id'];
$success = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $image = htmlspecialchars(trim($_POST['image'] ?? ''));

    if (strlen($title) < 3 || strlen($description) < 10) {
        $error = "Заполните корректно все поля.";
    } elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
        $error = "Некорректный URL изображения.";
    }
    else{
        $sql='INSERT INTO recipes(user_id,title,description,image) VALUES(?,?,?,?)';
        $query=$pdo->prepare($sql);
        $query->execute([$user_id,$title,$description,$image]);
        $success = "Рецепт успешно добавлен!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Личный кабинет — Recipe Wall</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #e4e4e4;
    }
    .form-control {
      background-color: #2c2c2c;
      border: 1px solid #444;
      color: #e4e4e4;
    }
    .form-control::placeholder {
      color: #aaa;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <h2 class="text-center mb-4">Welcome, <?= $username ?>!</h2>

    <?php if ($success): ?>
      <div class="alert alert-success text-center"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="POST" action="cabine.php">
          <div class="mb-3">
            <label for="title" class="form-label">Recipe name</label>
            <input type="text" class="form-control" name="title" required placeholder="For example: Omelette with cheese">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="4" required placeholder="Enter step-by-step description..."></textarea>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" name="image" required placeholder="https://example.com/image.jpg">
          </div>

          <button type="submit" class="btn btn-primary w-100">Add recipe</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
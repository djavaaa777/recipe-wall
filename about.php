<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? "";
unset($_SESSION['errors'], $_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About us — Recipe Wall</title>
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
  <?php require("blocks/header.php"); ?>

  <div class="container py-5">
    <h2 class="text-center mb-4">About the Recipe Wall project</h2>
    <p class="text-center mb-5">
        Recipe Wall is a platform for inspiration and sharing your favorite recipes. We aim to connect people who love to cook, experiment, and share delicious moments.
    </p>

    <h4 class="mb-3">Write to us</h4>

    <?php if ($success): ?>
      <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul class="mb-0">
          <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="send_message.php" method="POST" class="mt-4">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Ваше имя" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Ваше сообщение..." required></textarea>
      </div>
      <button type="submit" class="btn btn-outline-light">Send</button>
    </form>
  </div>

  <?php require("blocks/footer.php"); ?>
</body>
</html>

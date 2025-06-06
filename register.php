<?php
require("include/config.php");

$errors = [];
$success = "";
$username = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));

    if (strlen($username) < 5) {
        $errors['username'] = "Username is too short";
    }

    if (strlen($email) < 5 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Incorrect email";
    }

    if (strlen($password) < 5) {
        $errors['password'] = "The password is too short";
    }

    if (empty($errors)) {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) {
            $errors['email'] = "A user with this email already exists";
        }
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users(username, email, password) VALUES (?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$username, $email, $hashedPassword]);
        $success = "Registration was successful!";
        $username = $email = "";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registration — Recipe Wall</title>
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
    .form-text {
      color: #ff7676;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <h2 class="text-center mb-4">Create an account</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">

        <?php if (!empty($success)): ?>
          <div class="alert alert-success text-center"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php" novalidate>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" id="username" name="username" required placeholder="Введите имя" value="<?= htmlspecialchars($username) ?>">
            <?php if (isset($errors['username'])): ?>
              <div class="form-text"><?= $errors['username'] ?></div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" required placeholder="example@mail.com" value="<?= htmlspecialchars($email) ?>">
            <?php if (isset($errors['email'])): ?>
              <div class="form-text"><?= $errors['email'] ?></div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password" name="password" required placeholder="••••••">
            <?php if (isset($errors['password'])): ?>
              <div class="form-text"><?= $errors['password'] ?></div>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 text-center">Already have an account? <a href="login.php">Log in</a></p>
      </div>
    </div>
  </div>

</body>
</html>

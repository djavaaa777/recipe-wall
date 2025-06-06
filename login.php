<?php
require("include/config.php");
session_start();
echo "<!-- LOGIN.PHP RENDERED -->";

$errors = [];
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    if (strlen($email) < 5 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Incorrect email";
    }

    if (strlen($password) < 5) {
        $errors['password'] = "The password is too short";
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $errors['general'] = "Incorrect email or password";
        } else {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Log in — Recipe Wall</title>
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
    <h2 class="text-center mb-4">Login to your account</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">

        <?php if (isset($errors['general'])): ?>
          <div class="alert alert-danger text-center"><?= $errors['general'] ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" novalidate>
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

          <button type="submit" class="btn btn-outline-light w-100">Log in</button>
        </form>

        <p class="mt-3 text-center">Don't have an account? <a href="register.php">Create</a></p>
      </div>
    </div>
  </div>

</body>
</html>

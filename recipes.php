<?php
require("include/config.php");
require("blocks/header.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>All recipes — Recipe Wall</title>
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
    .card {
      background-color: #1e1e1e;
      color: #fff;
      border: none;
    }
    .card-img-top {
      max-height: 250px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<div class="container py-4">
  <h2 class="text-center mb-4">All recipes</h2>

  <input type="text" id="inputElement" class="form-control mb-4" placeholder="Search for recipes...">

  <div id="recipes-container" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php
      $sql = "SELECT recipes.*, users.username 
              FROM recipes 
              JOIN users ON recipes.user_id = users.id 
              ORDER BY recipes.id DESC";
      $query = $pdo->prepare($sql);
      $query->execute();
      $recipes = $query->fetchAll(PDO::FETCH_OBJ);

      foreach ($recipes as $el) {
        $src = filter_var($el->image, FILTER_VALIDATE_URL) ? $el->image : './img/' . $el->image;
        echo '
          <div class="col">
            <div class="card h-100 shadow-sm">
              <img src="' . htmlspecialchars($src) . '" class="card-img-top" alt="Recipe">
              <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($el->title) . '</h5>
                <p class="card-text">' . htmlspecialchars($el->description) . '</p>
                <p class="card-text"><small class="text-white">Автор: ' . htmlspecialchars($el->username) . '</small></p>
              </div>
            </div>
          </div>';
      }
    ?>
  </div>
</div>

<script src="static/script.js"></script>
<?php require("blocks/footer.php"); ?>
</body>
</html>

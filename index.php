<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recipe Wall</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #e4e4e4;
    }
    .card {
      color: #e4e4e4;
      background-color: #1e1e1e;
      border: none;
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: scale(1.02);
    }
    .navbar, .footer {
      background-color: #1a1a1a;
    }
    .form-control, .form-select {
      background-color: #2c2c2c;
      border: 1px solid #444;
      color: #e4e4e4;
    }
    .form-control::placeholder {
      color: #aaa;
    }
    .btn-outline-light:hover {
      background-color: #fff;
      color: #000;
    }
  </style>
</head>
<body>
  <?php require("blocks/header.php")?>
  <div class="container pb-5">
    <h2 class="mt-3 mb-4 text-center">Popular recipes</h2>

    <div class="mt-1 mb-4 text-end">
        <a href="recipes.php" class="btn btn-outline-light">See all recipes</a>
    </div>


    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php 
        require("include/config.php");
        $sql = "SELECT recipes.*, users.username 
        FROM recipes 
        JOIN users ON recipes.user_id = users.id 
        ORDER BY recipes.id DESC 
        LIMIT 3";

        $query=$pdo->prepare($sql);
        $query->execute();
        $recipes=$query->fetchAll(PDO::FETCH_OBJ);


        foreach($recipes as $el){
            $src = (filter_var($el->image, FILTER_VALIDATE_URL))
            ? $el->image
            : './img/' . $el->image;
            echo '
                <div class="col">
                    <div class="card h-100 shadow-sm">
                    <img src='.htmlspecialchars($src).' class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">'.$el->title.'</h5>
                        <p class="card-text">'.$el->description.'</p>
                        <p class="card-text"><small class="text-white">Автор:'.$el->username.'</small></p>
                    </div>
                    </div>
                </div>
            ';
        }
      ?>
    </div>
  </div>

  <div class="container pb-5">
    <h3 class="mb-3 text-center">🏆 Best recipes of the week</h3>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php 
        require("include/config.php");
        $sql='SELECT recipes.*, users.username 
        FROM recipes 
        JOIN users ON recipes.user_id = users.id 
        ORDER BY RAND() 
        LIMIT 2;
        ';
        $query=$pdo->prepare($sql);
        $query->execute();
        $recipes=$query->fetchAll(PDO::FETCH_OBJ);

        foreach($recipes as $el){
            $src = (filter_var($el->image, FILTER_VALIDATE_URL))
            ? $el->image
            : './img/' . $el->image;
            echo '
                <div class="col">
                    <div class="card shadow-sm">
                    <div class="card-body">
                        <img src='.htmlspecialchars($src).' class="card-img-top">
                        <h5 class="card-title">'.$el->title.'</h5>
                        <p class="card-text">'.$el->description.'</p>
                        <p class="card-text"><small class="text-white">Автор:'.$el->username.'</small></p>
                    </div>
                    </div>
                </div>
            ';
        }
      ?>
    </div>
  </div>
  <?php require("blocks/footer.php")?>
</body>
</html>

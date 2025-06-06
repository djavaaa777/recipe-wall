<?php
require("include/config.php");

$data = json_decode(file_get_contents("php://input"), true);
$query = trim($data['query'] ?? '');

$sql = "SELECT recipes.*, users.username 
        FROM recipes 
        JOIN users ON recipes.user_id = users.id 
        WHERE recipes.title LIKE ? 
        ORDER BY recipes.created_at DESC";

$pdoQuery = $pdo->prepare($sql);
$pdoQuery->execute(["%" . $query . "%"]);
$recipes = $pdoQuery->fetchAll(PDO::FETCH_OBJ);

foreach ($recipes as $el) {
    $src = (filter_var($el->image, FILTER_VALIDATE_URL)) ? $el->image : './img/' . $el->image;

    echo '
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img src="' . htmlspecialchars($src) . '" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title">' . htmlspecialchars($el->title) . '</h5>
          <p class="card-text">' . htmlspecialchars($el->description) . '</p>
          <p class="card-text"><small class="text-white">Автор: ' . htmlspecialchars($el->username) . '</small></p>
        </div>
      </div>
    </div>';
}

if (count($recipes) === 0) {
    echo '<p class="text-center">No recipes found.</p>';
}
?>

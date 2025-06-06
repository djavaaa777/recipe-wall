<?php
$footerSuccess = $_SESSION['footer_success'] ?? "";
unset($_SESSION['footer_success']);
?>

<footer class="footer text-center mt-5 py-4">
  <div class="container">
    <h6 class="mb-3">Subscribe to Recipe Newsletter</h6>

    <?php if ($footerSuccess): ?>
      <div class="alert alert-success py-1"><?= htmlspecialchars($footerSuccess) ?></div>
    <?php endif; ?>

    <form action="subscribe.php" method="POST" class="d-flex justify-content-center gap-2">
      <input type="email" name="email" class="form-control w-auto" placeholder="Ваш email" required>
      <button type="submit" class="btn btn-outline-light">Subscribe</button>
    </form>

    <p class="mt-3 text-white">© <?= date("Y") ?> Recipe Wall. All rights reserved.</p>
  </div>
</footer>

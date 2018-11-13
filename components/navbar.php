<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Tic tac toe</a>
  <?php if(isset($_SESSION['user_id'])) { ?>
    <a href="actions/logout.php" class="btn btn-sm btn-outline-secondary" type="button">Log out</a>
  <?php } ?>
</nav>
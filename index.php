<?php
  session_start();
  if(!isset($_SESSION["user_id"])) {
    header('Location: login.php');
  }

  require_once("common/services.php");

  $openGames = Services::showOpenGames();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">

    <title>Tic tac toe</title>
  </head>

  <body>
    <?php include("components/navbar.php") ?> 
  
    <div class="container">
      <h1>Welcome!</h1>
      <div class="top-buttons">
        <button type="button" class="btn btn-info">Your statistics</button>
        <button type="button" class="btn btn-secondary">Leaderboard</button>

        <a type="button" href="actions/create-game.php" class="btn btn-success float-md-right">New game</a>
      </div>

      <h2>Open games</h2>
      <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col" class="join-col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($openGames as $openGame) {
            ?>
              <tr>
                <th scope="row"><?php echo $openGame->id ?></th>
                <td><?php echo $openGame->p1 ?></td>
                <td><button type="button" class="btn btn-outline-primary btn-sm float-md-right">Join</button></td>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
      
    </div>
  </body>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>
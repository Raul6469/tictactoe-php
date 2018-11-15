<?php
  session_start();
  if(!isset($_SESSION["user_id"])) {
    header('Location: login.php');
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">

    <title>Game</title>
  </head>

  <body>
    <?php include("components/navbar.php") ?> 
  
    <div class="container">
      <h1>Play game</h1>

      <div class="alert alert-primary" id="wait" role="alert">Waiting for second player to join...</div>
      <div class="alert alert-primary" id="status" role="alert"></div>

      <div class="board-container" style="display: none;">
        <table class="table table-bordered game">
          <tbody>
            <tr>
              <td class="square" x="0" y="0"></td>
              <td class="square" x="1" y="0"></td>
              <td class="square" x="2" y="0"></td>
            </tr>
            <tr>
              <td class="square" x="0" y="1"></td>
              <td class="square" x="1" y="1"></td>
              <td class="square" x="2" y="1"></td>
            </tr>
            <tr>
              <td class="square" x="0" y="2"></td>
              <td class="square" x="1" y="2"></td>
              <td class="square" x="2" y="2"></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </body>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="js/board.js"></script>
</html>
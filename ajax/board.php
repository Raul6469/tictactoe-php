<?php
  require_once("../entities/move.php");

  $moves = getBoard($_GET["gid"]);
  
  header('Content-Type: application/json');
  echo json_encode($moves);

  function getBoard($gid) {
    require_once("../common/soap-client.php");

    $params = array(
      "gid" => $gid
    );

    $result = $soapClient->getBoard($params)->return;

    $moves = array(array());

    if($result == "ERROR-NOMOVES") {
      return $moves;
    }

    if($result == "ERROR-DB") {
      return $result;
    }

    $moveStrings = explode("\n", $result);

    $moves = array();

    foreach($moveStrings as $moveString) {
      $moveElems = explode(",", $moveString);
      $move = new Move();

      $move->pid = $moveElems[0];
      $move->x = $moveElems[1];
      $move->y = $moveElems[2];

      array_push($moves, $move);
    }

    return $moves;
  }
?>
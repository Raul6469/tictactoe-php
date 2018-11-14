<?php

  $state = getGameState($_GET["gid"]);
  echo $state;

  function getGameState($gid) {
    require_once("../common/soap-client.php");

    $params = array(
      "gid" => $gid
    );

    $result = $soapClient->getGameState($params)->return;

    return $result;
  }
?>
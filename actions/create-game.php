<?php
session_start();

require_once("../common/soap-client.php");

$params = array(
  "uid" => $_SESSION["user_id"]
);

$result = $soapClient->newGame($params)->return;

if (strpos($result, 'ERROR') !== false) {
  header('Location: ../index.php?err='.$result);
} else {
  header('Location: ../game.php?gid='.$result);
}

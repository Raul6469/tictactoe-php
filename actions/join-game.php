<?php
session_start();

require_once("../common/soap-client.php");

$params = array(
  "uid" => $_SESSION["user_id"],
  "gid" => $_GET["gid"],
);

$result = $soapClient->joinGame($params)->return;

if (strpos($joinGameResult, 'ERROR') !== false) {
  header('Location: ../index.php?err=join');
} else {
  header('Location: ../game.php?gid='.$_GET["gid"]);
}

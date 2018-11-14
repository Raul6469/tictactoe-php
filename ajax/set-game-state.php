<?php
session_start();
require_once("../common/soap-client.php");

$params = array(
  "gid" => $_POST["gid"],
  "gstate" => $_POST["gstate"]
);

$result = $soapClient->setGameState($params)->return;

echo $result;

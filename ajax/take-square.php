<?php
session_start();
require_once("../common/soap-client.php");

$params = array(
  "x" => $_POST["x"],
  "y" => $_POST["y"],
  "gid" => $_POST["gid"],
  "pid" => $_SESSION["user_id"]
);

$result = $soapClient->takeSquare($params)->return;

echo $result;

<?php
require_once("../common/soap-client.php");

$params = array(
  "username" => $_POST["username"],
  "password" => $_POST["password"],
);

$result = $soapClient->login($params)->return;

if ($result == "-1") {
  header('Location: ../login.php?err=-1');
} else {
  $_SESSION['user_id'] = $result;
  header('Location: ../');
}

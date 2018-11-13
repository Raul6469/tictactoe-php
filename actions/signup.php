<?php
require_once("../common/soap-client.php");

$params = array(
  "username" => $_POST["username"],
  "password" => $_POST["password"],
  "name" => $_POST["name"],
  "surname" => $_POST["surname"]
);

$result = $soapClient->register($params)->return;

if (strpos($result, 'ERROR') !== false) {
  header('Location: ../signup.php?err='.$result);
} else {
  header('Location: ../login.php');
}

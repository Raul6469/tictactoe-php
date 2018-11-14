<?php
session_start();
require_once("../common/soap-client.php");

$params = array(
  "gid" => $_GET["gid"],
);

$result = $soapClient->checkWin($params)->return;

echo $result;

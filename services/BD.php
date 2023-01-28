<?php
$BDConfig = require("./config.php");
$BDConfig = $BDConfig["BD"];

$MySQLConex = mysqli_connect($BDConfig["host"], $BDConfig["user"], $BDConfig["pass"], $BDConfig["database"]);

function ValidateExistence($SQLQuery)
{
  $result = mysqli_query($GLOBALS["MySQLConex"], $SQLQuery);

  if ($result->num_rows > 0 and $result->num_rows < 2) {
    return true;
  } else
    return false;
}

function GetData($SQLQuery)
{
  $result = mysqli_query($GLOBALS["MySQLConex"], $SQLQuery);

  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  }
}
?>
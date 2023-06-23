<?php

$con = new mysqli("localhost", "root", "", "teste");

if(mysqli_connect_error())
{
  echo "<script>alert('Cannot connect to Database');</script>";
  exit();
}

?>

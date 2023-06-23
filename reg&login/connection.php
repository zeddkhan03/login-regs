<?php

$con = new mysqli("localhost", "root", "", "alcantara");

if(mysqli_connect_error())
{
  echo "<script>alert('Cannot connect to Database');</script>";
  exit();
}

?>

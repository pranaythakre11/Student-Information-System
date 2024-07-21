<?php
  require_once("config.php");

  // Check Session 
if(isset($_SESSION['email']))
{
    header("location:home.php");
}

if(!empty($_GET))
{
    $key = $_GET['key'];
    //mysqli_query($auth,"DELETE FROM students WHERE hash_code = '$key'");
    header("location:all-users.php");
}
header("location:all-users.php");
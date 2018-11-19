<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    echo "<form action='login.php'><p>Please Login :<input type='submit' name=btn/ value='Login'></p></form>";
    // header("location: login.php");
  }
?>
<html>

<head>
    <title>Camagru</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/photo.css"> -->
</head>
<?php include ("resources/home.php")?>

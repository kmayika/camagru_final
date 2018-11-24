<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    echo "<form action='login.php'><p>Please Login :<input type='submit' name=btn/ value='Login'></p></form>";
  }
?>
<html>

<head>
    <title>Camagru</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include ("resources/home.php")?>

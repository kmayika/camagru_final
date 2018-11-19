<?php

session_start();
if (isset($_SESSION['username']))
{
  unset($_SESSION['username']);
  echo "Session Destroyed";
  session_destroy();
  header("Location: login.php");
}
else
{
  echo "error: " . $_SESSION['username'];
}

?>

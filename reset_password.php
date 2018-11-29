<?php
include ("resources/header.php");

  echo '<form method="post" action="submit_new.php">
    <input type="hidden" name="email" value='.$_GET["email"].'>
    <input type="password" name="new_pass" placeholder="enter new password">
    <input type="submit" name="submit_password">
    </form>';
include ("resources/footer.php");
 ?>

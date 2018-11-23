<?php
require ("config/database.php");

if(isset($_POST['submit']) && !empty($_POST['email']))
{
  $database = db_camagru();
	$email =  strip_tags(trim($_POST['email']));
	$query = $database->prepare("SELECT * FROM db_camagru.users WHERE email =:email");
	$query->bindParam(":email", $email, PDO::PARAM_STR);
  $query->execute();
  while ($row = $query->fetch(PDO::FETCH_ASSOC))
  {
    if($row > 1)
    {

        $password = rand(999,99999);
        $hash = hash('sha256',$password);
        $toEmail = $_POST['email'];
        $subject = "Your Recovered Password";
        $message = "Please use this password to login " . $password;
        $headers = "Admin\r\n";
        $query = $database->prepare("UPDATE db_camagru.users SET password=:hash WHERE email=:email");
        $query->bindParam(":hash", $hash, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $res = $query->execute();
        if($res)
        {
          if(mail($toEmail, $subject, $message, $headers))
          {
          	echo "<div><p> ".$toEmail." ".$subject." ".$message." ".$headers."</p></div>";
          }
          else
          {
          	echo "Failed to Recover your password, try again";
          }
        }
  	}
    else
    {
  		echo "User name does not exist in database";
  	}
  }
}
else
{
  echo "fuck off";
}

?>

<?php include ("resources/header.php"); ?>
<form  action="forgot.php" method="POST">
  <h2>Forgot Password</h2>
  <div>
      <input type="text" name="email"  placeholder="Your email" required>
      <br />
      <input type="submit" name="submit"/>
      <a href="login.php">Login</a>
    </form>
    <?php include ("resources/footer.php"); ?>

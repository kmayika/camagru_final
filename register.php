<?php
// session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);

require ("class/library.class.php");
$app = new DemoLib();

$login_error_message = '';
$register_error_message = '';
$message = '';
if (isset($_POST['btnRegister']))
{
    if ($_POST['username'] == "")
    {
        $register_error_message = 'Username is required';
    }
    else if ($_POST['email'] == "")
    {
        $register_error_message = 'Please enter email';
    }
    else if ($_POST['password'] == "")
    {
        $register_error_message = 'password required';
    }
    else if ($_POST['password_confirm'] == "" || $_POST['password'] != $_POST['password_confirm'])
    {
        $register_error_message = 'passwords do not match';
    }
    else if ($app->isEmail($_POST['email']))
    {
        $register_error_message = 'email already taken';
    }
    else if ($app->isUsername($_POST['username']) == true)
    {
        $register_error_message = 'username already taken';
    }
    elseif ($app->password_check($_POST['password']) == true)
    {
      $register_error_message = 'password must contain at least one number, at least one letter, at least one special character and  there have to be 8-12 characters';
    }
    else
    {
        $hash = md5(rand(0,1000));
        $user_id = $app->Register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm'], $hash);
        $_SESSION['id'] = $user_id;
        // send email
        if(!empty($user_id))
        {
          $toEmail = $_POST['email'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $actual_link = "http://$_SERVER[HTTP_HOST]" ."/camagru_final"."/verify.php?email=$toEmail&hash=$hash";
          $subject = "User Registration Activation Email";
          $content = "Thanks for registering with Kwezi's Camagru, your username='$username' and password='$password'. Click this link to activate your account." ."$actual_link";
          $mailHeaders = "From: Camagru\r\n";
          if(mail($toEmail, $subject, $content, $mailHeaders))
          {
            $message =  "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";
          }
          unset($_POST);
        }
    }
}

include ("resources/header.php");
 ?>

 <div>
     <h4>Register</h4>
     <?php
     if ($register_error_message != "")
     {
         echo '<div><strong>Error: </strong> ' . $register_error_message . '</div>';
     }
     else if ($message != "")
     {
         echo '<script> alert ("Hello: '.$message.'")</script>';
     }
     ?>
     <form action="register.php" method="post">
     <div>
             <label for="">Username</label>
             <input type="text" name="username" class="form-control" placeholder="Enter username"/>
         </div>
         <div>
             <label for="">Email</label>
             <input type="email" name="email" class="form-control" placeholder="Enter email" />
         </div>

         <div>
             <label for="">Password</label>
             <input type="password" name="password" class="form-control" placeholder="Enter password"/>
         </div>
         <div>
             <label for="">Password Confim</label>
             <input type="password" name="password_confirm" class="form-control" placeholder="Confirm password"/>
         </div>
         <div>
             <input type="submit" name="btnRegister" class="btn btn-primary" value="register"/>
         </div>
     </form>
     <div>
       <p>
        Already a member ? <a href="login.php" ><input type="submit" name="btnLogin" value="Login"/></a>
     </p>
         </div>
 </div>

 <?php include ("resources/footer.php"); ?>

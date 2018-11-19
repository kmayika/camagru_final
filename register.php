<?php
// session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);

require ("library/library.php");
$app = new DemoLib();

$login_error_message = '';
$register_error_message = '';
$message = '';




//check register request
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
    else
    {
        $user_id = $app->Register($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm']);
        $_SESSION['id'] = $user_id;
        // send email
        if(!empty($user_id))
        {
          $actual_link = "http://$_SERVER[HTTP_HOST]" ."/camagru_final"."/login.php";
          $toEmail = $_POST['email'];
          $subject = "User Registration Activation Email";
          $content = "Click this link to activate your account." ."$actual_link";
          $mailHeaders = "From: Admin\r\n";
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

 <div class="col-md-5">
     <h4>Register</h4>
     <?php
     if ($register_error_message != "")
     {
         echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $register_error_message . '</div>';
     }
     else if ($message != "")
     {
         echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $message . '</div>';
     }
     ?>
     <form action="register.php" method="post">
     <div class="form-group">
             <label for="">Username</label>
             <input type="text" name="username" class="form-control" placeholder="Enter username"/>
         </div>
         <div class="form-group">
             <label for="">Email</label>
             <input type="email" name="email" class="form-control" placeholder="Enter email" />
         </div>

         <div class="form-group">
             <label for="">Password</label>
             <input type="password" name="password" class="form-control" placeholder="Enter password"/>
         </div>
         <div class="form-group">
             <label for="">Password Confim</label>
             <input type="password" name="password_confirm" class="form-control" placeholder="Confirm password"/>
         </div>
         <div class="form-group">
             <input type="submit" name="btnRegister" class="btn btn-primary" value="register"/>
         </div>
     </form>
     <div class="form-group">
       <p>
        Already a member ? <a href="login.php" ><input type="submit" name="btnLogin" value="Login"/></a>
     </p>
         </div>
 </div>

 <?php include ("resources/footer.php"); ?>

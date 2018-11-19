<?php

session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);

require ('library/library.php');
$app = new DemoLib();

$login_error_message = '';

//check login request
if (isset($_POST['btnLogin']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username))
    {
        $login_error_message = 'Username field is required';
    }
    else if (empty($password))
    {
        $login_error_message = 'Password field is required';
    }
    else
    {
        //check if username and password is okay
        $user_id = $app->Login($username, $password);
        if ($user_id > 0)
        {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $user_id; //sset session if password and user exist
            header ("location:template.php");
        }
        else
        {
            $login_error_message = 'Invalid login details';
        }
    }

}
include ("resources/header.php");
?>

<!-- <html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/bootstrap.css">
</head> -->
<body>
<div class="row">
        <div class="col-md-5">
            <h4>Login</h4>
            <?php
            if ($login_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
            ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="">Username/Email</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username/email"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnLogin" class="btn btn-primary" value="Login"/>
                </div>

			</form>
			<div class="form-group">
				<p>
                   Not a member ? <a href="register.php" ><input type="submit" name="btnLogin" value="Register"/></a>
				</p>
				</div>
        </div>
    </div>
</body>
 <?php include ("resources/footer.php"); ?>

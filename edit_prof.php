<?php
session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);

require ("class/library.class.php");
$app = new DemoLib();
$register_error_message = "";
$message = "";
  $id = $_SESSION['id'];
  if (isset($_POST['save']))
  {
    if (!empty($_POST['email']))
    {
      if ($app->isEmail($_POST['email']) == false)
      {
        $app->update_email($_POST['email'], $id);
        // echo $_POST['email'];

      }
      else {
        echo "email exists";
      }
    }
    else if (!empty($_POST['username']))
    {
        if ($app->isUsername($_POST['username']) == false)
        {
          $app->update_username($_POST['username'], $id);
        }
        else {
          echo "username exists";
        }
    }
    echo "<script>alert ('Profile edited')</script>";
    header("refresh:0.01; url=logout.php");
  }
 ?>
 <div>
     <h4>Edit Profile</h4>
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
     <form action="edit_prof.php" method="post">
     <div>
             <label for="">Username</label>
             <input type="text" name="username" placeholder="Enter new username"/>
         </div>
         <div>
             <label for="">Email</label>
             <input type="email" name="email" placeholder="Enter new email" />
         </div>
         <div>
             <input type="submit" name="save" value="Save"/>
         </div>
     </form>
     <div>
       <p>

         <a href="forgot.php" ><input type="submit" name="password" value="Change Password"/></a>
         <a href="profile/profile.php" ><input type="submit" name="btnLogin" value="Cancel"/></a>
     </p>
         </div>
 </div>

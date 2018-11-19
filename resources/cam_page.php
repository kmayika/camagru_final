<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    echo "<form action='../login.php'><p>Please Login :<input type='submit' name=btn/ value='Login'></p></form>";
    // header("location: login.php");
  }
?>

<?php

session_start();
$user = $_SESSION['username'];
echo '<div id="wholepage">
        <div id="banner">
            <h1 id="webname">PHOTO BOOTH</h1>
        </div>
        <nav id="navigation">
            <ul id="nav_list">
                <div id="center"><li class="tooltip"><a href="../template.php"><img id="logo" src="../photos/home_logo.png"><span class="tooltiptext">Home</span></a></li></div>
                <div id="center"><li class="tooltip"><a href="../webcam/cam.php"><img id="logo" src="../photos/cam_logo.png"><span class="tooltiptext">Take pic</span></a></li></div>
                <div id="center"><li class="tooltip"><a href="../profile/profile.php"><img id="logo" src="../photos/user_logo.png"><span class="tooltiptext">';
?>
<?php
echo $user;
echo '</span></a></li></div>';
echo '<div id="center"><li class="tooltip"><a href="../logout.php"><img id="logo" src="../photos/logout_logo.png"><span class="tooltiptext">logout</span></a></li></div>
           </ul>
       </nav>
       <div id="content">
       <center><video id="video"></video></center>
       <div>
         <ul id="option_list">
         <div><li><a href="#" id="capture" class="capture_button" name="capture"><img id="logo_pic" src="../photos/cam_logo.png"></a><span class="tool_tip_text">Take Picture</span></li></div>
        <div><li><a href="#" id="edit" class="capture_button" name="edit"><img id="logo_pic" src="../photos/effects.png"></a></li></div>
        <div><li><a href="#" id="save" class="capture_button" name="save"><img id="logo_pic" src="../photos/save.png"></a></li></div>
      </ul>
       </div>
       </div>

       <div id="sidebar">
       <canvas id="canvas" name="photo" ></canvas>
       <input type="text" id="comment" name="comment" placeholder="Add Caption">
       </div>
   </div>

   <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
   <script src="../javascripts/photo.js"></script>
   <script src="../javascripts/frame_edits.js"></script>
   <script src="../javascripts/save_image.js"></script>';
?>

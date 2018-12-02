<?php
  session_start();
  if (!isset($_SESSION['id']))
  {
    echo "<script> alert ('Please login')</script>";
    header("refresh:0.01; url=../login.php");
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
         <ul id="option_list"  class="navigation">
         <div class="tooltip"><li><a href="#" id="capture" class="capture_button" name="capture"><img id="logo_pic" src="../photos/cam_logo.png"><span class="tooltiptext">Take Snap</span></a></li></div>
        <div class="tooltip"><li><a href="#" id="edit" class="capture_button" name="edit"><img id="logo_pic" src="../photos/effects.png"><span class="tooltiptext">Click for stickers</span></a></li></div>
        <div class="tooltip"><li><a href="cam.php" id="save" class="capture_button" name="save"><img id="logo_pic" src="../photos/save.png"><span class="tooltiptext">Save Snap</span></a></li></div>
      </ul>
       </div>
       </div>

       <div id="sidebar">
       <canvas id="canvas" name="photo" ></canvas>
       </div>
       <form action="../upload.php" method="post" enctype="multipart/form-data">
    <div id="upload"><p>Select image to upload:
    <input type="file" name="image" >
    <input type="submit" value="Upload Image" name="submit"></p><div>

</form>
   </div>
   <script src="../javascripts/photo.js"></script>
   <script src="../javascripts/frame_edits.js"></script>
   <script src="../javascripts/save_image.js"></script>';
   require ('thumbnails.php');
   $images = glob("../photos/*.{jpg,gif,png}", GLOB_BRACE);
   echo '<select name="image">';
   foreach($images as $image)
   {
     echo '<option>' . basename($image) . '</option>';
   }
   echo '</select>';
?>

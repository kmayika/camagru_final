<?php

session_start();
$user = $_SESSION['username'];
echo '<div id="wholepage">
        <div id="banner">
            <h1 id="webname">CAMAGRU</h1>
        </div>
        <nav id="navigation">
            <ul id="nav_list">
                <div id="center"><li class="tooltip"><a href="template.php"><img id="logo" src="photos/home_logo.png"><span class="tooltiptext">Home</span></a></li></div>
                <div id="center"><li class="tooltip"><a href="webcam/cam.php"><img id="logo" src="photos/cam_logo.png"><span class="tooltiptext">Take pic</span></a></li></div>
                <div id="center"><li class="tooltip"><a href="profile/profile.php"><img id="logo" src="photos/user_logo.png"><span class="tooltiptext">';
?>
<?php
echo $user;
echo '</span></a></li></div>';
echo '<div id="center"><li class="tooltip"><a href="logout.php"><img id="logo" src="photos/logout_logo.png"><span class="tooltiptext">logout</span></a></li></div>
           </ul>
       </nav>
       <div id="cont">
       <div id="content" class="hidden">
       <table>';
       ?>
         <?php
           include ("home_content.php");

        echo '</table>

       </div>
       </div>
       <footer>All rights reserved</footer>
   </div>';
?>

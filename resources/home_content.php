<?php
session_start();
require_once('config/database.php');
$i = 0;

$database = db_camagru();
$user_id = $_SESSION['id'];
$query = $database->prepare("SELECT * FROM db_camagru.images ORDER BY id DESC");
// $query->bindParam(":user_id",$user_id, PDO::PARAM_STR);
$query->execute();


while($row = $query->fetch(PDO::FETCH_ASSOC))
{
  $_SESSION['image'] = $row['image'];
  $IDstore = $row['id'];
     echo "
          <tr>
               <td>
                    <form action='upload.php' method='post'>
                    <a href='resources/comment_pic.php' name ='image'><img src='upload/{$row['image']}'/></a>
                    </form>";
                    if (isset($_POST["image"]))
                    {
                      echo "<p id='comment'>Comments : ".$row['comment'].$IDstore."</p>";
                    }


          echo     "</td>
          </tr>
     ";
}

// while ($row = $query->fetch(PDO::FETCH_ASSOC))
// {
//   if ($i%3 == 0)
//   {
//     echo "<tr>";
//   }
//   $_SESSION['image'] = $row['image'];
//   $IDstore = $row['id'];
//   // $comm = $_SESSION['comments'];
//   echo"<td><form  action='resources/comment_like.php' method='get'><img src='resources/get_image.php?id=".$IDstore."' class='gallery'><p>Likes : ".$row['likes']."</p><p>Id : ".$row['id']."</p><p id='comment'>Comments : ".$row['comment']."</p><input type='text' name='comment' placeholder='write comment'/><input type='submit' name=btn/ value='comment'></form></td>";
//   // print_r($_SESSION['image']);
//   if ($i%3 == 2)
//   {
//     echo "</tr>";
//   }
//   $i++;
// }
?>

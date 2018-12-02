<?php
session_start();
require_once('config/database.php');
$i = 0;

$database = db_camagru();
$user_id = $_SESSION['id'];
$query = $database->prepare("SELECT * FROM db_camagru.images ORDER BY creation_date DESC");
$query->execute();


while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
  $id = $row['id'];
  $query_2 = $database->prepare("SELECT * FROM db_camagru.comment WHERE post_id=:id");
  $query_2->bindValue(":id", $id);
  $query_2->execute();

  if ($i%3 == 0)
  {
    echo "<tr id='comment'>";
  }
  $_SESSION['image'] = $row['image'];
  echo"<td>
        <form  action='resources/comment_pic.php' method='get'>
          <img src='upload/{$row['image']}' class='gallery'>
          <p>Likes : ".$row['likes']."</p>
          <input type='text' name='comment' placeholder='write comment'/>
          <input type='hidden' name='id' value=".$row['id']." />
          <input type='hidden' name='user_id' value=".$row['user_id']." />
          <input type='submit' value='comment'>
          <a href='resources/like.php?id=".$row['id']."'>Like</a>
          <a href='resources/unlike.php?id=".$row['id']."'>Unlike</a>
        </form>";
        while ($row_2 = $query_2->fetch(PDO::FETCH_ASSOC))
        {
      echo "<div id='comment'><p> --> ".$row_2['comment']."</p></div>";
    }
    echo "</td>";
  if ($i%3 == 2)
  {
    echo "</tr>";
  }
  $i++;
}
?>

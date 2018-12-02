<?php
session_start();
require_once('../config/database.php');
$i = 0;

$database = db_camagru();
$user_id = $_SESSION['id'];
$query = $database->prepare("SELECT * FROM db_camagru.images WHERE user_id=:user_id ORDER BY creation_date DESC");
$query->bindParam(":user_id",$user_id, PDO::PARAM_STR);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC))
{
  if ($i%3 == 0)
  {
    echo "<tr>";
  }

  echo"<td>
              <img src='../upload/{$row['image']}' width='100' height='100'>
      </td>";
  if ($i%3 == 2)
  {
    echo "</tr>";
  }
  $i++;
}

?>

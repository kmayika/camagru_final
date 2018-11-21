<?php
require ("../config/database.php");
$database = db_camagru();
if(isset($_GET['id']))
{

  $id = $_GET['id'];
  $_SESSION['post_id'] = $_GET['id'];
  $query = $database->prepare("SELECT * FROM db_camagru.images WHERE id=:id");
  $query->bindValue(":id", $id);
  $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC))
    {
        $imageData = "upload/{$row['image']}";
    }
    header("content-type:image/png");
    echo $imageData;
}
else
{
    echo "Error!";
}

?>

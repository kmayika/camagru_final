<?php
    require_once('../config/database.php');
    session_start();

    $headers = getallheaders();
    if ($headers["Content-type"] == "application/json")
    {
      $_POST = json_decode(file_get_contents("php://input"), true);
      $img = $_POST['image'];
      $folderPath = "../uploads/";
      $image_parts = explode(";base64,", $img);
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];

      $image_base64 = base64_decode($image_parts[1]);
      $fileName = uniqid() . '.png';
      $file = $folderPath . $fileName;
      file_put_contents($file, $image_base64);
      $database = db_camagru();
      $query = $database->prepare("INSERT INTO db_camagru.images (user_id,image, creation_date) VALUES (:user_id,:image,CURTIME())");
      $query->bindValue(":image", $fileName);
      $query->bindValue(":user_id", $user_id);
      $query->execute();
      $post_id = $database->lastInsertId();
      $_SESSION['post_id'] = $post_id;
      $_SESSION['name'] = $fileName;
    }
?>

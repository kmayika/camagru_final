<?php
require_once('../config/database.php');
    session_start();
    $img = $_POST['image'];
    $database = db_camagru();
    $fileName = uniqid() . '.png';
    if(isset($_POST["insert"]))
    {
       $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
       $user_id = $_SESSION['id'];
       $query = $database->prepare("INSERT INTO db_camagru.images (user_id,image, creation_date) VALUES (:user_id,:image,CURTIME())");
       $query->bindValue(":image", $image);
       $query->bindValue(":user_id", $user_id);
       $query->execute();
       if($query)
       {
         echo '<script>alert("Image Inserted into Database")</script>';
       }
       else {
         echo "string";
       }
    }
    ?>

    <!DOCTYPE html>
    <html>
      <head>
           <title>Webslesson Tutorial | Insert and Display Images From Mysql Database in PHP</title>
           <link rel="stylesheet" href="../css/bootstrap.css" />
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:500px;">
                <h3 align="center">Insert and Display Images From Mysql Database in PHP</h3>
                <br />
                <form method="post" enctype="multipart/form-data">
                     <input type="file" name="image" id="image" />
                     <br />
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
                </form>
                <br />
                <br />
                <table class="table table-bordered">
                     <tr>
                          <th>Images</th>
                     </tr>
                <?php
                $query = $database->prepare("SELECT * FROM db_camagru.images ORDER BY id DESC");
                $query->execute();
                while($row = $query->fetch(PDO::FETCH_ASSOC))
                {
                     echo '
                          <tr>
                               <td>
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" /><p id="comment">Comments : '.$row["comment"].'</p>
                               </td>
                          </tr>
                     ';
                }
                ?>
                </table>
           </div>
      </body>
    </html>

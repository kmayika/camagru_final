<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

require_once("config/database.php");
class DemoLib
{
    //register user and return id
    public function Register($username, $email, $password, $confirm, $hashed)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("INSERT INTO db_camagru.users (username, email, hash,password, password_confirm) VALUES (:username, :email,:hashed, :password, :confirm)");
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':hashed', $hashed, PDO::PARAM_STR);
            $hash = hash('sha256',$password);
            $query->bindParam(':password', $hash, PDO::PARAM_STR);
            $confirm_hash = hash('sha256',$confirm);
            $query->bindParam(':confirm', $confirm_hash, PDO::PARAM_STR);
            $query->execute();
            return $database->lastInsertId();//check user id currently on session
        }
        catch (PDOException $e)
        {
            echo $query . $e->getMessage();
        }
    }
    //check username
    public function isUsername($username)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("SELECT id FROM db_camagru.users WHERE username=:username ");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            exit($e->getMessage());
        }
    }
    //check email
    public function isEmail($email)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("SELECT id FROM db_camagru.users WHERE email=:email ");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            exit($e->getMessage());
        }
    }
    //check login
    public function Login($username, $password)
    {
        try
        {
            $database = db_camagru();
            // $database->beginTransaction();
            $query = $database->prepare("SELECT id FROM db_camagru.users WHERE (username=:username OR email=:username) AND password=:password");
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $hash = hash('sha256', $password);
            $query->bindParam(':password', $hash, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0)
            {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->id;
            }
            else
            {
                return false;
            }
        }
        catch (PDOException $e)
        {
            exit($e->getMessage() . "kwezi");
        }
    }
    //get user detail
    public function UserDetails($user_id)
    {
        try {
            $database = db_camagru();
            $query = $database->prepare("SELECT id, username, email FROM db_camagru.users WHERE user_id=:id");
            $query->bindParam("id", $user_id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function pic_upload($image, $user_id)
    {
      try
      {
          $database = db_camagru();
          $query = $database->prepare("INSERT INTO db_camagru.images (user_id,image, creation_date) VALUES (:user_id,:image,CURTIME())");
          $query->bindParam(':image', $image, PDO::PARAM_STR);
          $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
          $query->execute();
          return $database->lastInsertId();
      }
      catch (PDOException $e)
      {
          exit($e->getMessage());
      }

    }

    // public function getPhoto()
    // {
    //     try
    //     {
    //         $database = db_camagru();
    //         $query = $database->prepare("SELECT * FROM db_camagru.images");
    //         if ($query)
    //         {
    //             echo "<ul id ='photos'> \n";
    //             while ($row = $query->fetch(PDO::FETCH_ASSOC))
    //             {
    //                 $comment = $row['comment'];
    //                 $image = $row['image'];
    //                 $id = $row['id'];
    //
    //                 echo "<li><a title='$title' href='../upload/$src'><<img src='../upload/$src' id='$id' alt='$title' /> </a>";
    //                 echo "<h4>$title</h4> \n";
    //                 echo "<input type='text' name='title' value='$title' /></li> \n \n";
    //             }
    //             echo "\n</ul>";
    //         }
    //     }
    //
    //     catch (PDOException $e)
    //     {
    //       exit($e->getMessage());
    //     }
    // }

    // public function show_picture()
    // {
    //   $database = db_camagru();
    //   $query = $database->prepare("SELECT * FROM db_camagru.images WHERE id = ?");
    //   $query->bindParam(1,$_GET['id']);
    //   $query->execute();
    //   while ($row = $query->fetch(PDO::FETCH_ASSOC))
    //   {
    //   echo "<div id='img_div'>";
    //   	echo "<img src='images/".$row['image']."' >";
    //   	echo "<p>".$row['image_text']."</p>";
    //   echo "</div>";
        // $row = $query->fetch(PDO::FETCH_ASSOC);
        // header ("content-type: image/jpg");
        // print $row['data'];
        // exit;
    //   }
    // }
    // public function csv_store($photo)
    // {
    //         $file_open = fopen("./photo.csv", "a");
    //         //no of rows
    //         $no_rows = count(file("./photo.csv"));
    //         //generate serial no.
    //         if ($no_rows > 1)
    //         {
    //             $no_rows = ($no_rows - 1) + 1;
    //         }
    //         $date = "080808";
    //         $pic_data = array(
    //             'serial_no' => $no_rows,
    //             'creation_date' => $date,
    //             'photo' => $photo
    //
    //         );
    //         //write in csv
    //         fputcsv($file_open, $pic_data);
    // }
}

?>

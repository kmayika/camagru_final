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
            return $database->lastInsertId();
        }
        catch (PDOException $e)
        {
            echo $query . $e->getMessage();
        }
    }
    //password check
    public function password_check($password)
    {
      try
      {
        $database = db_camagru();
        $query = $database->prepare("SELECT id FROM db_camagru.users WHERE username=:username ");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password))
        {
          {
              return true;
          }
        }
        else
        {
            return false;
        }
      }
      catch (PDOException $e)
      {
        echo $query . $e->getMessage();
      }

    }
    public function update_password($password, $id)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("UPDATE db_camagru.users SET password=:password WHERE id=:id ");
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->execute();
            
        }
        catch (PDOException $e)
        {
            exit($e->getMessage());
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
    public function update_username($username, $id)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("UPDATE db_camagru.users SET username=:username WHERE id=:id ");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->execute();

        }
        catch (PDOException $e)
        {
            exit($e->getMessage());
        }
    }
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
    public function update_email($email, $id)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("UPDATE db_camagru.users SET email=:email WHERE id=:id ");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->execute();

        }
        catch (PDOException $e)
        {
            exit($e->getMessage());
        }
    }
    public function Login($username, $password)
    {
        try
        {
            $database = db_camagru();
            $query = $database->prepare("SELECT id,active FROM db_camagru.users WHERE (username=:username OR email=:username) AND password=:password");
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $hash = hash('sha256', $password);
            $query->bindParam(':password', $hash, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0)
            {
              $result = $query->fetch(PDO::FETCH_ASSOC);
              if ($result['active'] > 0)
              {
                return $result['id'];
              }
              else
              {
                echo "<script>alert ('Please click on activation that was sent to your email')</script>";
              }
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
}

?>

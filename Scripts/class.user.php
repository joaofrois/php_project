<?php

class USER{

    private $db;

    function __construct($DB_con){
        $this->db =$DB_con;
    }

    public function register($name, $email, $pass){

      try{  
        $new_password = password_hash($pass, PASSWORD_DEFAULT);

        $smtm = $this->db->prepare("INSERT INTO user(name, email, password) VALUES(:name, :email,:pass)");


        $smtm->bindparam(":name", $name);
        $smtm->bindparam(":email", $email);
        $smtm->bindparam(":pass", $new_password);
        $smtm->execute();

        return $smtm;
      }
      catch(PDOException $e){
          echo$e->getMessage();
      }

    }
    public function login($name,$pass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM user WHERE name=:name  LIMIT 1");
          $stmt->execute(array(':name'=>$name));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($pass, $userRow['password']))
             {
                $_SESSION['user_session'] = $userRow['idUser'];
                return true;
                
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>


}
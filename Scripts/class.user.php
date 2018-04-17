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
                 unset($userRow['pass']);
                $_SESSION['user_session'] = $userRow;
               
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

   public function getName(){
        // $stmt =$this->db->prepare("SELECT name FROM user WHERE idUser=:id  LIMIT 1");
        // $stmt->execute(array(':id'=>$_SESSION['user_session']));
        // $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $_SESSION['user_session']['name'];
   }
   
   public function addSite($name, $url, $category){
       try{
    
        $stmt = $this->db->prepare("INSERT INTO sites( name, url, Category_idCategory) VALUES(:name, :url, :category)");
        $stmt->bindparam(":name", $name);
        $stmt->bindparam(":url", $url);
        $stmt->bindparam(":category", $category);
        $stmt->execute();

        $stmt = $this->db->prepare("SELECT idSites from sites WHERE url=:url ");
        $stmt->bindparam(":url", $url);
        $stmt->execute();
        $siteId=$stmt->fetch(PDO::FETCH_ASSOC);
        $siteId =  $siteId["idSites"];
        
        $userId =$_SESSION['user_session']['idUser'];


        $stmt = $this->db->prepare("INSERT INTO favorites( Sites_idSites, User_idUser) VALUES(:siteId, :userId)");
        $stmt->bindparam(":siteId", $siteId );
        $stmt->bindparam(":userId", $userId);
        $stmt->execute();


        
        
   }
   catch(PDOException $e){
        echo$e->getMessage();
    
   }
}

 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>

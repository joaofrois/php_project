<?php
require_once 'Scripts/databaseConfig.php';

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
   $name = trim($_POST['name']);
   $email = trim($_POST['email']);
   $pass = trim($_POST['password']); 
 
   if($name=="") {
      $error[] = "provide username !"; 
   }
   else if($email=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($pass=="") {
      $error[] = "provide password !";
   }
   else if(strlen($pass) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT name,email FROM user WHERE name=:name OR email=:email");
         $stmt->execute(array(':name'=>$name, ':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['name']==$name) {
            $error[] = "sorry username already taken !";
         }
         else if($row['email']==$email) {
            $error[] = "sorry email id already taken !";
         }
         else
         {
            if($user->register($name,$email,$pass)) 
            {
                $user->redirect('index.php');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
<!DOCTYPE html>
<html>
<head>

<title>Register Bookit</title>

<link rel="stylesheet" href="Styles/main.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <span> Successfully registered<span> <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <input type="text" name="name" placeholder="Enter Username" value="<?php if(isset($error)){echo $name;}?>" />
            <input type="text"  name="email" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $email;}?>" />
           <input type="password"  name="password" placeholder="Enter Password" />
           
             <button type="submit" name="btn-signup">
                 SIGN UP
                </button>
            </div>
            <br />
            <label>have an account?<a href="index.php">Sign In</a></label>
        </form>
       </div>
</div>

</body>
</html>
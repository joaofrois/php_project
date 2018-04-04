<?php
require_once 'Scripts/databaseConfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
    $name = $_POST['username'];
    $pass = $_POST['password'];
  
 if($user->login($name,$pass))
 {
  $user->redirect('home.php');
 }
else
 {
  $error = "Wrong Details !";
 } 
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/main.css" type="text/css">
    <title>BookiT</title>
</head>

<body>
    <div class="welcome">
        <h2>Welcome to BookiT</h2>
    </div>
    <div class="formContainer">
        <form method="post">
        <h2>Sign in.</h2><hr />
            <?php
            if(isset($error))
            {
                 echo $error;
                  
            }
            ?>
            <div class="usernameContainer">
                <label for="username">Username: </label>
                <input type="text" name="username" >
            </div>
            <div class="passwordContainer">
                <label for="password">Password: </label>
                <input type="password" name="password">
            </div>

            <a href="register.php">Create an Account</a>
            <button type="submit" name="btn-login">Login</button>

        </form>
    </div>
</body>

</html>
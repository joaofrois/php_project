<?php
require_once 'Scripts/databaseConfig.php';

if($user->is_loggedin()!="")
{
    $username= $user->getName();
}
if(isset($_GET['logout'])){
    $user->logout();
    $user->redirect("index.php");
}

if(isset($_POST['addSiteBtn']))
{
   $name = trim($_POST['name']);
   $url = trim($_POST['site']);
   $category = trim($_POST['category']);

   $user->addSite($name, $url, $category);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Styles/main.css" type="text/css">
    <title>BookiT</title>
</head>

<body>
    <header class="mainHeader">
        <div class="homepageLogo">
            <h1>BookiT</h1>
        </div>
        <div class="navMenu">
            <nav>
                <ul>
                    <li><a href="">Add a Site</a></li>
                    <li><a href="">Check Sites</a></li>
                    <li><a href="">Check Charts</a></li>
                    <li> <a href="?logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="mainContent">
        <div class="registerText">
            <h3>Welcome <?php echo $username; ?></h3>
        </div>
        <div class="formContainerSites">
            <form method="post">

                <div class="nameContainer">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="urlContainer">
                    <label for="site">Site: </label>
                    <input type="url" name="site" id="site">
                </div>
                <div class="typeContainer">
                        <select name="category">
                                <option value="1">Tech</option>
                                <option value="2">Scince</option>
                                <option value="3">Humor</option>
                                <option value="4">News</option>
                            </select>
                </div>
                
                <div class="buttonContainer">
                    
                    <button type="submit" name="addSiteBtn">Add Site</button>
                </div>
            </form>
        </div>

    </main>
</body>

</html>
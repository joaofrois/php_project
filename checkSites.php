<?php
require_once 'Scripts/databaseConfig.php';

if($user->is_loggedin()!="")
{
    $username= $user->getName();
    $sitelist= $user->getSites();
    
    
    

    

}

if(isset($_GET['siteid'])){
    $user->removeSite($_GET['siteid']);
    

    

}


if(isset($_GET['logout'])){
    $user->logout();
    $user->redirect("index.php");
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
                    <li><a href="home.php">Add a Site</a></li>
                    <li><a href="checkSites.php">Check Sites</a></li>
                    <li> <a href="?logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="mainContent">
        <div class="registerText">
            <h3>Welcome <?php echo $username; ?></h3>
        </div>
        <div>
            <h2>List of sites</h2>
        </div>
        <pre>
        
    <table>
    <thead>
    <tr>
    <th>Name</th>
    <th>Url</th>
    <th>Category</th>
    <th>Remove</th>
    </tr>
    </thead>
    
    


    

         <?php
    
           foreach($sitelist as $value){
            $idCat = $value["Category_idCategory"];
            $category = $user->getCategory($idCat);


               
            echo "<tr>".
                    "<td>".$value["name"]."</td>".
                    "<td>".$value["url"]."</td>".
                    "<td>".$category["name"]."</td>".
                    "<td><a href='?siteid=".$value["idSites"]."'>Remove</a></td>".
                 "</tr>";
           }

           
         
             
         ?>

         </table>
         

    </main>
</body>

</html>
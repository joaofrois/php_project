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
                    <li><a href="">Log out</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="mainContent">
        <div class="registerText">
            <h3>Welcome "username"</h3>
        </div>
        <div class="formContainerSites">
            <form method="post">
                <div class="urlContainer">
                    <label for="site">Site: </label>
                    <input type="url" name="site" id="site">
                </div>
                <div class="typeContainer">
                        <select>
                                <option value="Tech">Tech</option>
                                <option value="Scince">Scince</option>
                                <option value="Humor">Humor</option>
                                <option value="News">News</option>
                            </select>
                </div>
                
                <div class="buttonContainer">
                    
                    <button type="submit">Add Site</button>
                </div>
            </form>
        </div>

    </main>
</body>

</html>
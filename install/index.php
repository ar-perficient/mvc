<?php require './install.php'; ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Install MVC</title>
        <link href="<?php echo $app->getInstallPath();?>css/style.css" rel="stylesheet" type="text/css"  media="all" />
    </head>
    <body>
        <div class="main">
            <form>
                <ul class="left-form">
                    <h2>New Account:</h2>
                    <li>
                        <input type="text" required="" placeholder="Username">
                        <a class="icon ticker" href="#"> </a>
                        <div class="clear"> </div>
                    </li> 
                    <li>
                        <input type="text" required="" placeholder="Email">
                        <a class="icon ticker" href="#"> </a>
                        <div class="clear"> </div>
                    </li> 
                    <li>
                        <input type="password" required="" placeholder="password">
                        <a class="icon into" href="#"> </a>
                        <div class="clear"> </div>
                    </li> 
                    <li>
                        <input type="password" required="" placeholder="password">
                        <a class="icon into" href="#"> </a>
                        <div class="clear"> </div>
                    </li> 
                    <label class="checkbox">
                        <input type="checkbox" checked="" name="checkbox" /><i> </i>
                        Please inform me of upcoming  w3layouts, Promotions and news
                    </label>
                    <input type="submit" value="Create Account" onclick="myFunction()">
                    <div class="clear"> </div>
                </ul>
                <ul class="right-form">
                    <h3>Login:</h3>
                    <div>
                        <li>
                            <input type="text" required="" placeholder="Username">
                        </li>
                        <li> 
                            <input type="password" required="" placeholder="Password">
                        </li>
                        <h4>I forgot my Password!</h4>
                        <input type="submit" value="Login" onclick="myFunction()">
                    </div>
                    <div class="clear"> </div>
                </ul>
                <div class="clear"> </div>
            </form>
        </div>
    </body>
</html>
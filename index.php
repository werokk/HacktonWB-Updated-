<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, ">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body background="Background.png">
<h1 align="center">Hackaton</h1>
  <div class="log">
    <form action="validation.php" method="post">

      <input  type="text" spellcheck="false" class="text-line"  id="username" name="username" placeholder="Username" required>

      <input style="float: right;" type="password" spellcheck="false" class="text-line"  id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit"class="btn" style="width: 417px;height: 93px;background: url(Login_button.png);"> </button>
      <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span>$error</span>";
                    }
                ?>  
      
    </form>
    




  <h2 style="margin-top:312px;text-align:  center;">New to the Hackaton?<a href="register.php" style="color: yellow;">Sign up</a></h2>
   




  </body>
</html>


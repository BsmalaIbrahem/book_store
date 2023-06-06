<?php include "nav.php"; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
         <form action="" method="post" class="bg-light">
                <h1>login</h1>
                <div>
                    <input type="email" placeholder="enter email" name="email" required="">
                </div>

                <div>
                    <input type="password" placeholder="enter password" name="password" required="">
                </div>
                <input type="submit" value="login" name="login"  class="btn btn-dark btn-md">
                <hr>
                <a href="register.php">i don't have account !</a>
         </form>
    </body>
</html>
<?php
  if(isset($_POST['login'])){
      $user = new sign_in();
      $user->login($_POST['email'], $_POST['password']);
  }

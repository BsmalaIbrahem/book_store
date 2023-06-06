<!DOCTYPE html>
<?php include "nav.php"; ?>
<html>
    <head>
        <title>register</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
      <form action="" method="post" class="bg-light">
        <h1>register</h1>
        <div>
            <input type="text" placeholder="enter user-name" name="username" required="">
        </div>
        
        <div>
            <input type="email" placeholder="enter email" name="email" required="">
        </div>
  

        <div class="otherInfo">
            <div>
                <input type="password" placeholder="enter password" name="password" required="">
                <input type="password" placeholder="confirm password" name="cpassword" required="">
            </div>
            <select name="field">
                <option hidden="">interests</option>
                <?php
                  $query = $connect->prepare('select * from booksKinds');
                  $query->execute();
                  $results = $query->get_result();
                  foreach ($results as $interest){
                      echo '<option>'.$interest['kind'].'</option>';
                  } ?>
            </select>
            
            <select name="country" class="my-2">
                <option hidden="">country</option> 
                <option>Egypt</option> 
            </select>
            <div>
                <input type="text" placeholder="address" name="address">

                <input type="text" placeholder="phone number" name="phone">
            </div>
        </div>
        
        <div class="gender">
            <span>gender : </span>
            <input  type="radio" value="male" name="gender" required="">
            <label>male</label>
            <input  type="radio" value="female" name="gender" required="">
            <label>female</label>
        </div>
        <input type="submit" value="Register" name="register"  class="btn btn-dark btn-md">
        <hr>
        <a href="login.php">i have account !</a>
      </form>
    </body>
</html>
<?php
   if(isset($_POST['register'])){
       $userName=$_POST['username'];
       $email = $_POST['email'];
       $password = $_POST['password'];
       $confirmPass = $_POST['cpassword'];
       $interest = $_POST['field'];
       $country = $_POST['country'];
       $address = $_POST['address'];
       $phone = $_POST['phone'];
       $gender = $_POST['gender'];
       
       $user = new sign_up();
       $user->register($userName, $email, $password, $confirmPass, $interest, $country, $address, $phone, $gender);
   }
   

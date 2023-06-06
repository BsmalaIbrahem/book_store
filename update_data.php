<!DOCTYPE html>
<?php
  include_once 'nav.php';
  $update_name = $_GET['update_name'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
                form{
                        max-width:400px;
                        margin:auto;
                        margin-top:100px;
                        padding:10px 5px;
                }
                form h3{
                    text-align:center;
                    text-transform:capitalize;
                }
                form div{
                        margin:20px 0;
                        width:100%;
                }
                form div button{
                        width:100px;
                }
                form div input[type="text"],input[type='password'],input[type='email'],form div select{
                        width:90%;
                        outline:0;
                        margin-left:10px
                }
        </style>
    </head>
    <body>
        <?php
          if($update_name == 'userName'){
              
        ?>
        <form method="post" class="bg-light ">
            <h3 >update user_name</h3>
            <div>
                <input type="text" name="userName" value="<?=Session::get_session('userName')?>" required="">
            </div>
            <div>
                <input type="password" name="password" placeholder="confirm password" required="">
            </div>
            <input type="submit" name="updateUserName" value="update"class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
        </form>
        <?php } ?>
        
        
        
       <?php
          if($update_name == 'email'){
              
        ?>
        <form method="post" class="bg-light ">
            <h3 >update email</h3>
            <div>
                <input type="email" name="email" value="<?=Session::get_session('email')?>"   required="">
            </div>
            <div>
                <input type="password" name="password" placeholder="confirm password" required="">
            </div>
            <input type="submit" name="updateEmail" value="update"class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
        </form>
        <?php } ?>
        
        
        
        <?php
          if($update_name == 'interests'){
              
        ?>
        <form method="post" class="bg-light ">
            <h3 >update interests</h3>
            <div>
                <input type="text" readonly="" id="kind" name="interest" value="<?=Session::get_session('field')?>">
                <select id="kindOptions" >
                    
                    <?php
                      $kindBook = new person();
                      $bookskinds   = $kindBook->view_books_kinds();
                      foreach ($bookskinds as $kind){
                          echo '<option>'.$kind['kind'].'</option>';
                      }
                    ?>
                </select>
            </div>
            <div>
                <input type="password" name="password" placeholder="confirm password">
            </div>
            <input type="submit" name="updateInterest" value="update"class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
        </form>
        <script>
                var kind =  document.getElementById('kind');
                var kindOptions      =  document.getElementById('kindOptions');
                kindOptions.onchange = function changeValue(){
                    kind.value = kindOptions.value;
                }
        </script>
        <?php } ?>
        
        <?php
          if($update_name == 'password'){
              
        ?>
        <form method="post" class="bg-light ">
            <h3 >update password</h3>
            <div>
                <input type="password" name="current_password" placeholder="current_password"" required="">
            </div>
            <div>
                <input type="password" name="New_password" placeholder="new password" required="">
            </div>
            <div>
                <input type="password" name="confirm_New_password" placeholder="confirm new password"required="">
            </div>
            <input type="submit" name="updatePassword" value="update"class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
        </form>
        <?php } ?>
        
        <?php
          if($update_name == 'otherData'){
              
        ?>
        <form method="post" class="bg-light ">
            <h3 >update other Data</h3>
            <div>
                <input type="text" name="country" readonly="" placeholder="country" value="<?=Session::get_session('country')?>">
                <select>
                    <option>Egypt</option> 
                </select>
            </div>
            <div>
                <input type="text" name="address" placeholder="new address" value="<?=Session::get_session('address')?>"required="">
            </div>
            <div>
                <input type="text" name="phoneNumber" placeholder="new phone number" value="<?=Session::get_session('phoneNumber')?>"required="">
            </div>
            
            <div>
                <input type="password" name="password" placeholder="confirm password" required="">
            </div>
            <input type="submit" name="updateotherDate" value="update"class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
        </form>
        <?php } ?>
        
    </body>
</html>

<?php
   $user = new person();
   if(isset($_POST['updateUserName'])){
       $user->updateUserName($_POST['userName'], $_POST['password']);
   }
   
   elseif(isset($_POST['updateEmail'])){
       $user->update_email($_POST['email'], $_POST['password']);
   }
   elseif(isset($_POST['updateInterest'])){
       $user->update_interests($_POST['interest'], $_POST['password']);
   }
   elseif(isset($_POST['updatePassword'])){
       $user->update_password($_POST['current_password'], $_POST['New_password'],$_POST['confirm_New_password']);
   }
   elseif(isset($_POST['updateotherDate'])){
       $user->update_address_and_phoneNumber($_POST['country'], $_POST['address'], $_POST['phoneNumber'], $_POST['password']);
   }
?>

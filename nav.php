<!DOCTYPE html>
<?php
    spl_autoload_register(function ($class){
        require 'classes/'.$class.'.php';
    });
    
    
    
    $connect = new mysqli('localhost','root','','onlineBook');
    Session::sessionStart();

?>
<html>
    
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="veiwPort" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
        <style>
            nav img {
                background-color:white;
                
            }
        </style>
           
 

    </head>
    
    <body>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top" >
            <?php if(@!Session::get_session('email')){?>
                <button class="btn btn-light mx-2" onclick="location='login.php'">Login</button>
            <?php }?>
           
            <h1 class="navbar-brand px-2 text-capitalize">online book</h1>
            
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#links">
                    <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end mx-5" id="links">
                <ul class="navbar-nav ">
                    <li class="nav-item mx-3 h4">
                            <a href="home.php" class="nav-link">home</a>
                    </li>
                    <?php if(@Session::get_session('admin')){?>
                     
                        <li class="nav-item mx-3 h4">
                        
                            <a href='add-book.php'class='nav-link'>add-book</a>
                            
                        </li>
                        
                        <li class="nav-item mx-3 h4">
                        
                            <a href='viewUsers.php'class='nav-link'>users</a>
                            
                        </li>
                    <?php }?>
                    

                    <li class="nav-item mx-3 h4">
                            <a href="contact_us.php"class="nav-link">contact-us</a>
                    </li>


                    <li class="nav-item dropdown mx-3 h4">
                        <?php
                           $disabled = " ";
                           if(@!Session::get_session('email'))
                               $disabled = "disabled";
                        ?>
                            <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown" <?=@$disabled?>>settings</a>
                            <ul class="dropdown-menu" style="width:100px">
                                    <li><a href="update_data.php?update_name=userName" class="dropdown-item">update userName</a></li>
                                    <li><a href="update_data.php?update_name=email" class="dropdown-item">update email</a></li>
                                    <li><a href="update_data.php?update_name=interests" class="dropdown-item">update interests</a></li>
                                    <li><a href="update_data.php?update_name=password" class="dropdown-item">update password</a></li>
                                    <li><a href="update_data.php?update_name=otherData" class="dropdown-item">update other data</a></li>
                                    <hr>
                                    <li><a href="signOut.php" class="dropdown-item">sign-out</a></li>
                            </ul>
                    </li>

                    <li class="nav-item mx-3">
                        <a href="show_orders.php"class="nav-link">
                      <img
                        src="images/cart.png"
                        alt="Shoping Cart"
                        width="28px"
                        height="28px"
                      />
                    </a>
                    </li>
                </ul>
            </div>
        </nav>
    </body>
</html>




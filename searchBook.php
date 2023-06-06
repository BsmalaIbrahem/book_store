<!DOCTYPE html>
<?php
  include 'nav.php';
  
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="home.css">
    </head>
    <body>
        
        <header style="margin-top:100px" >    
            <div class="search">
                <form action="searchBook.php" method="post" class="input-group">
                    <input type="search" name="searchText" required="">
                        <input type="submit" value="Go" name="search" class="btn btn-dark btn-lg">
                </form>
            </div>
            
        <?php
           if(isset($_POST['search'])){
                echo '</header>';
                $user = new person();
                $search_result = $user->search_for_book($_POST['searchText']);
                    
        ?>
        <section  id="section">
            <section id="all"  >
                <div class="d-flex flex-wrap ">
                <?php
                    foreach ($search_result as $book){
                ?>
                
                <div class="post bg-light  p-3 " >

                        <h3 class="text-center text-capitalize"><?=$book['bookName']?></h3>
                        <div class="info  my-3">
                            <ul class="" style="width:200px;">
                                    <li><span>kind : </span><?=$book['kind']?></li>
                                    <li><span>version : </span><?=$book['version']?></li>
                                    <li><span>author : </span><?=$book['author']?></li>
                                    <li><span>price : </span><?=$book['price']." ".$book['currency']?></li>
                            </ul>
                            <img src='<?=$book['image']?>' class="rounded" style="width:100px; margin-left:5px;">
                        </div>
                        <hr>
                        <?php
                        
                            $link = "?id=".$book['book_id'];
                            if(@Session::get_session('admin')){
                        ?>
                            <div class="btn btn-group">
                                    <button onclick="window.location='updateBook.php<?=$link?>'" class="btn btn-dark btn-lg my-3 mx-2">Update</button>
                                     <button onclick="window.location='deleteBook.php<?=$link?>'" class="btn btn-dark btn-lg">Delete</button>
                            </div>
                        <?php
                            }
                            else{
                        ?>
                       <button onclick="window.location='buyBook.php<?=$link?>'" class="btn btn-dark btn-lg" >Buy</button>

                        <?php }?>
                        </div>
                
           <?php }?>    
            </div>
            </section>
        </section>
                
            <?php }?>
            
    </body>
</html>

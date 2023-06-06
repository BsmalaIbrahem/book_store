<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>home</title>
        <link rel="stylesheet" href="home.css">
        <style>
        </style>
        
    </head>

    <body>
        
            
        <?php include 'searchBook.php';?>
            
           <ul class="list-unstyled nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#all" data-bs-toggle='tab'>all</a></li>
                <?php
                    $query = $connect->prepare('select * from booksKinds');
                    $query->execute();
                    $results = $query->get_result();
                    foreach ($results as $interest){
                ?>
                    <li class="nav-item">
                        <a href='<?="#".$interest['kind']?>'data-bs-toggle='tab' class="nav-link"><?=$interest['kind']?></a>
                    </li>

                <?php }?>
            </ul>
        </header>
       
        <section class="tab-content" id="section">
            <section id="all" class="tab-pane active  " >
                <div class="d-flex flex-wrap ">
                <?php
                    $view_books = new person();
                    $books = $view_books->view_books();
                    foreach ($books as $book){
                ?>
                
                <div class="post bg-light  p-3 " >

                        <h3 class="text-center text-capitalize"><?=$book['bookName']?></h3>
                        <div class="info  my-3">
                            <ul class="" style="width:200px;">
                                    <li><span>kind : </span><?=$book['kind']?></li>
                                    <li><span>version : </span><?=$book['version']?></li>
                                    <li><span>author : </span><?=$book['author']?></li>
                                    
                                    <?php 
                                       if(@Session::get_session('employee')){
                                           $employee = new employee();
                                    ?>
                                    <li><span>price : </span><?=$employee->discount_for_employee($book['price'])." ".$book['currency']?></li>
                                    <?php }
                                       else {
                                    ?>
                                        <li><span>price : </span><?=$book['price']." ".$book['currency']?></li>
                                    <?php }?>
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
         <?php
            $query = $connect->prepare('select * from booksKinds');
            $query->execute();
            $results = $query->get_result();
            foreach ($results as $interest){
            ?>
                <section class="tab-pane fade"  id="<?=$interest['kind']?>">
                    <div class="d-flex flex-wrap ">
                    <?php
                        $view_books = new person();
                        $books = $view_books->view_books();
                        foreach ($books as $book){
                           if($book['kind'] == $interest['kind']){
                    ?>

                        <div class="post bg-light  p-3 ">

                            <h3 class="text-center text-capitalize"><?=$book['bookName']?></h3>
                            <div class="info  my-3">
                                <ul class="">
                                        <li><span>kind : </span><?=$book['kind']?></li>
                                        <li><span>version : </span><?=$book['version']?></li>
                                        <li><span>author : </span><?=$book['author']?></li>
                                        <?php 
                                            if(@Session::get_session('employee')){
                                                $employee = new employee();
                                         ?>
                                         <li><span>price : </span><?=$employee->discount_for_employee($book['price'])." ".$book['currency']?></li>
                                         <?php }
                                            else {
                                         ?>
                                             <li><span>price : </span><?=$book['price']." ".$book['currency']?></li>
                                        <?php }?>
                                </ul>
                                    <img src='<?=$book['image']?>' class="rounded "style="width:100px; margin-left:5px;">
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

                        <?php }}?>
                    </div>
                </section>
            
                    <?php }?>
        </section>
 
    </body>
</html>

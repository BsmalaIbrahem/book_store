<?php
    include("nav.php");
    $id_book = $_GET['id'];

    $admin = new admin();
    $book_info = $admin->view_required_book($id_book);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>update book</title>
        <style>
                form{
                        max-width:450px;
                        margin:auto;
                        margin-top:100px;
                }
                form div{
                        margin:20px 0;
                        width:100%;
                }
                form div button{
                        width:100px;
                }
                form div input[type="text"]{
                        width:350px;
                        outline:0;
                }
                form div select{
                    width:100%;
                    outline:0;
                }
                form  img{
                    width:250px;
                    display:block;
                    margin:10px auto;
                }
         </style>
    </head>
    <body>
         <form action="" method="post" class="bg-light py-3"enctype="multipart/form-data">
            <h2 class="text-center text-capitalize">update book</h2>
            <div class="input-group">
                <button disabled="" class="btn btn-dark">kind</button>
                <input type="text" readonly="" name="kind" id="kind" value="<?=$book_info['kind']?>">
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
            <script>
                var kind =  document.getElementById('kind');
                var kindOptions      =  document.getElementById('kindOptions');
                kindOptions.onchange = function changeValue(){
                    kind.value = kindOptions.value;
                }
            </script>
            

            <div class="input-group">
                    <button disabled="" class="btn btn-dark">name</button>
                    <input type="text" name="name" required="" value="<?=$book_info['bookName']?>">
            </div>

            <div class="input-group">
                    <button disabled="" class="btn btn-dark">version</button>
                    <input type="text" name="version" required=""value="<?=$book_info['version']?>">
            </div>

            <div class="input-group">
                    <button disabled="" class="btn btn-dark">author</button>
                    <input type="text" name="author" required="" value="<?=$book_info['author']?>">
            </div>

            <div class="input-group">
                    <button disabled="" class="btn btn-dark">price</button>
                    <input type="text" name="price" required="" value="<?=$book_info['price']?>">
            </div>

            <div class="input-group">
                    <button disabled="" class="btn btn-dark">currency's</button>
                    <input type="text" readonly="" name="currency" id="currencyValue" value="<?=$book_info['currency']?>">
                    <select  id="currency">
                        <option value="EGP">EGP</option>
                        <option value="$">$</option>
                    </select>
            </div>
            <script>
                var currencyValue =  document.getElementById('currencyValue');
                var currencyoptions    =  document.getElementById('currency');
                currencyoptions.onchange = function changeValue(){
                    currencyValue.value = currencyoptions.value;
                }
            </script>
            

            <div class="input-group">
                    <button disabled="" class="btn btn-dark btn-sm" > image : </button>
                    <input type="file"   style="width:240px"  id="file">
                    
            </div>
            <textarea hidden="" readonly="" id="imagesrc" name="image" ><?=$book_info['image']?></textarea>
            <img src="<?=$book_info['image']?>" id="Image">
            
            <script>
                var file =  document.getElementById('file');
                var Image     =  document.getElementById('Image');
                var imagesrc    =  document.getElementById('imagesrc');
                file.onchange = function changeValue(){
                    Image.src = window.URL.createObjectURL(this.files[0]);
                    imagesrc.textContent = file.value;
                }
            </script>
            <input type="submit" value="update" name="update" class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
            </form>
        
    </body>
</html>
<?php 
  if(isset($_POST['update'])){
      
    $image = $_POST['image'];
    $imageEx = pathinfo($image,PATHINFO_BASENAME);
    $folder = 'images/'.$imageEx;
    $updateBook = new admin();
    $updateBook->update_book($id_book,$_POST['kind'], $_POST['name'],$_POST['version'], $_POST['author'], $_POST['price'], $_POST['currency'], $folder);
  }

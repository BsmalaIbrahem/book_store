<?php
//hello world
  include("nav.php");
  
?>

<!DOCTYPE html>
<html>
         <head>
            <title>add-book</title>
            <style>
                form{
                        max-width:400px;
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
                form div input[type="text"],form div select{
                        width:300px;
                        outline:0;
                }
            </style>
	</head>
	<body>
            <form action="add-book.php" method="post" class="bg-light py-3"enctype="multipart/form-data">
                <h2 class="text-center text-capitalize">add book</h2>
                <div class="input-group">
                    <button disabled="" class="btn btn-dark">kind</button>
                    <select required="" name="kind">
                        <?php
                          $query = $connect->prepare('select * from booksKinds');
                          $query->execute();
                          $result = $query->get_result();
                          foreach ($result as $kind){
                              echo '<option>'.$kind['kind'].'</option>';
                          }
                        ?>
                    </select>
            </div>

                <div class="input-group">
                        <button disabled="" class="btn btn-dark">name</button>
                        <input type="text" name="name" required="">
                </div>

                <div class="input-group">
                        <button disabled="" class="btn btn-dark">version</button>
                        <input type="text" name="version" required="">
                </div>

                <div class="input-group">
                        <button disabled="" class="btn btn-dark">author</button>
                        <input type="text" name="author" required="">
                </div>

                <div class="input-group">
                        <button disabled="" class="btn btn-dark">price</button>
                        <input type="text" name="price" required="">
                </div>
                
                <div class="input-group">
                        <button disabled="" class="btn btn-dark">currency's</button>
                        <select required="" name="currency">
                            <option>EGP</option>
                            <option>$</option>
                        </select>
                </div>

                <div class="input-group">
                        <button disabled="" class="btn btn-dark btn-sm" > image : </button>
                        <input type="file" name="image"  style="width:240px" required="">
                </div>
                
                
                <input type="submit" value="Add" name="add" class="btn btn-dark btn-lg" style="width:100px; display:block; margin:auto;">
            </form>
	</body>
</html>


<?php 
  if(isset($_POST['add'])){
      
    $image = $_FILES['image'];
    $file = $_FILES['image']['name'];
    $tmpFile = $_FILES['image']['tmp_name'];
    $folder = 'images/'.$file;
    move_uploaded_file($file, $tmpFile);
    $addBook = new admin();
    $addBook->add_book($_POST['kind'], $_POST['name'],$_POST['version'], $_POST['author'], $_POST['price'], $_POST['currency'], $folder);
  }
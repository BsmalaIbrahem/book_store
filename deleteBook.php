<?php
    include 'nav.php';
    $id_book = $_GET['id'];
    $deleteBook = new admin();
    $deleteBook->delete_book($id_book);
    header("location:home.php");
            
    

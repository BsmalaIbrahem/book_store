<?php

trait book{
    private $book_id,
            $kind,
            $name_book,
            $version,
            $author,
            $price,
            $currency,
            $image_link,
            $flag_check_book = true;
    
    public function add_book($kind, $name_book, $version, $author, $price,$currency, $image_link){
        
        $this->assign_book_parameters_to_variables(0,$kind, $name_book, $version, $author, $price,$currency, $image_link);
        $this->set_book_to_database();
                  
    }
    
    
    private function assign_book_parameters_to_variables($book_id,$kind, $name_book, $version, $author, $price,$currency, $image_link){
        $this->book_id    = $book_id;
        $this->kind       = $kind;
        $this->name_book  = $name_book;
        $this->version    = $version;
        $this->author     = $author;
        $this->price      = $price;
        $this->currency   = $currency;
        $this->image_link = $image_link;
    }
    
    private function check_book() {
        if(!is_numeric($this->price)){
            $this->flag_check_book = false;
            return "price must be number";
        }
        $imageExtention = array('jpg','gif','png','jpeg');
        $extention      = pathinfo($this->image_link, PATHINFO_EXTENSION);
        if(!in_array($extention, $imageExtention)){
            $this->flag_check_book = false;
            return "link image is invalid";
        }
    }
    
    private function set_book_to_database() {
        $this->check_book();
        if($this->flag_check_book){
            Session ::sessionStart();
            $admin_id = Session::get_session('id');
            $connect = new mysqli('localhost','root','','onlineBook');
            $query   = $connect->prepare('insert into books set admin_id=?, kind=?, bookName=?, version=?, author=?, price=?, currency=?, image=?');
            $query->bind_param("issssiss",$admin_id,$this->kind,$this->name_book, $this->version, $this->author, $this->price,$this->currency, $this->image_link );
            $query->execute();
        }
        else 
            echo $this->check_book();  
        
    }
    
     
    public function delete_book($book_id){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('delete from books where book_id = ?');
        $query->bind_param("i",$book_id);
        $query->execute();       
    }
    
    public function view_required_book($book_id) {
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from books where book_id=?');
        $query->bind_param("i",$book_id);
        $query->execute();
        $result = $query->get_result();
        $fetch  = $result->fetch_assoc();
        return $fetch;
    }
    
    public function update_book($bookId,$kind, $name_book, $version, $author, $price,$currency, $image_link){
        $this->assign_book_parameters_to_variables($bookId,$kind, $name_book, $version, $author, $price,$currency, $image_link);
        $this->update_book_in_database();
        
    }
    
    private function update_book_in_database() {
        $this->check_book();
        if($this->flag_check_book){
            $connect = new mysqli('localhost','root','','onlineBook');
            $query   = $connect->prepare('update books  set kind=?, bookName=?, version=?, author=?, price=?, currency=?, image=? where book_id=?');
            $query->bind_param("ssssissi",$this->kind,$this->name_book, $this->version, $this->author, $this->price,$this->currency, $this->image_link,$this->book_id);
            $query->execute();
           $this->go_page_after_updateBook();
        }
        else 
            echo $this->check_book(); 
    }
            
      private function go_page_after_updateBook() {
        /////header("location:login.php");
        echo '<script>window.location = "home.php"</script>';

   }      
}


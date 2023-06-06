<?php
require 'book.php';
class admin extends person implements \SplObserver{
    use book;
    public function view_users(){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from user');
        $query->execute();
        $result = $query->get_result();
        return $result;
    }
    
    

    public function update(\SplSubject $subject){
        $newOrder_id =  $subject->return_newOrder_id();
         $this->add_new_order($newOrder_id);       
    }
    
    public function add_new_user_order($newOrder_id){
        
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('insert into new_orders set order_id=?');
        $query->bind_param('i', $newOrder_id);
        $query->execute();
        
    }
    
     public function view_only_newUserOrders(){
        
        $this->delete_old_orders();
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders, new_orders,books  where orders.order_id = new_orders.order_id and orders.book_id = books.book_id ');
        $query->execute();
        $result = $query->get_result();
        return $result;
        
    }
    
    private function delete_old_orders() {
       $connect = new mysqli('localhost','root','','onlineBook');
       $query   = $connect->prepare('delete from new_orders where   exists(select * from orders where orders.order_id = new_orders.order_id and orders.order_date < NOw() - INTERVAL 48 HOUR)');
       $query->execute();
    }
    
    
    
    public function view_all_users_orders(){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders,books,user where user.id = orders.employee_id');
        $query->execute();
        $result = $query->get_result();
        return $result;
    }
    
    public function view_non_deliveredOrders() {
       $delivered = false;
       $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders,books,user where arrived=?  and orders.book_id = books.book_id and orders.employee_id=user.id');
        $query->bind_param('i',$delivered);
        $query->execute();
        $orders = $query->get_result();
        return $orders;
   }

}


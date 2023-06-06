<?php
   require 'update_data.php';
class person {
   use update_data;
   
   private  $message_type;
   
   public function search_for_book($serach_phrase){
       $search_phrase = '%'.$serach_phrase.'%';
       $connect = new mysqli('localhost','root','','onlineBook');
       $query   = $connect->prepare("select * from books where bookName like ? || author like ?");
       $query->bind_param("ss",$search_phrase,$search_phrase);
       $query->execute();
       $result = $query->get_result();
       return $result;
   }
   
   
   
   
   public function view_books_kinds(){
       $connect = new mysqli('localhost','root','','onlineBook');
        $query = $connect->prepare('select * from booksKinds');
        $query->execute();
        $result = $query->get_result();
        return $result;
                
   }
   
   public function view_books(){
       $connect = new mysqli('localhost','root','','onlineBook');
       $query   = $connect->prepare('select * from books');
       $query->execute();
       $result = $query->get_result();
       return $result;
   }
   
   public function view_non_deliveredOrders($user_email) {
       $delivered = false;
       $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders,books,user where user_email=? and arrived=? and orders.book_id = books.book_id and orders.employee_id=user.id');
        $query->bind_param('si',$user_email, $delivered);
        $query->execute();
        $orders = $query->get_result();
        return $orders;
   }
   
   
   public function view_all_my_orders($user_email){
       $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders, books,user where user_email=? and orders.book_id = books.book_id and orders.employee_id=user.id');
        $query->bind_param('s',$user_email);
        $query->execute();
        $orders = $query->get_result();
        return $orders;
   }
   
   public function select_mesage_type(messages $messageType){
            $this->message_type = $messageType;
   }
   public function write_message($sender_id, $receiver_id, $order_id, $message_content){
          $this->message_type->send_message($sender_id, $receiver_id, $order_id, $message_content);
   }
   
   public function view_chat($order_id){
        return  $this->message_type->view_chat($order_id);
   }

   public function signOut(){
       Session ::sessionStart();
       Session::destroy_session();
       
   }

}




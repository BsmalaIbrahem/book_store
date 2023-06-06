<?php
require 'person.php';
class customer extends person {
    
    public function send_feedback($order_id, $message_content) {
       $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('insert into feedback set order_id=?,  message_content=?'); 
        $query->bind_param("is", $order_id,$message_content);
        $query->execute();
    }

}

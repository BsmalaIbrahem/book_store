<?php

class contact_us implements messages{

    public function send_message($sender_id, $receiver_id, $order_id, $message_content){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('insert into contact_us set sender_id=?, receiver_id=? , message_content=?');
        $query->bind_param('iis', $sender_id ,receiver_id, $message_content);
        $query->execute();
    }

    public function view_chat($user_id){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from contact_us where sender_id=? || receiver_id = ?');
        $query->bind_param('ii',$user_id,$user_id);
        $query->execute();
        $messages = $query->get_result();
        return $messages;
        
    }

}

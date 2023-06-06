<?php

interface messages{
    public function send_message($sender_id, $receiver_id, $order_id, $message_content);
    public function view_chat($id);
    
}



<?php

class comamunication_between_employee_and_customer implements messages{

    public function send_message($sender_id, $receiver_id, $order_id, $message_content) {
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('insert into communication_betwen_employee_and_customer set sender_id=?, receiver_id=? ,order_id=? ,message_content=?');
        $query->bind_param('iiis', $sender_id ,$receiver_id,$order_id, $message_content);
        $query->execute();
    }

    public function view_chat($order_id) {
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from communication_betwen_employee_and_customer, orders where communication_betwen_employee_and_customer.order_id=? and communication_betwen_employee_and_customer.order_id = orders.order_id');
        $query->bind_param('i',$order_id);
        $query->execute();
        $messages = $query->get_result();
        return $messages;
    }
    

}

<?php

class arrived_order  {
   
    
    public function arrival_confrmation($order_id){
        $arrived = 1;
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('update orders set arrived=? where order_id=?');
        $query->bind_param("ii",$arrived, $order_id );
        $query->execute();
        $this->notify();
    }
    public function  delete_arrived_order_messages($order_id){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('delete from communication_betwen_employee_and_customer where order_id=?');
        $query->bind_param('i',$order_id);
        $query->execute();
    }
            
            

}

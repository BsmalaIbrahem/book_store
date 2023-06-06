<?php

class employee extends person implements \SplObserver{
    private $newOrder_id;
    
    public function update(\SplSubject $subject): void {
        $newOrder_id =  $subject->return_newOrder_id();
        $this->addEmployeeToOrder($newOrder_id);
        
    }
    
    public function addEmployeeToOrder($order_id) {
        $employee_is_order_owner = check_inputs::check_order_owner($order_id);
        if($employee_is_order_owner)
            $employee_id = $employee_is_order_owner;
            
        else 
            $employee_id = $this->choose_employee();
        
        $this->add_New_Order_To_Employee($employee_id);
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('update orders set employee_id=? where order_id=? ');
        $query->bind_param("ii", $employee_id,$order_id);
        $query->execute();
    }
    
    private function add_New_Order_To_Employee($employee_id){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query_select  = $connect->prepare('select * from delivery_employess where employee_id=?');
        $query_select->bind_param('i', $employee_id);
        $query_select->execute();
        $result = $query_select->get_result();
        $employee            = $result->fetch_assoc();
        $deliveredOrders     = $employee['deliveredOrders'] + 1;
        $non_deliveredOrders = $employee['non_deliveredOrders'] + 1;
        
        $query_update   = $connect->prepare('update delivery_employess set deliveredOrders=?, non_deliveredOrders=? where employee_id=?');
        $query_update->bind_param("iii", $deliveredOrders, $non_deliveredOrders, $employee_id);
        $query_update->execute();
    }

    
    private function choose_employee() {
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from delivery_employess');
        $query->execute();
        $employees = $query->get_result();
        $fetch = $employees->fetch_assoc();
        foreach($employees  as $employee){
            if($employee['deliveredOrders'] == 0)
                return $employee['employee_id'];
        }
        
        
        
        foreach($employees as $employee){
            if($employee['non_deliveredOrders'] == 0)
                return $employee['employee_id'];  
        }
        
        
        
        
        $employee_id = $fetch['employee_id']; $non_delivered_orders=$fetch['non_deliveredOrders'];
        
        foreach($employees as $employee){
            if($employee['non_deliveredOrders'] < $non_delivered_orders){
                $employee_id = $employee['employee_id'];
                $non_delivered_orders = $employee['non_deliveredOrders'];
            }
        }
        return $employee_id;

    }
    
    
    public function view_non_deliveredOrders($employee_id) {
       $delivered = false;
       $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from orders,books,user where employee_id=? and arrived=? and orders.employee_id=user.id');
        $query->bind_param('ii',$employee_id, $delivered);
        $query->execute();
        $orders = $query->get_result();
        return $orders;
   }
   
   public function discount_for_employee($book_price) {
       
       return $book_price / 2; 
   }
    
}

<!DOCTYPE html>
<?php
include 'classes/session.php';
   Session :: sessionStart();
if(@!Session :: get_session('email')){
    header("location:login.php");
}
else{
  include 'nav.php';
  if(Session::get_session('employee')){
      $orders = new employee();
      $nonDelivered_orders = $orders->view_non_deliveredOrders(Session::get_session('id'));
      $all_orders  = $orders->view_all_my_orders(Session::get_session('email'));
      
      
  }
  
  elseif (Session::get_session('admin')) {
      $orders = new admin();
      $all_orders = $orders->view_all_users_orders();
      $nonDelivered_orders = $orders->view_non_deliveredOrders();
  }
  
  else{
      $orders = new person();
      $all_orders = $orders->view_all_my_orders(Session::get_session('email')); 
      $nonDelivered_orders = $orders->view_non_deliveredOrders(Session::get_session('email'));
      
  }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="show_orders.css">
    </head>
    <body>
        <header >
            <ul  class="btn btn-group list-unstyled nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#allOrders" data-bs-toggle='tab'  class="mx-4 nav-link active">all orders</a>
                </li>
                <li class="nav-item">
                    <a href="#nonDelivered" data-bs-toggle='tab' class="nav-link">non_delivered_orders</a>
                </li>
                <?php if(Session :: get_session('admin')){?>
                <li class="nav-item">
                    <a href="#newOrders" data-bs-toggle='tab' class="nav-link">new_orders</a>
                </li>
                <?php }?>
            </ul>
        </header>
        <section  class='tab-content '>
            
            <table id='allOrders' class='tab-pane active'>
                
                <tr class="bg-dark text-light h4 text-center">
                    <th>book name</th>
                    <th>price</th>
                    <th>delivered employee</th>
                    <th>date</th>
                    <th>feedback/contact</th>
                </tr>

                <?php 
                   
                   foreach ($all_orders as $order){

                ?>
                <tr>
                    <td><?=$order['bookName']?></td>
                    <?php if(Session :: get_session('employee')){ ?>
                    <td><?=$orders->discount_for_employee($order['price']);?></td>
                   <?php }else{?>
                    <td><?=$order['price']?></td>
                   <?php }?>
                    <td><?=$order['name']?></td>
                    <td><?=$order['order_date']?></td>
                    <?php if($order['arrived'] && !Session :: get_session('employee')){ ?>
                    <td class='text-center'><a href="feedback.php?id=<?=$order['order_id'];?>">send feedback</a></td>
                   <?php }
                      elseif(!Session :: get_session('employee') && !Session::get_session('admin')){
                   ?>
                    <td class='text-center'><a href="contact_employee.php?order_id=<?=$order['order_id'];?>&employee_id=<?=$order['employee_id'];?>&user_id=<?=$order['user_id'];?>">contact</a></td>
                </tr>

                <?php }}?>
                
            </table>
            
             <table id='nonDelivered' class='tab-pane fade'>
                
                <tr class="bg-dark text-light h4 text-center">
                    <th>book name</th>
                    <th>price</th>
                    <th>delivered employee</th>
                    <th>date</th>
                    <th>contact</th>
                    <?php if(Session :: get_session('employee')){?>
                    <th>arrived order</th>
                    <?php }?>
                    
                </tr>

                <?php 
                    
                   foreach ($nonDelivered_orders as $order){

                ?>
                <tr>
                    <td><?=$order['bookName']?></td>
                    <td><?=$order['price']?></td>
                    <td><?=$order['name']?></td>
                    <td><?=$order['order_date']?></td>
                    <?php if(!Session::get_session('admin')){?>
                     <td class='text-center'><a href="contact_employee.php?order_id=<?=$order['order_id'];?>&employee_id=<?=$order['employee_id'];?>&user_id=<?=$order['user_id'];?>">contact</a></td>
                    <?php } if(Session :: get_session('employee')){?>
                       <td><a href="arrived_order.php?order_id=<?=$order['order_id']?>">arrived</a></td>
                   <?php }?>
                </tr>

                   <?php }?>
                
            </table>
            <?php 
                if(@Session::get_session('admin'))
                   include 'new_orders.php';
            ?>
        </section>
    </body>
</html>
<?php }?>

<!DOCTYPE html>
<?php
   /*spl_autoload_register(function ($class){
        require 'classes/'.$class.'.php';
    });
    Session::sessionStart();*/
    $order_id=58;
    
    $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from communication_betwen_employee_and_customer, orders where communication_betwen_employee_and_customer.order_id=? and communication_betwen_employee_and_customer.order_id = orders.order_id');
        $query->bind_param('i',$order_id);
        $query->execute();
        $messages = $query->get_result();
        foreach($messages as $message){
            echo $message['message_content']."<br>";
        }
    


    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
       
    </head>

    
    <body>
        
    </body>
</html>


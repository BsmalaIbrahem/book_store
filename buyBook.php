<?php

    spl_autoload_register(function ($class){
        require 'classes/'.$class.'.php';
    });
     Session::sessionStart();
     
    if(Session::get_session('email')){
        $book_id = $_GET['id'];
        $user_email = Session::get_session('email');
        $order = new addOrder();
        $admin = new admin();
        $employee = new employee();
        $order->attach($admin);
        $order->attach($employee);
        $order->addNewOrder($book_id, $user_email);
        header('location:show_orders.php');
    }
 else {
     header('location:login.php');   
}
            
            
            
            
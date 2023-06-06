<?php
include 'nav.php';
 echo "<br><br><br><br><br><br>";
$order_id = $_GET['order_id'];
$order = new arrived_order();
$order->arrival_confrmation($order_id);
$order->delete_arrived_order_messages($order_id);
$customer = new customer();
$order->attach($customer);

header("location:show_orders.php");



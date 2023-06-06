<!DOCTYPE html>
<?php
    $admin = new admin();
    $new_orders = $admin->view_only_newUserOrders();
?> 
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
            <table id='newOrders' class='tab-pane fade'>
                
                <tr class="bg-dark text-light h4 text-center">
                    <th>order_id</th>
                    <th>book name</th>
                    <th>price</th>
                    <th>date</th>
                    <th>arrived</th>
                </tr>
                <?php                
                     foreach ($new_orders as $new_order){
                         
                ?>
                <tr>
                    <th><?=$new_order['order_id']?></th>
                    <th><?=$new_order['bookName']?></th>
                    <th><?=$new_order['price']?></th>
                    <th><?=$new_order['order_date']?></th>
                    <th><?=$new_order['arrived']?></th>
                </tr>
               <?php }?>
            </table>
    </body>
</html>

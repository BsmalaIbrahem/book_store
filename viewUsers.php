<!DOCTYPE html>
<?php include 'nav.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>view users</title>
        <link rel="stylesheet" href="viewUsers.css">
        <style>

        </style>
    </head>
    <body>
        <section>
            <table>
                <tr class="bg-dark text-light h4">
                  <?php
                    $admin     = new admin();
                    $result    = $admin->view_users();
                    $users     = 0;
                    $admins    = 0;
                    $employees = 0;
                    foreach ($result as $value){
                        $users++;
                        if($value['employee'])
                            $employees++;
                        if($value['admin'])
                            $admins++;
                    }
                  ?>
                    <th colspan="2">users : <?=$users?></th>
                    <th colspan="3">
                        <form method="post" action="" class="input-group mx-5">
                            <input type="search" name="searchUSer" style="width:70%;outline:0" class="py-2">
                            <input type="submit" value="Go" style="" class="bg-light px-2">  
                        </form>
                    </th>
                    <th colspan="2">employees : <?=$employees?></th>
                    <th colspan="2">admins : <?=$admins?></th>
                    
                </tr>
                <tr class="bg-dark text-light h5">
                    <th>#</th>
                    <th>user_name</th>
                    <th>email</th>
                    <th>interests</th>
                    <th>country</th>
                    <th>gender</th>
                    <th>orders</th>
                    <th>employee</th>
                    <th>admin</th>
                </tr>
                <?php
                  $count =  1; 
                  foreach ($result as $value){
                ?>
                <tr class="bg-light">
                    <th><?=$count;?></th>
                    <th><?=$value['name'];?></th>
                    <th><?=$value['email'];?></th>
                    <th><?=$value['field'];?></th>
                    <th><?=$value['country'];?></th>
                    <th><?=$value['gender'];?></th>
                    <th><?=$value['orders_numbers'];?></th>
                    <th><?=$value['employee'];?></th>
                    <th><?=$value['admin'];?></th>
                </tr>



                <?php $count++; }?>
            </table>
                
        </section>
    </body>
</html>


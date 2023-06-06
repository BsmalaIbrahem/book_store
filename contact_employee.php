<!DOCTYPE html>
<?php 
  include 'nav.php';
  include 'classes/contact_employee.php';
  echo "<br><br><br><br><br><br>";
  $order_id = $_GET['order_id'];
  $employee_id = $_GET['employee_id'];
  $user_id = $_GET['user_id'];
  $user = new person();
  $user->select_mesage_type(new comamunication_between_employee_and_customer());
  $messages = $user->view_chat($order_id);
  
  
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="contact_employee.css">
    </head>
    <body>
        <section>
            <h3></h3>
            <div class="messages" style="position:relative">
                <?php
                  foreach($messages as $Message){
                    if(Session::get_session('id') == $Message['receiver_id']){
                  
                ?>
                        <div  class="receiver_message">
                            <p><?=$Message['message_content']?></p>
                        </div>
                    <?php }
                         else{
                       ?>
                             <div  class="sender_message">
                                <p><?=$Message['message_content']?></p>
                             </div>
          
                  <?php }}?>
            </div>
            <form method="post" action="" class="input-group">
                <textarea required="" name="message"></textarea>
                <input type="submit" value="send" name="send_message">
            </form>
        </section> 
    </body>
</html>

<?php
  if(isset($_POST['send_message'])){
      $message_content = $_POST['message'];
      $sender_id = Session::get_session('id');
      if(Session::get_session('employee'))
          $receiver_id = $user_id;
      else 
          $receiver_id = $employee_id;
      
      $user->write_message($sender_id, $receiver_id, $order_id, $message_content);
      //header("location:contact_employee.php?order_id=".$order_id."&employee_id=".$employee_id."&user_id=".$user_id);
  }
?>

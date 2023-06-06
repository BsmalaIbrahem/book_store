<!DOCTYPE html>
<?php 
  include 'classes/session.php';
   Session :: sessionStart();
if(@!Session :: get_session('email')){
    header("location:login.php");
}
else{
  include 'nav.php';
  include 'classes/contact_employee.php';
  echo "<br><br><br><br><br><br>";
  $sender_id = Session :: get_session('id') ;
  $user = new person();
  $user->select_mesage_type(new contact_us());
  $messages = $user->view_chat($user_id);
  $order = "general";
  
  
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
            <div class="messages">
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
      if(Session::get_session('admin'))
          $receiver_id = $user_id;
      
      $user->write_message($sender_id, $receiver_id, $order, $message_content);
      header("location:contact_us.php");
}}
?>



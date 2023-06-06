<?php
   include 'classes/session.php';
   echo "<b><br><br>";
   Session :: sessionStart();
   $order_id= $_GET['id'];
  if(@Session::get_session('email')){
        include("nav.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>contact</title>
		<style type="text/css">
			form{
				max-width:500px;
				margin:auto;
				margin-top:100px;
			}
			form textarea{
				resize:none;
				width:100%;
				height:200px;
				text-indent:3px;
			}
		</style>
	</head>
	<body>
		<form action="" method="post" class="bg-light p-3">
			<h2 class="text-center text-capitalize py-3">feedback</h2>
			<textarea placeholder="enter message" name="message" required=""></textarea>
			<input type="submit" value="send" name="feedback" class="btn btn-dark my-3" style="width:100px; display:block; margin:auto;">
		</form>
	</body>
</html>
  <?php
      if(isset($_POST['feedback'])){
        $message_content = $_POST['message'] ;
        $user = new customer();
        $user->send_feedback($order_id, $message_content);
      }
  
  }
      
       
    else{
        include 'login.php';
    }
  ?>
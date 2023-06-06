<?php
class sign_up {

     protected  $name,
                $email,
                $password,
                $confirm_password,
                $interest,
                $country,
                $address,
                $phone_number,
                $gender;
     
     private $flag_check = true;
     
    public function register($userName, $email, $password, $confirmPass, $interest,$city , $street, $phone,$gender){
        
        $this->assign_register_parameters_to_variables($userName, $email, $password, $confirmPass, $interest,$city , $street, $phone,$gender);
      
        $this->set_data_to_datbase();
            
    }
    
    private function assign_register_parameters_to_variables($userName, $email, $password, $confirmPass, $interest,$city , $address, $phone,$gender) {
        $this->name             = $userName;
        $this->email            = $email;
        $this->password         = $password;
        $this->confirm_password = $confirmPass;
        $this->interest         = $interest;
        $this->city             = $city;
        $this->street           = $address;
        $this->phone_number     = $phone;
        $this->gender           = $gender;
    }
    
    public function set_data_to_datbase() {
       $check_register = check_inputs ::check_register_inputs($this->name,  $this->email, $this->password, $this->confirm_password, $this->interest, $this->city, $this->street, $this->phone_number, $this->gender);
        if(check_inputs::$check_flag){
            $connect = new mysqli('localhost','root','','onlineBook');
            $query = $connect->prepare('insert into user set name=?, email=?, password=?, field=?, city=?, street=? ,phoneNumber=?,gender=?');
            $query->bind_param("ssssssis", $this->name, $this->email, $this->password, $this->interest, $this->city, $this->street, $this->phone_number, $this->gender);
            $query->execute();
            $this->go_page_after_registeration();
        }
        else{
           echo $check_register;
        }
        
    }

    
    
    private  function go_page_after_registeration(){
        /////header("location:login.php");
        echo '<script>window.location = "login.php"</script>';
    }
}


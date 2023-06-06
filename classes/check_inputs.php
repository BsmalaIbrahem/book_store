<?php

class check_inputs{
    
    public static $check_flag = true; 
    
    public static function input_is_space($input){
        if(ctype_space($input))
            return true;
        else 
            return false;
    }
    
    public static function check_email_is_used($email){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query  = $connect->prepare('select * from user where email=?');
        $query->bind_param("s",$email);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows > 0)
            return true;
        else 
            return false;
    }
    
    public static function check_phone_number($number) {
        if(is_numeric($number))
            return true;
        else 
            return false;
    }
    
    public static function check_password_and_confirm_are_same($password, $confirmPassword) {
        if($password == $confirmPassword)
            return true;
        else
            return false;
    }

    
    public static function check_register_inputs($userName, $email, $password, $confirmPass, $interest,$country , $address, $phone,$gender) {
        
        
       if(self::input_is_space($userName)|| self::input_is_space($email) || self::input_is_space($password) || self::input_is_space($confirmPass)  || self::input_is_space($address)){
           self::$check_flag = false; 
           return 'the input may not be a space';
       }
       
       if(self::check_email_is_used($email)){
           self::$check_flag = false; 
           return'this email has already been used';
       }
       
       if(!self::check_password_and_confirm_are_same($password, $confirmPass)){
           self::$check_flag = false; 
           return 'the password is different';
       }
       
       
       if(!self::check_phone_number($phone)){
            self::$check_flag = false; 
           return 'invald phone number';
       }
       
        if($interest == 'interests'){
            self::$check_flag = false; 
           return 'select interests';

        }
        
        
        if($country == 'country'){
            self::$check_flag = false; 
           return 'select country';
        }
    }
    
    
    public static function check_login_inputs($email,$password) {
        $connect = new mysqli('localhost','root','','onlineBook');
        $query  = $connect->prepare('select * from user where email=? and password=?');
        $query->bind_param("ss",$email, $password);
        $query->execute();
        $result = $query->get_result();
        $fetch  = $result->fetch_assoc();
        if($result->num_rows > 0)
            return $fetch;
        else
            
            return false;
    }
    
    public static function check_order_owner($order_id){
        $connect = new mysqli('localhost','root','','onlineBook');
        $query   = $connect->prepare('select * from user where email in(select user_email from orders where order_id=?) ');
        $query->bind_param("i",$order_id);
        $query->execute();
        $result = $query->get_result();
        $order_owner = $result->fetch_assoc();
        if($order_owner['employee']){
            return $order_owner['id'];
        }
        else
            return false;
    }


}

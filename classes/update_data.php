<?php

trait update_data{
    public function  updateUserName($userName, $password){
        if(check_inputs ::check_password_and_confirm_are_same(Session::get_session('password'), $password) ){
            if(!check_inputs::input_is_space($userName)){
                $email = Session::get_session('email');
                $connect = new mysqli('localhost','root','','onlineBook');
                $query   = $connect->prepare("update user set name=? where email=?");
                $query->bind_param("ss", $userName,$email);
                $query->execute();
                Session ::set_session('userName', $userName);
            }
            else
                echo "user name mustn't be space";
        }
        else
            echo "password is wrong";
        
    }
    
    public function update_email($email, $password) {
        if(check_inputs ::check_password_and_confirm_are_same(Session::get_session('password'), $password) ){
            if(!check_inputs::check_email_is_used($email)){
                $sessionEmail = Session::get_session('email');
                $connect = new mysqli('localhost','root','','onlineBook');
                $query   = $connect->prepare("update user set email=? where email=?");
                $query->bind_param("ss", $email,$sessionEmail);
                $query->execute();
                Session ::set_session('email', $email);
            }
            else
                echo "this email is alredy been used";
                
        }
        else 
            echo 'password is wrong';
    }
    
    public function update_interests($interest, $password) {
        if(check_inputs ::check_password_and_confirm_are_same(Session::get_session('password'), $password) ){
                $sessionEmail = Session::get_session('email');
                $connect = new mysqli('localhost','root','','onlineBook');
                $query   = $connect->prepare("update user set field=? where email=?");
                $query->bind_param("ss", $interest ,$sessionEmail);
                $query->execute();
                Session ::set_session('field', $interest);
                
        }
        else 
            echo 'password is wrong';
    }
    
    
    
    public function update_password($currentPassword, $newPassword, $confirmNewPassword) {
        if(check_inputs ::check_password_and_confirm_are_same(Session::get_session('password'), $currentPassword) ){
                $sessionEmail = Session::get_session('email');
                if(check_inputs ::check_password_and_confirm_are_same($newPassword, $confirmNewPassword)){
                    $connect = new mysqli('localhost','root','','onlineBook');
                    $query   = $connect->prepare("update user set password=? where email=?");
                    $query->bind_param("ss", $newPassword ,$sessionEmail);
                    $query->execute();
                    Session ::set_session('password', $newPassword);
                }
                else
                    echo "new password and confirm new password aren different";   
                
        }
        else 
            echo 'password is wrong';
    }
    
    public function update_address_and_phoneNumber($country, $address, $phoneNumber, $password) {
        if(check_inputs ::check_password_and_confirm_are_same(Session::get_session('password'), $password) ){
                $sessionEmail = Session::get_session('email');
                if(!check_inputs ::input_is_space($address) && check_inputs::check_phone_number($phoneNumber)){
                    $connect = new mysqli('localhost','root','','onlineBook');
                    $query   = $connect->prepare("update user set country=?, address=?, phoneNumber=? where email=?");
                    $query->bind_param("ssis", $country ,$address,$phoneNumber,$sessionEmail);
                    $query->execute();
                    Session ::set_session('country', $country);
                    Session ::set_session('address', $address);
                    Session ::set_session('phoneNumber', $phoneNumber);
                }
                else
                    echo "adress mustnt be space and phoneNumber must be number";   
                
        }
        else 
            echo 'password is wrong';
    }
    
}


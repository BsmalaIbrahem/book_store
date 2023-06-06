<?php
class sign_in{
    public function login($email, $password){
        $this->assign_login_parameters_to_variables($email, $password);
        $check_login =check_inputs::check_login_inputs($email, $password) ;
        if($check_login){
            $this->get_login_data_from_database($check_login);
            $this->go_page_after_login();
        }
        else {
            echo 'this email or password is wrong';
        }
       
   }
   
   private function assign_login_parameters_to_variables($email, $password) {
       $this->email    = $email;
       $this->password = $password;
   }
   
   
   
   private function  get_login_data_from_database($data){
       $id          = $data['id'];
       $userName    = $data['name'];
       $email       = $data['email'];
       $password    = $data['password'];
       $field       = $data['field'];
       $country     = $data['country'];
       $city        = $data['city'];
       $street      = $data['street'];
       $phoneNumber = $data['phoneNumber'];
       $gender      = $data['gender'];
       $admin       = $data['admin'];
       $employee    = $data['employee'];
       $ordersNumber = $data['ordersNumbers'];
       $this->set_login_data_to_session($id,$userName, $email,$password, $field, $country,$city,$street,$phoneNumber,$gender, $admin, $employee,$ordersNumber);
   }
   
   private function set_login_data_to_session($id,$userName, $email,$password, $field, $country,$city,$street,$phoneNumber,$gender, $admin, $employee,$ordersNumber){
       
       Session ::sessionStart();
       Session::set_session('id', $id);
       Session::set_session('userName', $userName);
       Session::set_session('email', $email);
       Session::set_session('password', $password);
       Session::set_session('field', $field);
       Session::set_session('country', $country);
       Session::set_session('city', $city);
       Session::set_session('street', $street);
       Session::set_session('phoneNumber', $phoneNumber);
       Session::set_session('gender', $gender);
       Session::set_session('admin', $admin);
       Session::set_session('employee', $employee);
       Session::set_session('ordersNumbers', $ordersNumber);
          
   }
   
   private function go_page_after_login() {
       header("location:home.php");
   }
           
           
}


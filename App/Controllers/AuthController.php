<?php
namespace App\Controllers;
use App\Models\Auth;
use FontLib\Table\Type\head;

class AuthController {
    public function SignIn($email, $password) {
        $SignIn = new Auth();
        $SignIn->login($email, $password);
    }
    

    public function SignUp($cin,$name , $email , $password ,$c_password ){

        if($password == $c_password){
        $SignUp = new Auth();
        $result = $SignUp->register($cin, $name , $email , $password);
    }
        else header('Location:?route=login&msg');
    }
}

?>
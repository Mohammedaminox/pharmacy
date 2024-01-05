<?php
include_once __DIR__."/../vendor/autoload.php";

use App\Controllers\HomeController;
use App\Models\ProductModels;
use App\Controllers\AuthController;


$route = isset($_GET['route']) ? $_GET["route"] : 'home';

switch($route){

    case 'SignIn':
        isset($_POST['signin']);
        extract($_POST);           
        $controller = new AuthController();
        $controller->SignIn($email , $password);

        break;
        case 'SignUp':
               $_POST['signup'];
                extract($_POST);                
                $controller = new AuthController();
                $controller->SignUp($cin,$name, $email, $password, $c_password);
            break;
            
    case 'indexuser':
        $controller = new HomeController();
        $controller->home();
        break;
    case 'contact':
        $controller = new HomeController();
        $controller->contact();
        break;
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'dlt':
        $controller = new HomeController();
        $controller->delete();
        break;

    case 'mdf':
        $controller = new HomeController();
        $controller->modify();
        break;
    
    case 'modifyuser':
        isset($_POST);
        extract($_POST);
        $controller = new HomeController();
        $controller->modifyUser($cin , $full_name , $email);
        break;
    case 'store':
        if(isset($_GET['id'])){
            $id =  $_GET['id'];
            $delete = new ProductModels();
            $delete->DeleteProduct($id);
        }

        $controller = new HomeController();
        $controller->store();
        break;

    case 'add_prdct':
        $controller = new HomeController();
        $controller->add_prdct();
        break;

    case 'modify_product':
        $controller = new HomeController();
        $controller->modify_prdct();
        break;
    
    case 'Modifed_Product':
        $controller = new HomeController();
        $controller->Modifed_Product();
        break;

    case 'dashboard':
        $controller = new HomeController();
        $controller->dashboard();
        break;
    case 'login':
        $controller = new HomeController();
        $controller->login();
        break;
    case 'exprtPDF':
        $controller = new HomeController();
        $controller->exprtPDF();
        break;
    
}
?>
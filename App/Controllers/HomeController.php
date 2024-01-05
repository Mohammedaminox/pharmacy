<?php
namespace App\Controllers;

use App\Models\ProductModels;
use App\Models\UserModels;
class HomeController{
    public function index(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        $userModel = new UserModels();
        $users = $userModel->GetAllUsers();
        require_once __DIR__."/../../views/dashboard/user_page.php";
    }
    public function delete(){
        
        
        if(isset($_GET['delete'])){
            $cin = $_GET['delete'];   
            $userModel = new UserModels();
             $userModel->DeleteUsers($cin);
        }   
        header("location:?route=home");
        }
    public function modify(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");

        if(isset($_GET["cin"])){
            $cin = $_GET['cin'];
            $userModel = new UserModels();
            $users = $userModel->GetAllUserByCIN($cin);            
        }
        
        require_once __DIR__."/../../views/dashboard/page_modify.php";
     }
    public function modifyUser($cin , $full_name , $email){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        extract($_POST);
        $modify = new UserModels();
        $modify->ModifyUsers($cin , $full_name , $email);       
        header("location:?route=home");        
     }
    public function store(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        $userModel = new ProductModels();
        $medicaments = $userModel->GetAllProducts();
        require_once __DIR__."/../../views/dashboard/store.php";
     }
    public function add_prdct(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        
        if(isset($_POST['nom'])){
            extract($_POST);
            $add = new ProductModels();
            $add->AddProduct($nom , $description , $quantete , $prix);
            header('location:?route=store');
        }
        require_once __DIR__."/../../views/dashboard/page_add_product.php";
     }

    public function modify_prdct(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $product = new ProductModels();
            $products = $product->GetProductByID($id);
         }
        require_once __DIR__."/../../views/dashboard/modify_product.php";
     }

    public function Modifed_Product(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        if(isset($_POST['submit'])){
            extract($_POST);
            $modify = new ProductModels();
            $modify->ModifyProduct($id ,$nom , $description , $quantete , $prix);
            
    }
        header("Location:?route=store");
    } 

    public function dashboard(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        require_once __DIR__."/../../views/dashboard/dashboard.php";
    }
    public function login(){
        session_start();
        session_destroy();
        require_once __DIR__."/../../views/login.php";
    }
    public function exprtPDF(){
        require_once __DIR__."/../../views/dashboard/pdf.php";
    }
    public function home(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        require_once __DIR__."/../../views/index.php";
    }
    public function contact(){
        session_start();
        if(isset($_SESSION['CIN'])){
            $cin = $_SESSION['CIN'];
        }
        else header("Location:?route=login");
        require_once __DIR__."/../../views/contact.php";
    }
    }

?>
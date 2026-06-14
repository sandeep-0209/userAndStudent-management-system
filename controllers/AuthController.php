<?php

/* =========================
   SESSION & REQUIRED FILES
========================= */

session_start();

require_once "../models/UserModel.php";
require_once "../config/db.php";


/* =========================
   AUTH CONTROLLER
========================= */

class AuthController{

    private $model;

    public function __construct($conn){
        $this->model = new UserModel($conn);
    }

    public function register($name, $email, $password){

        if($this->model->emailExists($email)){
            return "Email already exist";
        }

        return $this->model->register($name, $email, $password);
    }

    public function login($email, $password){

        $user = $this->model->getUserByEmail($email);

        if(!$user){
            return false;
        }

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            return true;
        }

        return false;
    }
}


/* =========================
   CONTROLLER OBJECT
========================= */

$auth = new AuthController($conn);


/* =========================
   HANDLE FORM SUBMISSION
========================= */

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    /* =====================
       REGISTER LOGIC
    ===================== */

    if(isset($_POST['register'])){

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(empty($name) || empty($email) || empty($password)){
            $_SESSION['error'] = "All feilds are required";

            header("Location: ../views/auth/register.php");
            exit();
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = "Invalid Email";

            header("Location: ../views/auth/register.php");
            exit();
        }

        $result = $auth->register($name,$email,$password);

        if($result === "Email already exist"){
            $_SESSION['error'] = $result;

            header("Location: ../views/auth/register.php");
            exit();
        }

        if($result){
            $_SESSION['success'] = "Registration Successful. Please Login.";

            header("Location: ../views/auth/login.php");
            exit();
        }
    }


    /* =====================
       LOGIN LOGIC
    ===================== */

    if(isset($_POST['login'])){

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $result = $auth->login($email,$password);

        if($result){

            header("Location: ../dashboard.php");
            exit();

        }else{

            $_SESSION['error'] = "Invalid Email or Password";

            header("Location: ../views/auth/login.php");
            exit();
        }
    }
}

?>
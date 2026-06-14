<?php 

/* =========================
   SESSION & REQUIRED FILES
========================= */

session_start();

require_once "../config/db.php";
require_once "../models/UserModel.php";

// require_once "../config/config.php";


/* =========================
   USER CONTROLLER
========================= */

class UserController{

    private $model;

    public function __construct($conn){
        $this->model = new UserModel($conn);
    }

    public function list(){
        $users = $this->model->getAllUsers();
        
        include "../views/users/list.php";
    }

    public function getUserById($id){
        return $this->model->getUserById($id);
    }

    public function updateUser($id,$name,$email){
        return $this->model->updateUser($id,$name,$email);
    }

    public function delete($id){
        return $this->model->deleteUser($id);
    }
}


/* =========================
   CONTROLLER OBJECT
========================= */

$controller = new UserController($conn);


/* =========================
   SHOW USER LIST
========================= */

if(isset($_GET['action'])){

    if($_GET['action'] == "list"){
        $controller->list();
    }
}


/* =========================
   DELETE USER
========================= */

if(isset($_GET['action']) && $_GET['action'] == 'delete'){

    $id = $_GET['id'];

    $result = $controller->delete($id);

    if($result){
        $_SESSION['success'] = "User deleted successfully";
    }else{
        $_SESSION['error'] = "failed to delete student";
    }

    header("Location: UserController.php?action=list");
    exit();
}


/* =========================
   UPDATE USER
========================= */

if(isset($_POST['update_user'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $result = $controller->updateUser($id,$name,$email);

    if($result){
        $_SESSION['success'] = "User updated successfully";
    }else{
        $_SESSION['error'] = "User update failed";
    }

    header("Location: UserController.php?action=list");
    exit();
}


/* =========================
   EDIT USER FORM
========================= */

if(isset($_GET['action']) && $_GET['action'] == 'edit'){

    $id = $_GET['id'];

    $user = $controller->getUserById($id);

    require "../views/users/edit.php";
    exit();
}

?>
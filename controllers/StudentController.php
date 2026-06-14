<?php

/* =========================
   SESSION & REQUIRED FILES
========================= */

session_start();

require_once "../config/db.php";
require_once "../models/StudentModel.php";


/* =========================
   MODEL OBJECT
========================= */

$studentModel = new StudentModel($conn);


/* =========================
   ADD STUDENT LOGIC
========================= */

if(isset($_POST['add_student'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $course = trim($_POST['course']);
    $city = trim($_POST['city']);

    $result = $studentModel->addStudent($name,$email,$mobile,$course,$city);

    if($result){

        $_SESSION['success'] = "Student added successfully";

        header("Location: StudentController.php?action=list");
        exit();

    }else{

        $_SESSION['error'] = "Failed to add student";

        header("Location: ../views/students/create.php");
        exit();
    }
}


/* =========================
   SHOW STUDENT LIST
========================= */

if(isset($_GET['action']) && $_GET['action'] == 'list'){

    $students = $studentModel->getAll();

    require "../views/students/list.php";
    exit();
}


/* =========================
   DELETE STUDENT
========================= */

if(isset($_GET['action']) && $_GET['action'] == 'delete'){

    $id = $_GET['id'];

    $result = $studentModel->deleteStudent($id);

    if($result){
        $_SESSION['success'] = "Student deleted successfully";
    }else{
        $_SESSION['error'] = "failed to delete student";
    }

    header("Location: StudentController.php?action=list");
    exit();
}


/* =========================
   EDIT STUDENT FORM
========================= */

if(isset($_GET['action']) && $_GET['action'] == 'edit'){

    $id = $_GET['id'];

    $student = $studentModel->getStudentById($id);

    require "../views/students/edit.php";
    exit();
}


/* =========================
   UPDATE STUDENT
========================= */

if(isset($_POST['update_student'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $course = $_POST['course'];
    $city = $_POST['city'];

    $result = $studentModel->updateStudent($id,$name,$email,$mobile,$course,$city);

    if($result){
        $_SESSION['success'] = "Student updated succesfully";
    }else{
        $_SESSION['error'] = "failed to update student";
    }

    header("Location: StudentController.php?action=list");
    exit();
}

?>
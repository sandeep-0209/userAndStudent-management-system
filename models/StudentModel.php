<?php

/* =========================
   STUDENT MODEL
========================= */

class StudentModel{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    
    /* =========================
       ADD STUDENT
    ========================= */

    public function addStudent($name,$email,$mobile,$course,$city){

        $sql = "insert into students(name,email,mobile,course,city)
        values(?,?,?,?,?)";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "sssss", $name,$email,$mobile,$course,$city);

        return mysqli_stmt_execute($stmt);
    }


    /* =========================
       GET ALL STUDENTS
    ========================= */

    public function getAll(){

        $sql = "select * from students";

        $result = mysqli_query($this->conn, $sql);

        $data = [];

        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }


    /* =========================
       DELETE STUDENT
    ========================= */

    public function deleteStudent($id){

        $sql = "delete from students where id = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt);
    }


    /* =========================
       GET STUDENT BY ID
    ========================= */

    public function getStudentById($id){

        $sql = "select * from students where id = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }


    /* =========================
       UPDATE STUDENT
    ========================= */

    public function updateStudent($id,$name,$email,$mobile,$course,$city){

        $sql = "update students 
                set name=?, email=?, mobile=?, course=?, city=? 
                where id = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssssi",
            $name,
            $email,
            $mobile,
            $course,
            $city,
            $id
        );

        return mysqli_stmt_execute($stmt);
    }
}

?>
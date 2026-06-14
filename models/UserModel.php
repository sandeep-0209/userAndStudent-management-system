<?php

/* =========================
   USER MODEL
========================= */

// require_once "../config/config.php";

class UserModel{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }


    /* =========================
       CHECK EMAIL EXISTS
    ========================= */

    public function emailExists($email){

        $sql = "select id from users where email = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_num_rows($result) > 0;
    }


    /* =========================
       GET USER BY EMAIL
    ========================= */

    public function getUserByEmail($email){

        $sql = "select * from users where email = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }


    /* =========================
       REGISTER USER
    ========================= */

    public function register($name,$email,$password){

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "insert into users(name,email,password) values(?,?,?)";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt,"sss",$name,$email,$hash);

        return mysqli_stmt_execute($stmt);
    }


    /* =========================
       GET ALL USERS
    ========================= */

    public function getAllUsers(){

        $sql = "select * from users";

        $result = mysqli_query($this->conn, $sql);

        $users = [];

        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){
                $users[] = $row;
            }
        }

        return $users;
    }


    /* =========================
       DELETE USER
    ========================= */

    public function deleteUser($id){

        $sql = "delete from users where id = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt);
    }


    /* =========================
       GET USER BY ID
    ========================= */

    public function getUserById($id){

        $sql = "select * from users where id = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }


    /* =========================
       UPDATE USER
    ========================= */

    public function updateUser($id,$name,$email){

        $sql = "update users set name = ?, email = ? where id = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt,"ssi",$name,$email,$id);

        return mysqli_stmt_execute($stmt);
    }
}

?>
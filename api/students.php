dekho dost mai tumhe apne project ka pura structure and code de rha hu theek isako mujhe line by line step by step 
ki sabse pahle kya ban rha hai usake bad kya ho rha hai matlab serial se samjhana hai pure code ko bilun ache se 

userAndStudent_management_system1    // project ka name hai 
    /api
        /student.php 
    /assets
        /css 
            /style.css
        /js 
    /config
        /db.php 
    /controllers
        /AuthController.php 
        /StudentController.php 
        /UserController.php 
    /models 
        /StudentModel.php 
        /UserModel.php 
    /views
        /auth 
             /login.php 
             /register.php 
        /students 
             /create.php 
             /edit.php 
             /list.php 
        /users 
             /edit.php 
             /list.php 
    /dashboard.php 
    /index.php 
    /logout.php 


ye poora folder ka structure hai theek ab in sabka code deta hu 





userAndStudent_management_system1 /config/db.php 

<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "userandstudent_management_system1";

$conn = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if(!$conn){
    die("Connection Failed");
}

?>







userAndStudent_management_system1/controllers/AuthContoller.php 

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









userAndStudent_management_system1 /controllers/StudentController.php

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







userAndStudent_management_system1 /controllers/UserController.php

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









userAndStudent_management_system1 /models/StudentModel.php 

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












userAndStudent_management_system1 /models/UserModel.php 

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








userAndStudent_management_system1 /views/auth/login.php 
<?php

/* =========================
   START SESSION
========================= */

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <div class="container">

        <h2>Login</h2>

        <!-- =========================
             FLASH MESSAGE (ERROR / SUCCESS)
        ========================= -->

        <?php
        
        if(isset($_SESSION['error'])){
            echo "<p class='error-sms'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }

        if(isset($_SESSION['success'])){
            echo "<p class='success-sms'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }
        
        ?>

        <!-- =========================
             LOGIN FORM
        ========================= -->

        <form action="../../controllers/AuthController.php" method="post">

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password :</label>
                <input type="password" name="password" required>
            </div>

            <div class="login-btn">
                <button type="submit" name="login">Login</button>
            </div>

            <div class="already-register-btn">
                <a href="register.php">New User</a>
            </div>

        </form>

    </div>

</body>
</html>









userAndStudent_management_system1 /views/auth/register.php 
<?php

/* =========================
   START SESSION
========================= */

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <div class="container">

        <h2>register</h2>

        <!-- =========================
             FLASH MESSAGE (ERROR)
        ========================= -->

        <?php
        
        if(isset($_SESSION['error'])){
            echo "<p class='error-sms'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        
        ?>

        <!-- =========================
             REGISTER FORM
        ========================= -->

        <form action="../../controllers/AuthController.php" method="post">

            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="register-btn">
                <button type="submit" name="register">Register</button>
                <a href="login.php">Already have an account ?</a>
            </div>

        </form>

    </div>

</body>
</html>








userAndStudent_management_system1 /views/students/create.php 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link rel="stylesheet" href="/phptutorials/database_php_project/userAndStudent_management_system1/assets/css/style.css">
</head>
<body>
    
    <div class="container">

        <h2>Add Student</h2>

        <?php if(isset($_SESSION['success'])) { ?>
        <p class="success-sms">
        <?php echo $_SESSION['success']; ?>
        </p>
        <?php unset($_SESSION['success']); } ?>

        <form action="../../controllers/StudentController.php" method="post">

            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mobile :</label>
                <input type="number" name="mobile" required>
            </div>

            <div class="form-group">
                <label>Course :</label>
                <input type="text" name="course" required>
            </div>

            <div class="form-group">
                <label>City :</label>
                <input type="text" name="city" required>
            </div>

            <div class="create-btn">
                <button type="submit" name="add_student" class="add-student-btn">Add Student</button>
                <a href="../../dashboard.php" class="back-btn">Back to Dashboard</a>
            </div>

        </form>

    </div>

</body>
</html>






userAndStudent_management_system1 /views/students/edit.php 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>

    <link rel="stylesheet" href="/phptutorials/database_php_project/userAndStudent_management_system1/assets/css/style.css">
</head>
<body>

    <div class="container">

        <h2>Edit Student</h2>

        <form action="/phptutorials/database_php_project/userAndStudent_management_system1/controllers/StudentController.php" method="post">

            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" value="<?php echo $student['name']; ?>">
            </div>

            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>">
            </div>

            <div class="form-group">
                <label>Mobile :</label>
                <input type="number" name="mobile" value="<?php echo $student['mobile']; ?>">
            </div>

            <div class="form-group">
                <label>Course :</label>
                <input type="text" name="course" value="<?php echo $student['course']; ?>">
            </div>

            <div class="form-group">
                <label>City :</label>
                <input type="text" name="city" value="<?php echo $student['city']; ?>">
            </div>

            <button type="submit" name="update_student" class="edit-student-btn">Update Student</button>

        </form>

    </div>

</body>
</html>








userAndStudent_management_system1 /views/students/list.php 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>

    <link rel="stylesheet" href="/phptutorials/database_php_project/userAndStudent_management_system1/assets/css/style.css">
</head>
<body>

    <div class="table-container">

        <h2>Students List</h2>

            <!-- =========================
                 STUDENT LIST DELETE SMS
            ========================= -->

        <?php if(isset($_SESSION['success'])) { ?>
        <p class="success-sms">
        <?php echo $_SESSION['success']; ?>
        </p>
        <?php unset($_SESSION['success']); } ?>

        <?php if(isset($_SESSION['error'])) { ?>
        <p class="error-sms">
        <?php echo $_SESSION['error']; ?>
        </p>
        <?php unset($_SESSION['error']); } ?>

            <!-- =========================
                 STUDENT LIST ADDED SMS
            ========================= -->

        <?php if(isset($_SESSION['success'])) { ?>
        <p class="success-sms">
        <?php echo $_SESSION['success']; ?>
        </p>
        <?php unset($_SESSION['success']); } ?>

        <?php if(isset($_SESSION['error'])) { ?>
        <p class="error-sms">
        <?php echo $_SESSION['error']; ?>
        </p>
        <?php unset($_SESSION['error']); } ?>

        <table>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Course</th>
                <th>City</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <!-- =========================
                 STUDENT LIST LOOP
            ========================= -->

            <?php foreach($students as $student){ ?>

                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['email']; ?></td>
                    <td><?php echo $student['mobile']; ?></td>
                    <td><?php echo $student['course']; ?></td>
                    <td><?php echo $student['city']; ?></td>

                    <td>
                        <a href="/phptutorials/database_php_project/userAndStudent_management_system1/controllers/StudentController.php?action=edit&id=<?php echo $student['id']; ?>"
                           class="edit-btn">
                            Edit
                        </a>
                    </td>

                    <td>
                        <a href="/phptutorials/database_php_project/userAndStudent_management_system1/controllers/StudentController.php?action=delete&id=<?php echo $student['id']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Are you sure')">
                            Delete
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </table>

        <div class="btn-container">
            <a href="../views/students/create.php" class="add-btn">Add New Student</a>
            <a href="../dashboard.php" class="back-btn">Back to Dashboard</a>
        </div>

    </div>

</body>
</html>





userAndStudent_management_system1 /views/users/edit.php 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="/phptutorials/database_php_project/userAndStudent_management_system1/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>

        <form action="/phptutorials/database_php_project/userAndStudent_management_system1/controllers/UserController.php" method="post">

            <input type="hidden" name="id" value="<?php echo $user['id']?>">

            <div class="form-group">
                <label>Name :</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>">
            </div>

            <button type="submit" name="update_user" class="edit-student-btn">Update User</button>

        </form>
    </div>
</body>
</html>







userAndStudent_management_system1 /views/users/list.php 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="/phptutorials/database_php_project/userAndStudent_management_system1/assets/css/style.css">
</head>
<body>

    <div class="user-conatiner">

        <h2>User List</h2>

        <!-- =========================
             USER LIST ADDED SUCCESS/FAILE SMS
        ========================= -->

        <?php if(isset($_SESSION['success'])) { ?>
        <p class="success-sms">
        <?php echo $_SESSION['success']; ?>
        </p>
        <?php unset($_SESSION['success']); } ?>


        <?php if(isset($_SESSION['error'])) { ?>
        <p class="error-sms">
        <?php echo $_SESSION['error']; ?>
        </p>
        <?php unset($_SESSION['error']); } ?>

        <!-- =========================
             USER LIST TABLE START
        ========================= -->

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach($users as $user) { ?>

            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>

                <td>
                    <a href="/phptutorials/database_php_project/userAndStudent_management_system1/controllers/UserController.php?action=edit&id=<?php echo $user['id']; ?>"
                       class="edit-btn">
                       Edit
                    </a>
                </td>

                <td>
                    <a href="/phptutorials/database_php_project/userAndStudent_management_system1/controllers/UserController.php?action=delete&id=<?php echo $user['id']; ?>"
                       class="delete-btn"
                       onclick="return confirm('Are you sure')">
                        Delete
                    </a>
                </td>

            </tr>

            <?php } ?>

        </table>

        <!-- =========================
             BACK BUTTON
        ========================= -->

        <div class="btn-wrapper">
            <a href="../dashboard.php" class="back-btn">
                ← Back to Dashboard
            </a>
        </div>

    </div>

</body>
</html>






    
userAndStudent_management_system1 /dashboard.php 
<?php

/* =========================
   SESSION & AUTH CHECK
========================= */

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: views/auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="dashboard-wrapper">
        
        <div class="left-dash">
            <div class="button">
                <button><a href="views/students/create.php">Add Student</a></button>
                <button><a href="controllers/StudentController.php?action=list">Show Student List</a></button>
                <button><a href="controllers/UserController.php?action=list">Show User List</a></button>
                <button><a href="logout.php">Logout</a></button>
            </div>
        </div>

        <div class="right-dash">
            <h2>Welcome To Dashboard, <?php echo $_SESSION['user_name']; ?></h2>
        </div>

    </div>

</body>
</html>







userAndStudent_management_system1 /index.php 
<?php

header("Location: /phptutorials/database_php_project/userAndStudent_management_system1/views/auth/login.php");
exit();

?>






userAndStudent_management_system1 /logout.php 
<?php

session_start();

session_unset();

session_destroy();

header("Location: views/auth/login.php");
exit();

?>
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
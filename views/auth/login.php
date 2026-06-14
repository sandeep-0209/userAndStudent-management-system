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
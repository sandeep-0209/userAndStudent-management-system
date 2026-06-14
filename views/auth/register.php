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
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
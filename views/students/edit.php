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
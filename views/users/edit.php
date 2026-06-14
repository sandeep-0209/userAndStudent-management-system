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
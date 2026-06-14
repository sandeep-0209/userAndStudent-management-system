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
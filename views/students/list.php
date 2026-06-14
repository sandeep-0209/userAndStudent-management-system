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
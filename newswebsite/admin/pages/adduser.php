<?php

error_reporting(E_ALL);
// echo public_path("users/pukar");
// die();

$errors = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'password' => '',
    'role' => '',
    'gender' => ''
];

$old = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'password' => '',
    'role' => '',
    'gender' => ''

];



if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = 'This field is required.';
        } else {
            $old[$key] = $value;
        }
    }

    if (!isset($_POST['gender'])) {
        $errors['gender'] = 'This field is required.';
    } else {
        $old['gender'] = $_POST['gender'];
    }


    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        $errors['email'] = "The e-mail already exists.";
    }

    if (!array_filter($errors)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];
        $gender = $_POST['gender'];
        $image = "";

        if (!empty($_FILES['image']['name'])) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imgName = md5(uniqid()) . ".$ext";
            $tmpName = $_FILES['image']['tmp_name'];
            $upload_path = public_path("users/$imgName");

            if (!move_uploaded_file($tmpName, $upload_path)) {
                echo 'File not uploaded';
            } else {
                $image = $imgName;
            }
        }

        $sql = "INSERT INTO users (fname, lname, email, password, gender, role, image) VALUES ('$fname', '$lname', '$email', '$password','$gender','$role','$image')";


        if (mysqli_query($conn, $sql)) {
            echo 'Record created successfully.';
        } else {
            echo 'Error:' . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="../public/css/style.css">

</head>

<body>
    <div>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fname"><a style="color:red"><?= $errors['fname']; ?></a>

                    First Name:</label>
                <input type="text" id="fname" class="form-css" name="fname" value=<?= $old['fname']; ?>><br>
            </div>


            <div class="form-group">
                <label for="lname"><a style="color:red"><?= $errors['lname']; ?></a>Last Name:</label>
                <input type="text" id="lname" class="form-css" name="lname" value=<?= $old['lname']; ?>><br>
            </div>


            <div class="form-group">
                <label for="email"><a style="color:red"><?= $errors['email']; ?></a>Email:</label>
                <input type="text" id="email" class="form-css" name="email" value=<?= $old['email']; ?>><br>
            </div>


            <div class="form-group">
                <label for="password"><a style="color:red"><?= $errors['password']; ?></a>Password:</label>
                <input type="password" id="password" class="form-css" name="password"><br>

            </div>

            <div class="form-group">
                <label for="gender"> <a style="color:red"><?= $errors['gender']; ?></a>Gender:</label>
                <label class="form-css"><input type="radio" <?= $old['gender'] == 'male' ? 'checked' : '' ?> name="gender" value="male">Male</label>
                <label class="form-css"><input type="radio" <?= $old['gender'] == 'female' ? 'checked' : '' ?>name="gender" value="female">Female</label><br>
            </div>


            <div class="form-group">
                <label for="role"><a style="color:red"><?= $errors['role']; ?></a>Role:</label>
                <select class="form-css" name="role" id="role">
                    <option value="">Select Role</option>
                    <option <?= $old['role'] == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                    <option <?= $old['role'] == 'user' ? 'selected' : '' ?> value="user">User</option>
                </select><br>
            </div>


            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" id="btn-upload" class="form-css" name="image"><br><br>
            </div>


            <div class="form-group">
                <button id="btn-add">Add Record</button>
            </div>





        </form>

    </div>

</body>

</html>
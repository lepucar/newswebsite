<?php
require_once "../config/helper.php";
require_once "../connection/database.php";

$errors = [
    'email' => '',
    'password' => ''
];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = 'This field is required';
        }
    }

    if (!array_filter($errors)) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            unset($user['password']);
            $_SESSION['user'] = $user;
            $_SESSION['is_login']= true;
            header("Location:" . admin_url());
        } else {
            $errors['email'] = "E-mail or password is incorrect";
        }
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">


        <div class="signup">
            <form action="" method="post">
                <h2 id="login" for="chk">Login</h2>

                <input type="email" name="email" placeholder="Email">
                <label><a style="color:red"><?= $errors['email']; ?></a><label>
                        <input type="password" name="password" placeholder="Password">
                        <label><a style="color:red"><?= $errors['password']; ?></a><label>
                                <button>Log In</button>
            </form>
        </div>


    </div>
</body>

</html>
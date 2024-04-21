<?php
if($_SESSION['user']['role'] == 'admin')
{
    $sql = 'SELECT * FROM users';

}
else
{
    $id = $_SESSION['user']['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = '$id'";

}


$prepare = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../public/css/style.css">

</head>

<body>

    <h1> Users List </h1>

    <br>

    <table class="show-table">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Role</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php
        foreach ($prepare as $user) { ?>

            <tr>
                <td><?= $user['user_id']; ?></td>
                <td><?= $user['fname']; ?></td>
                <td><?= $user['lname']; ?></td>
                <td style="word-break: break-all;"><?= $user['email']; ?></td>
                <td><?= $user['gender']; ?></td>
                <td><?= $user['role']; ?></td>
                <td><img src="<?= public_url("users/".$user['image']); ?>" alt="image" height="30px" width="30px"></td>
                <td>
                    <div class="btns">
                        <?php
                        if($_SESSION['user']['role']=='admin') 
                        {
                        ?>
                        
                            <a href="<?= admin_url('edit?role='.$user['role']);?>">
                            <button class="btn-edit">Edit</button>
                            </a>
                        <?php } ?>
                        
                        <a href="<?= admin_url('delete?id='.$user['user_id']);?>">
                            <button class="btn-delete">Delete</button>
                        </a>
                    </div>

                </td>
            </tr>

        <?php }  ?>
    </table>
</body>

</html>
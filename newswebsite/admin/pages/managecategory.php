<?php
if($_SESSION['user']['role'] == 'admin')
{
    
    $sql = "SELECT users.user_id, users.fname, users.lname, categories.* FROM categories 
    JOIN users on categories.created_by = users.user_id";

}
else
{
    $id = $_SESSION['user']['user_id'];
    $sql = "SELECT users.user_id, users.fname, users.lname, categories.* FROM categories 
    JOIN users on categories.created_by = users.user_id WHERE user_id='$id'";

}


$prepare = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../public/css/style.css">

</head>

<body>

            <div class="form-group">
            <a href="<?= admin_url('addcategory');?>">
                <button id="btn-add">Add Category</button>
            </a>
            </div>

    <h1> Category List </h1>

    <br>

    <table class="show-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Posted By</th>
            <th>Action</th>
        </tr>

        <?php
        foreach ($prepare as $cat) { ?>

            <tr>
                <td><?= $cat['cid']; ?></td>
                <td><?= $cat['name']; ?></td>
                <td><?= $cat['slug']; ?></td>
                
                <td><?= $cat['fname'].' '. $cat['lname']; ?></td>
                
                <td>
                    <div class="btns">
                        <?php
                        if($_SESSION['user']['role']=='admin') 
                        {
                        ?>
                        
                            <a href="<?= admin_url('edit?id='.$cat['cid']);?>">
                            <button class="btn-edit">Edit</button>
                            </a>
                        <?php } ?>
                        
                        <a href="<?= admin_url('deletecat?id='.$cat['cid']);?>">
                            <button class="btn-delete">Delete</button>
                        </a>
                    </div>

                </td>
            </tr>

        <?php }  ?>
    </table>
</body>

</html>
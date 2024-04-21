<?php
if($_SESSION['user']['role'] == 'admin')
{
    
    $sql = "SELECT users.user_id, users.fname, users.lname, categories.cid, categories.name AS catname, news.* FROM news
    JOIN users ON users.user_id = news.created_by
    JOIN categories ON categories.cid = news.category_of";

}
else
{
    $id = $_SESSION['user']['user_id'];
    $sql = "SELECT users.user_id, users.fname, users.lname, categories.cid, categories.name AS catname, news.* FROM news
    JOIN users ON users.user_id = news.created_by
    JOIN categories ON categories.cid = news.category_of WHERE user_id='$id'";

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
            <a href="<?= admin_url('addnews');?>">
                <button id="btn-add">Add News</button>
            </a>
            </div>

    <h1> News List </h1>

    <br>

    <table class="show-table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Image</th>
            <th>Summary</th>
            <th>Posted By</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>

        <?php
        foreach ($prepare as $news) { ?>

            <tr>
                <td><?= $news['nid']; ?></td>
                <td><?= $news['title']; ?></td>
                <td><?= $news['slug']; ?></td>
                <td><?= $news['catname']; ?></td>
                <td><img src="<?= public_url("newsimages/".$news['image']); ?>" alt="image" height="30px" width="30px"></td>
                
                <td><?= $news['summary']; ?></td>
                <td><?= $news['fname'].' '. $news['lname']; ?></td>
                <td><?= $news['created_at']; ?></td>
                <td><?= $news['updated_at']; ?></td>
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
                        
                        <a href="<?= admin_url('deletenews?id='.$news['nid']);?>">
                            <button class="btn-delete">Delete</button>
                        </a>
                    </div>

                </td>
            </tr>

        <?php }  ?>
    </table>
</body>

</html>
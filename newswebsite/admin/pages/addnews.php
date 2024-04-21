<?php

error_reporting(E_ALL);
// echo public_path("users/pukar");
// die();



$catSql = "SELECT * FROM categories";
$catData = mysqli_query($conn, $catSql);

$errors = [
    'title' => '',
    'slug' => '',
    'category_id' => '',
    'summary' => '',
    'image' => '',
    'description' => '',
    'meta_title' => '',
    'meta_description' => '',

];

$old = [
    'title' => '',
    'slug' => '',
    'category_id' => '',
    'summary' => '',
    'description' => '',
    'meta_title' => '',
    'meta_description' => '',

];



if (!empty($_POST)) {

    $validationIgnoreFiles = [
        'image',
        'meta_description',
        'meta_title',
    ];

    foreach ($_POST as $key => $value) {
        if (!in_array($key, $validationIgnoreFiles)) {

            if (empty($value)) {
                $errors[$key] = 'This field is required';
            } else {
                $old[$key] = $value;
            }
        } else {
            $old[$key] = $value;
        }
    }

    if (!array_filter($errors)) {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $catID = $_POST['category_id'];
        $summary = $_POST['summary'];
        $meta_title = $_POST['meta_title'];
        $meta_description = $_POST['meta_description'];
        $description = $_POST['description'];
        $pageviews = 5;
        $postedby = $_SESSION['user']['user_id'];
        $created_at = date('Y-m-d H:i:s');




        $image = "";

        if (!empty($_FILES['image']['name'])) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imgName = md5(uniqid()) . ".$ext";
            $tmpName = $_FILES['image']['tmp_name'];
            $upload_path = public_path("newsimages/$imgName");

            if (!move_uploaded_file($tmpName, $upload_path)) {
                echo 'File not uploaded';
            } else {
                $image = $imgName;
            }
        }

        $sql = "INSERT INTO news (created_by, category_of, title, slug, image, summary, description, created_at, meta_title, meta_description, page_views) 
        VALUES ('$postedby', '$catID', '$title', '$slug','$image', '$summary', '$description', '$created_at', '$meta_title', '$meta_description', '$pageviews')";


        if (mysqli_query($conn, $sql)) {
            echo "Record added successfully.";
            redirect_back();
        } else {
            $_SESSION['error'] = "Record not added";
            redirect_back();
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
                <label for="title"><a style="color:red"><?= $errors['title']; ?></a>

                    Title:</label>
                <input type="text" id="title" class="form-css" name="title" value=<?= $old['title']; ?>><br>
            </div>


            <div class="form-group">
                <label for="Slug"><a style="color:red"><?= $errors['slug']; ?></a>Slug:</label>
                <input type="text" id="slug" class="form-css" name="slug" value=<?= $old['slug']; ?>><br>
            </div>

            <div class="form-group">
                <label for="category_id">Category:
                    <a style="color: red;"><?= $errors['category_id']; ?></a>
                </label>
                <select name="category_id" class="form-css" id="category_id">
                    <option value="">Select Category</option>
                    <?php foreach ($catData as $row) { ?>
                        <option value="<?= $row['cid'] ?>"><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Description"><a style="color:red"><?= $errors['description']; ?></a>Description:</label>
                <textarea style="height:300px" id="description" class="form-css" name="description" value=<?= $old['description']; ?>></textarea><br>
            </div>

            <div class="form-group">
                <label for="Summary"><a style="color:red"><?= $errors['summary']; ?></a>Summary:</label>
                <textarea style="height:150px" id="summary" class="form-css" name="summary" value=<?= $old['summary']; ?>></textarea><br>
            </div>

            <div class="form-group">
                <label for="Meta-Title"><a style="color:red"><?= $errors['meta_title']; ?></a>Meta Title:</label>
                <input type="text" id="meta_title" class="form-css" name="meta_title" value=<?= $old['meta_title']; ?>><br>
            </div>

            <div class="form-group">
                <label for="Meta-Description"><a style="color:red"><?= $errors['meta_description']; ?></a>Meta Description:</label>
                <input type="text" id="meta_description" class="form-css" name="meta_description" value=<?= $old['meta_description']; ?>><br>
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
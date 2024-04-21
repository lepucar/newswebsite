<?php

error_reporting(E_ALL);
// echo public_path("users/pukar");
// die();

$errors = [
    'name' => '',
    'slug' => ''
];

$old = [
    'name' => '',
    'slug' => ''

];



if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = 'This field is required.';
        } else {
            $old[$key] = $value;
        }
    }

    

    $catName = $_POST['name'];
    $sql = "SELECT * FROM categories WHERE name = '$catName'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        $errors['name'] = "The category already exists.";
    }

    if (!array_filter($errors)) {
        $name = $_POST['name'];
        $slug = $_POST['slug'];
        $created_by = $_SESSION['user']['user_id'];

        

        $sql = "INSERT INTO categories (created_by, name, slug) VALUES ('$created_by', '$name', '$slug')";


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
                <label for="name"><a style="color:red"><?= $errors['name']; ?></a>

                    Category Name:</label>
                <input type="text" id="name" class="form-css" name="name" value=<?= $old['name']; ?>><br>
            </div>


            <div class="form-group">
                <label for="slug"><a style="color:red"><?= $errors['slug']; ?></a>Slug:</label>
                <input type="text" id="slug" class="form-css" name="slug" value=<?= $old['slug']; ?>><br>
            </div>


            


            <div class="form-group">
                <button id="btn-add">Add Record</button>
            </div>





        </form>

    </div>

</body>

</html>
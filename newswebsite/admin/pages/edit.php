<?php

    error_reporting(E_ALL);
    // echo public_path("users/pukar");
    // die();
    if(!empty($_POST))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $image = "";


        $errors= [
            'fname' => '',
            'lname' => '',
            'gender' => '',
            'image' => ''
        ];



        if(!empty($_FILES['image']['name']))
        {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imgName = md5(uniqid()).".$ext";
            $tmpName = $_FILES['image']['tmp_name'];
            $upload_path = public_path("users/$imgName");

            if(!move_uploaded_file($tmpName, $upload_path))
            {
                echo 'File not uploaded';
            }
            else{
                $image = $imgName;
            }



            
        }

        $id = $_GET['id'];

        $sql1 = "SELECT * FROM users WHERE id='$id'";
        $prepare = mysqli_query($conn, $sql1);
        $result = mysqli_fetch_assoc($prepare);


        $sql = "INSERT INTO users (fname, lname, email, password, gender, role, image) VALUES ('$fname', '$lname', '$email', '$password','$gender','$role','$image')";
        

        if(mysqli_query($conn, $sql))
        {
            echo 'Filed uploaded successfully.';
        }
        else{
            echo 'Error:'.mysqli_error($conn);
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
        <?php
            foreach ($result as $user) { ?>
            <form method="post" action=""  enctype="multipart/form-data">
            <div class="form-group">
            <label fname">First Name:</label>
            <input type="text" id="fname" class="form-css" name="fname" placeholder="<?=$user['fname'];?>"><br>
            </div>
            

            <div class="form-group">
            <label lname">Last Name:</label>
            <input type="text" id="lname" class="form-css" name="lname" placeholder="<?=$user['fname'];?>><br>   
            </div>
            

            <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" class="form-css" name="email" placeholder="<?=$user['fname'];?>><br>   
            </div>
            

            <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" class="form-css" name="password" placeholder="<?=$user['fname'];?>><br>
    
            </div>
            
            <div class="form-group">
            <label for="gender" >Gender:</label>
            <label class="form-css"><input type="radio"  name="gender" value="male">Male</label>
            <label class="form-css"><input type="radio" name="gender"   value="female">Female</label><br>   
            </div>
            

            <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-css" name="role" id="role">
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select><br>   
            </div>
            

            <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" id ="btn-upload" name="image"><br><br>   
            </div>
            

            <div class="form-group">
            <button id="btn-add">Add Record</button>    
            </div>
            




        </form> 
        
        <?php
        }

        ?>


    </div>

</body>

</html>
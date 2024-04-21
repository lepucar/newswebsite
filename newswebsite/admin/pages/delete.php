<?php

    require_once("../config/helper.php");
    require_once("../connection/database.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE user_id='$id'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $image = $user['image'];
        $imagePath = public_path("users/$image");
        
        if(file_exists($imagePath) && is_file($imagePath))
        {
            unlink($imagePath);
        }

        $sql = "DELETE FROM users WHERE user_id='$id'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            header("Location:".admin_url('showuser'));
        }

    }else{
        header("Location:".admin_url('showuser'));
    }
?>
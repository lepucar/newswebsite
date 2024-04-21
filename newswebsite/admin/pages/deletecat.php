<?php

    require_once("../config/helper.php");
    require_once("../connection/database.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        
        

        $sql = "DELETE FROM categories WHERE cid='$id'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            header("Location:".admin_url('managecategory'));
        }

    }else{
        header("Location:".admin_url('managecategory'));
    }
?>
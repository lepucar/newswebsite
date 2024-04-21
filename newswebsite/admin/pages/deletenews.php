<?php

    require_once("../config/helper.php");
    require_once("../connection/database.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        
        

        $sql = "DELETE FROM news WHERE nid='$id'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            header("Location:".admin_url('managenews'));
        }

    }else{
        header("Location:".admin_url('managenews'));
    }
?>
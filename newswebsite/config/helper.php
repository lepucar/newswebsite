<?php
session_start();
function base_url($url="")
{
    return "http://localhost:8888/newswebsite/$url";
}

function admin_url($url="")
{
    return "http://localhost:8888/newswebsite/admin/$url";
}

function public_path($path="")
{
    return dirname(__DIR__)."/admin/public/$path";
}

function public_url($url="")
{
    return "http://localhost:8888/newswebsite/admin/public/$url";
}

function redirect_back()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}


?>
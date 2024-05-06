<?php
// Pour générer un token
function setToken($motdepasse)
{
    if($_COOKIE['token'] != 1)
    {
        $_SESSION['token'] = $motdepasse;
        setcookie('token',1,(time()+3600));
        return $motdepasse;
    }
    else
    {
        return $_SESSION['token'];
    } 
}
function getToken()
{
    if(isset($_SESSION['token']) && isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
        return true;
    else
        return false;
}
?>
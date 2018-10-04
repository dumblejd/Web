<?php
//"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"    password
//"^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$"  mail
session_start();
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];

check_legal($username,$password,$email);

function check_legal($username,$password,$email)
{
    if($username==null||$password==null||$email==null)
    {
        header("location:login.html");
                //echo '<html><head><Script Language="JavaScript">alert("empty field");</Script></head></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=login.html\">";
    }
    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/",$password))
    {
        header("location:login.html");
    }
    else if(!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/",$email))
    {
        header("location:login.html");
    }
    else
    {
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
        $_SESSION['email']=$email;
        header("location:welcome.php");
    }
}
?>
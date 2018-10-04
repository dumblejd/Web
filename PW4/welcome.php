<?php
session_start();
if($_SESSION['username']==null||$_SESSION['password']==null||$_SESSION['email']==null) {
    header("location:login.html");
}
else{
    if(!isset($_SESSION['count'])){
        $_SESSION['count']=1;
    }else{
        $_SESSION['count']=$_SESSION['count']+1;
    }
    echo "Welcome: ".$_SESSION['username']." It's your ".$_SESSION['count']." time visit this website.";
    echo "<br><a href='welcome.php'>Reload<a><br>";
    echo "<br><a href='logout.php'>Logout<a>";
}
?>
<?php
//"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$"    password
//"^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$"  mail

//==================================
session_start();
$username=$_POST['username'];
$password=$_POST['password'];
//$email=$_POST['email'];

check_legal($username,$password);

function check_legal($username,$password)
{
    if($username==null||$password==null)
    {
        header("location:login.html");
                //echo '<html><head><Script Language="JavaScript">alert("empty field");</Script></head></html>' . "<meta http-equiv=\"refresh\" content=\"0;url=login.html\">";
    }
    $db = "BookStore";
    $username_db = "root";
    $password_db = "root";
    $host = "localhost";
    $port = 8889;
// create
    $conn = mysqli_connect(
        $host,
        $username_db,
        $password_db,
        $db,
        $port
    );
// check
    if ($conn->connect_error)
    {
        die("fail: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE UserName='{$username}'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        echo "<script>console.log(".json_encode(var_export($row, true)).");</script>";

        if($row["Password"]==$password)
        {
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            header("location:books.php");
        }
        else
        {
            header("location:login.html");
        }
    }
    else
    {
        header("location:login.html");
    }

}mysqli_close();
?>
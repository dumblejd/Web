<?php
/**
 * Created by IntelliJ IDEA.
 * User: dijin
 * Date: 2018/10/24
 * Time: 11:56
 */
$db = "PW7";
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
$sql = "select * FROM Book";
$result = mysqli_query($conn,$sql);
if(!$result)
{
    die("fail query");
}
$array=array();
while($row=mysqli_fetch_assoc($result))
{
    $array[] = $row;
}
echo json_encode($array);
?>
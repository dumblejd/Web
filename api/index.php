<?php
/**
 * Created by IntelliJ IDEA.
 * User: dijin
 * Date: 2018/10/24
 * Time: 12:29
 */



$db = "HW4";
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
class User
{
    public $title;
    public $year;
    public $price;
    public $category;
    public $authors;
}

$path = $_SERVER['PATH_INFO'];
$arr = explode('/',$path);
//print_r($arr[1]);

if($arr[1]!="")
{
    $sql = "select title,year,price,category FROM Book where book_id='{$arr[1]}'";

    $result = mysqli_query($conn,$sql);
    if(!$result)
    {
        die("fail query");
    }
    $row=mysqli_fetch_array($result);


    $user = new User();
    $user->title=$row["title"];
    $user->year=$row["year"];
    $user->price=$row["price"];
    $user->category=$row["category"];


    $sql="select author_name from Authors where author_id in (select author_id from book_authors where book_id='{$arr[1]}')";
    $result = mysqli_query($conn,$sql);
    if(!$result)
    {
        die("fail query");
    }
    $authors=array();
    while($row=mysqli_fetch_assoc($result))
    {
        $authors[] = $row["author_name"];
    }
    $user->authors=$authors;
    $data[]=$user;
    echo json_encode($data);
}

else{
    $sql = "select Title,Price,Category FROM Book";

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
}

?>
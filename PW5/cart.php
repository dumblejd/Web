
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: dijin
 * Date: 2018/10/3
 * Time: 12:23
 */
session_start();

if($_SESSION['username']==null||$_SESSION['password']==null) {
    header("location:login.html");
}
else{
    $book_id=$_GET["BookID"];
    $username=$_SESSION['username'];
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
    $sql="select * from book where bookid='{$book_id}'";
    $result = mysqli_query($conn,$sql);
    $one_book= mysqli_fetch_array($result);
    //die( "".$username.$one_book["BookID"].$one_book["CurrentPrice"]);
    $sql="INSERT INTO shoppingcart (`UserName`, `BookID`) VALUES ('{$username}',{$one_book["BookID"]})";
    if(!mysqli_query($conn,$sql))
    {
        echo $one_book["BookTitle"]."is already in your list";
        //echo "<script>alert('"{$one_book["BookTitle"]}."is already in your list"')</script>";
    }
    $sql="select * from shoppingcart where username='{$username}'";
    $result = mysqli_query($conn,$sql);
    echo "<table class='table table-striped'><tr><td>Book Title</td><td>List Price</td></tr>";
    while($row = mysqli_fetch_array($result))
    {
        $sql="select * from book where bookid='{$row["BookID"]}'";
        $book=mysqli_fetch_array(mysqli_query($conn,$sql));
        echo "<tr><td>". $book["BookTitle"] ."</td><td>". $book["ListPrice"]."</td></tr>";

    }
    echo "</table>";
    echo "<a href='books.php'>Continue Shopping</a>";
    echo "<br><a href='logout.php'>Logout</a>";

}mysqli_close();
?>
</body>

<?php
session_start();
if($_SESSION['username']==null)
{
    header("location:login.html");
}
$search = $_GET["search"];
?>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>




<form action="books.php" method="GET">
    <input type="text" name="search" value="<?php echo $search ?>">
    <input type="submit" value="Search">
</form>


<?php

$username_db = 'root';
$password_db = 'root';
$db = 'bookstore';
$host = 'localhost';
$port = 8889;

$conn = mysqli_connect(
    $host,
    $username_db,
    $password_db,
    $db,
    $port
);


if (!$conn){

    echo "Connection failed!";
    exit;

}

$sql = "SELECT * FROM Book";
if ($search){
    $sql .= " WHERE BookTitle LIKE '%$search%' ";

}


$result = mysqli_query($conn, $sql);
echo "<table class='table table-striped'><tr><td>Book Title</td><td>List Price</td></tr>";

while($row = mysqli_fetch_array($result)){

    echo "<tr><td>". $row["BookTitle"] ."</td><td>". $row["ListPrice"]."</td><td><a href='cart.php?BookID={$row["BookID"]}'>Add to list</a></td></tr>";

}

echo "</table>";
echo "<br><a href='logout.php'>Logout</a>";
mysqli_close();

?>

</body>
</html>

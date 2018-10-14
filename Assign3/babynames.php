<?php
/**
 * Created by IntelliJ IDEA.
 * User: dijin
 * Date: 2018/10/11
 * Time: 23:29
 */
$db = "HW3";
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
$year=$_POST["year"];
$sex=$_POST["sex"];

if($year=="all" && $sex=="all")
{
    $sql = "select * FROM BabyNames WHERE ranking<=5 ORDER BY YEAR,ranking ASC";
}
else if ($year=="all" || $sex=="all")
{
    if($year=="all")
    {
        $sql = "SELECT * FROM BabyNames WHERE gender='{$sex}' and ranking<=5 order by year,ranking asc";
    }
    if($sex=="all")
    {
        $sql = "SELECT * FROM BabyNames WHERE year='{$year}' and ranking<=5 order by ranking asc";
    }

}
else
{
    $sql = "SELECT * FROM BabyNames WHERE year='{$year}' and gender='{$sex}' order by ranking asc";
}
//die($sql);
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
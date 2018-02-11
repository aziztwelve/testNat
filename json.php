<?php

header('Content-Type: application/json');

//connect to database
$connect = mysqli_connect("localhost", "root", "1202", "testNat");  

//select from database 
$sql = "SELECT * FROM tweet";  
$result = mysqli_query($connect, $sql);  
// var_dump($result);
$json_array = array();  
while($row = mysqli_fetch_assoc($result))  
{  
     $json_array[] = $row;  
}  
/*echo '<pre>';  
print_r(json_encode($json_array));  
echo '</pre>';*/  

//transform 
echo json_encode($json_array);

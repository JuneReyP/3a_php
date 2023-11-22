<?php 
try{

$host = "localhost";
$dbname = "3a_crud";
$user = "root";
$password = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname",$user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $err){
    echo $err->getMessage();
}


// if($conn){
//     echo "Connected to database";
// }
?>
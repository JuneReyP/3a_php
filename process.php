<?php 
include 'conn.php';


if(isset($_POST['addContent'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $addContent = $conn->prepare("INSERT INTO contents (title, content) VALUES (?, ?)");
    $addContent->execute([$title, $content]);
    $msg = "Data inserted successfully!";
    header("Location: index.php?msg=$msg");
}


?>
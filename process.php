<?php 
include 'conn.php';

// adding data to database
if(isset($_POST['addContent'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $addContent = $conn->prepare("INSERT INTO contents (title, content) VALUES (?, ?)");
    $addContent->execute([$title, $content]);
    $msg = "Data inserted successfully!";
    header("Location: index.php?msg=$msg");
}

// updating data
if(isset($_POST['updateContent'])){
    $id = $_POST['postID'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
    $update = $conn->prepare("UPDATE contents SET title = ?, content = ? WHERE id = ?");
    $update->execute([
        $title,
        $content,
        $id
    ]);

    $msg = "Data updated successfully!";
    header("Location: index.php?msg=$msg");
}

if(isset($_GET['delete'])){
    $id = $_GET['id'];

    // DELETE FROM table_name WHERE condition;
    $delete = $conn->prepare("DELETE FROM contents WHERE id = ?");
    $delete->execute([$id]);

    $msg = "Data deleted successfully!";
    header("Location: index.php?msg=$msg");
}
?>
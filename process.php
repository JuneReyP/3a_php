<?php
include 'conn.php';

// adding data to database
if (isset($_POST['addContent'])) {
    $id = $_POST['userID'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $addContent = $conn->prepare("INSERT INTO contents (user_id, title, content) VALUES (?, ?, ?)");
    $addContent->execute([$id, $title, $content]);
    $msg = "Data inserted successfully!";
    header("Location: index.php?msg=$msg");
}

// updating data
if (isset($_POST['updateContent'])) {
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

if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    // DELETE FROM table_name WHERE condition;
    $delete = $conn->prepare("DELETE FROM contents WHERE id = ?");
    $delete->execute([$id]);

    $msg = "Data deleted successfully!";
    header("Location: index.php?msg=$msg");
}

// register a user
if (isset($_POST['register'])) {
    // get the input data using POST method
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $conPass = $_POST['confirmPass'];

    // test the user password if same
    if ($pass == $conPass) {
        // encrypt the password before sending it to the database
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        // INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
        $createUser = $conn->prepare("INSERT INTO users(user_fname, user_lname, user_email, user_pass) VALUES(?, ?, ?, ?)");
        // execute the process since we uses the keyword prepare()
        $createUser->execute([
            $fname,
            $lname,
            $email,
            $hash
        ]);

        // where to go after the process
        $msg = "User created successfully!";
        header("Location: register.php?msg=$msg");
    } else {
        // output if password do not match
        $msg = "Password do not match!";
        header("Location: register.php?msg=$msg");
    }
}

// login user
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $getData = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $getData->execute([$email]);

    foreach ($getData as $data) {
        if ($email == $data['user_email'] && password_verify($pass, $data['user_pass'])) {
            session_start();
            $_SESSION['logged-in'] = true;
            $_SESSION['userID'] = $data['user_id'];

            $msg = "User successfully logged-in!";
            header("Location: index.php?msg=$msg");
        } else {
            $msg = "Email or Password do not match!";
            header("Location: login.php?msg=$msg");
        }
    }
}

// logout
if(isset($_GET['logout'])){
    session_start();

    unset($_SESSION['logged-in']);
    unset($_SESSION['userID']);

    header("Location: login.php");
}
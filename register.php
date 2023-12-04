<?php include 'header.php'; 
if(isset($_SESSION['logged-in'])){
    $msg = "Access denied!";
    header("Location: index.php?msg=$msg");
}
?>

<div class="row justify-content-center">
    <div class="col-md-4 mt-4 p-3 shadow">
        <!-- display message start -->
        <?php if (isset($_GET['msg'])) { ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $_GET['msg'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php  } ?>
        <!-- display message end -->
        <form action="process.php" method="post">
            <h2>Register a User</h2>
            <div class="mb-3 mt-4">
                <label for="fname">Firstname</label>
                <input type="text" name="fname" id="fname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lname">Lastname</label>
                <input type="text" name="lname" id="lname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pass1">Password</label>
                <input type="password" name="pass" id="pass1" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm">Confirm-Password</label>
                <input type="password" name="confirmPass" id="confirm" class="form-control" required>
            </div>
            <div class="mb-3">
                <button type="submit" name="register" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>

</html>
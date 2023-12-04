<?php include 'header.php'; 
if(isset($_SESSION['logged-in'])){
    $msg = "Access denied!";
    header("Location: index.php?msg=$msg");
}
?>
<!-- login content start -->
<div class="row justify-content-center">
    <div class="col-md-4 mt-4 border p-3">
        <!-- display message start -->
        <?php if (isset($_GET['msg'])) { ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $_GET['msg'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php  } ?>
        <!-- display message end -->
        <form action="process.php" method="post">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" name="login" class="btn btn-success">Login</button>
                <a href="register.php" class="btn btn-warning">Register</a>
            </div>
        </form>
    </div>
</div>
<!-- login content end -->
</div>
</body>

</html>
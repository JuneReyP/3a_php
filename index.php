<?php include 'header.php';
if(!isset($_SESSION['logged-in'])){
    $msg = "Access denied!";
    header("Location: login.php?msg=$msg");
    ob_end_flush();
}
?>

        <!-- content start -->
        <div class="row shadow mt-3">
            <div class="col-3">
                <!-- display message start -->
                <?php if (isset($_GET['msg'])) { ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?= $_GET['msg'] ?></strong>| <span><?= $_SESSION['userID']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php  } ?>
                <!-- display message end -->
                <?php
                if (isset($_GET['edit'])) { ?>
                <!-- this is for update form -->
                <?php 
                    $id = $_GET['id'];

                    $getPost = $conn->prepare("SELECT * FROM contents WHERE id = ?");
                    $getPost->execute([$id]);

                    foreach($getPost as $post){ ?>                    
                    <form action="process.php" method="post">
                        <input type="hidden" name="postID" value="<?= $post['id'] ?>">
                        <div class="form shadow p-3 m-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?= $post['title'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"><?= $post['content'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="updateContent" class="btn btn-warning mb-3">Update</button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                <?php } else { ?>
                    <!-- for adding form -->
                    <form action="process.php" method="post">
                        <input type="hidden" name="userID" value="<?= $_SESSION['userID']; ?>">
                        <div class="form shadow p-3 m-2">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleFormControlInput1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="addContent" class="btn btn-primary mb-3">Submit</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>

            <div class="col-9">
                <div class="table">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['userID'];
                            $select = $conn->prepare("SELECT * FROM contents WHERE user_id = ?");
                            $select->execute([$id]);
                            $cnt = 1;
                            foreach ($select as $selected) {
                                // echo $selected['title'];
                            ?>
                                <tr>
                                    <td><?= $cnt ?></td>
                                    <td><?= $selected['title'] ?></td>
                                    <td><?= $selected['content'] ?></td>
                                    <td> <a href='index.php?edit&id=<?= $selected["id"] ?>' class="text-decoration-none">✏️</a> | <a href="process.php?delete&id=<?= $selected["id"] ?>" class="text-decoration-none">❌</a></td>
                                </tr>
                            <?php
                                $cnt++;
                            }
                            ?>
                            <!-- <tr>
                                <td>1</td>
                                <td>Starlink</td>
                                <td>Subscription</td>
                                <td>✅ | ❌</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-3 shadow border border-danger">
            <div class="col-9">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, alias eveniet! Ad perspiciatis quisquam quaerat ipsam nemo vel molestias saepe sint qui adipisci! Sunt provident rerum obcaecati amet ut sequi.</p>
            </div>
            <div class="col-3">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia quod animi aut nostrum voluptatibus, repellat eveniet cum autem beatae sint ab debitis harum eligendi architecto similique dolor, repellendus laboriosam impedit.</p>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-3 shadow p-4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione voluptas eum, alias nam officiis neque necessitatibus consectetur eos! In molestias dolorum sint ipsum, eaque magni earum aut mollitia accusamus nihil.</p>
            </div>
            <div class="col-3 shadow p-4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione voluptas eum, alias nam officiis neque necessitatibus consectetur eos! In molestias dolorum sint ipsum, eaque magni earum aut mollitia accusamus nihil.</p>
            </div>
            <div class="col-3 shadow p-4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione voluptas eum, alias nam officiis neque necessitatibus consectetur eos! In molestias dolorum sint ipsum, eaque magni earum aut mollitia accusamus nihil.</p>
            </div>
        </div>
        <!-- content end -->
    </div>
</body>

</html>
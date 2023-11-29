<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- navbar end -->

        <!-- content start -->
        <div class="row shadow mt-3">
            <div class="col-3">
                <!-- display message start -->
                <?php if (isset($_GET['msg'])) { ?>

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?= $_GET['msg'] ?></strong>
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
                            $select = $conn->query("SELECT * FROM contents");
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
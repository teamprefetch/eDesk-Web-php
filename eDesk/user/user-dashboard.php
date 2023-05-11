<?php
include 'partials/header.php';

// fetch current user's posts from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, office_id, body FROM post WHERE user_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>


<section class="dashboard">

    <?php if (isset($_SESSION['user-complain-success'])): // shows if add post was successful 
            ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['user-complain-success'];
                unset($_SESSION['user-complain-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <?php if (isset($_SESSION['user-suggestion-success'])): // shows if add post was successful 
            ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['user-suggestion-success'];
                unset($_SESSION['user-suggestion-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <?php if (isset($_SESSION['user-request-success'])): // shows if add post was successful 
            ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['user-request-success'];
                unset($_SESSION['user-request-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="user-complain.php"><i class="uil uil-pen"></i>
                        <h5>Submit a Complain</h5>
                    </a>
                </li>
                <li>
                    <a href="user-suggestion.php"><i class="uil uil-postcard"></i>
                        <h5>Submit a Suggestion</h5>
                    </a>
                </li>
                <li>
                    <a href="user-request.php"><i class="uil uil-user-plus"></i>
                        <h5>Submit a Request</h5>
                    </a>
                </li>
                <li>
                    <a href="user-dashboard.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Posts</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Posts</h2>
            <table id='table'>
                <thead>
                    <tr align='center'>
                        <th>Title</th>
                        <th>Against Office</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                        <!-- get category title of each post from categories table -->
                        <?php
                        $category_id = $post['office_id'];
                        $category_query = "SELECT title FROM adminaddoffice WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                        ?>
                        <tr>
                            <td>
                                <?= $post['title'] ?>
                            </td>
                            <td>
                                <?= $category['title'] ?>
                            </td>
                            <td>
                                <?= $post['body'] ?>
                            </td>
                            <td align="center"><a href="<?= ROOT_URL ?>user/user-edit-post.php?id=<?= $post['id'] ?>"
                                    class="btn sm">Edit</a> <a
                                    href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>"
                                    class="btn sm danger">Delete</a></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </main>
    </div>
</section>


<?php
include '../partials/footer.php';
?>
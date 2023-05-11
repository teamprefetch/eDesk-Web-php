<?php
include 'partials/header.php';

// fetch current user's posts from database
$current_user_id = $_SESSION['admin-id'];
$query = "SELECT id, title, office_id, body, type FROM post WHERE author_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>


<section class="dashboard">
    <?php if (isset($_SESSION['add-post-success'])) : // shows if add post was successful 
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
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
                    <a href="admin-add-office.php"><i class="uil uil-pen"></i>
                        <h5>Add Office</h5>
                    </a>
                </li>
                <li>
                    <a href="admin-user-management.php"><i class="uil uil-postcard"></i>
                        <h5>User Management</h5>
                    </a>
                </li>
                <li>
                    <a href="admin-add-post.php"><i class="uil uil-user-plus"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="admin-manage-post.php"><i class="uil uil-users-alt"></i>
                        <h5>Manage Post</h5>
                    </a>
                </li>
                <li>
                    <a href="admin-manage-office.php"><i class="uil uil-edit"></i>
                        <h5>Manage Office</h5>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <h2>Manage Posts</h2>
            <table id="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Against Office</th>
                        <th>Descriprion</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
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
                                <?= substr($post['body'], 0, 150) ?>...
                            </td>
                            <td>
                                <?= $post['type'] ?>
                            </td>
                            <td align="center"><a href="<?= ROOT_URL ?>admin/admin-edit-post.php?id=<?= $post['id'] ?>" class="btn sm">Edit</a> <a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">Delete</a></td>
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
<?php
include 'partials/header.php';

// fetch offices from database but not current user
// $current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM adminaddoffice";
$offices = mysqli_query($connection, $query);
?>


<section class="dashboard">
    <?php if (isset($_SESSION['edit-office-success'])) :  // shows if add post was successful 
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-office-success'];
                unset($_SESSION['edit-office-success']);
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
            <h2>Manage office</h2>
            <table id='table'>
                <thead>
                    <tr align="center">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($office = mysqli_fetch_assoc($offices)) : ?>
                        <tr>
                            <td><?= $office['title'] ?></td>
                            <td><?= $office['description'] ?></td>
                            <td align="center"><a href="<?= ROOT_URL ?>admin/edit-office.php?id=<?= $office['id'] ?>" class="btn sm">Edit</a> <a href="<?= ROOT_URL ?>admin/delete-user-logic.php?id=<?= $office['id'] ?>" class="btn sm danger">Delete</a></td>
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
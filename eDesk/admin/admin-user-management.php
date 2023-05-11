<?php
include 'partials/header.php';

// fetch users from database but not current user
// $current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM usermanagement";
$users = mysqli_query($connection, $query);
?>


<section class="dashboard">
    <?php if (isset($_SESSION['active-user-success'])) :  // shows if add post was successful 
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['active-user-success'];
                unset($_SESSION['active-user-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <?php if (isset($_SESSION['deactive-user-success'])) :  // shows if add post was successful 
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['deactive-user-success'];
                unset($_SESSION['deactive-user-success']);
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
            <h2>User Management</h2>
            <table id='table'>
                <thead>
                    <tr align="center">
                        <th>Name</th>
                        <th>UserID</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                        <tr>
                            <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                            <td><?= $user['userid'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['stat'] ?></td>
                            <td align="center"><a href="<?= ROOT_URL ?>admin/active-user-logic.php?id=<?= $user['id'] ?>" class="btn sm">Activate</a> <a href="<?= ROOT_URL ?>admin/deactive-user-logic.php?id=<?= $user['id'] ?>" class="btn sm">Deactivate</a>   <a href="<?= ROOT_URL ?>admin/delete-user-logic.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
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
<?php
include 'partials/header.php';
?>


<section class="dashboard">
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
    </div>
</section>


<?php
include '../partials/footer.php';
?>
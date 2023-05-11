<?php
require 'config/database.php';

// fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT picture FROM usermanagement WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $picture = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Desk | All solusions in one platform</title>

    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">

    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    
</head>

<body>
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>user/user-index.php" class="nav__logo">e-Desk</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'images/' . $picture['picture'] ?>">
                        </div>
                        <ul>
                            <li><a href="<?= ROOT_URL ?>user/user-dashboard.php">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL ?>user/user-complain.php">Submit a Complain</a></li>
                            <li><a href="<?= ROOT_URL ?>user/user-suggestion.php">Submit a Suggestion</a></li>
                            <li><a href="<?= ROOT_URL ?>user/user-request.php">Submit a Request</a></li>
                            <li><a href="<?= ROOT_URL ?>user/user-profile.php">Profile</a></li>
                            <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="<?= ROOT_URL ?>signin.php">SignIn</a></li>
                <?php endif ?>
            </ul>

            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!-- ============= END OF NAV ============= -->
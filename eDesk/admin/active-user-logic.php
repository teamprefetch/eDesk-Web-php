<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM usermanagement WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // make sure we got back only one user
    if(mysqli_num_rows($result) == 1) {

        $active_user_query = "UPDATE usermanagement SET stat = 'active' WHERE id =$id";
    
        $active_user_result = mysqli_query($connection, $active_user_query);
        if(mysqli_errno($connection)) {
            $_SESSION['active-user'] = "Couldn't active '{$user['firstname']} {$user['lastname']}'";
        } else {
            $_SESSION['active-user-success'] = "User '{$user['firstname']} {$user['lastname']}' activated successfully";
        }
    }

}

header('location: ' . ROOT_URL . 'admin/admin-user-management.php');
die();
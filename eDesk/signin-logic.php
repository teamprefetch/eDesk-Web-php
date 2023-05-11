<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $userid = filter_var($_POST['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$userid) {
        $_SESSION['signin'] = "User ID is required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password is required";
    } else {
        // fetch user from database
        $fetch_user_query = "SELECT * FROM usermanagement WHERE userid='$userid'";
        $fetch_admin_query = "SELECT * FROM adminmanagement WHERE userid='$userid' and password='$password'";

        $fetch_user_result = mysqli_query($connection, $fetch_user_query);
        $fetch_admin_result = mysqli_query($connection, $fetch_admin_query);


        if (mysqli_num_rows($fetch_user_result) == 1) {
            // convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];

            // compare form password with database password
            if (password_verify($password, $db_password)) {
                // set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                $_SESSION['user_is_user'] = true;
                $_SESSION['user_is_admin'] = false;

                // echo $user_record['id'];
                // echo $_SESSION['user_is_user'];
                // echo $_SESSION['user_is_admin'];

                // log user in
                header('location: ' . ROOT_URL . 'user/user-index.php');
            } else {
                $_SESSION['signin'] = "Please check your inputs";
            }
        } elseif (mysqli_num_rows($fetch_admin_result) == 1) {
            // convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_admin_result);

            $_SESSION['admin-id'] = $user_record['id'];
            $_SESSION['user_is_admin'] = true;
            $_SESSION['user_is_user'] = false;

            // echo $user_record['id'];
            // echo $_SESSION['user_is_user'];
            // echo $_SESSION['user_is_admin'];

            header('location: ' . ROOT_URL . 'admin/admin-index.php');
        } else {
            $_SESSION['signin'] = "User not found";
        }
    }

    // if any problem, redirect back to signin page with login data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}

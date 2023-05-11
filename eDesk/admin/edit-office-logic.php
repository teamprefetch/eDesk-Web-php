<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate inputs
    if(!$title || !$description) {
        $_SESSION['edit-office'] = "Invalid form input on edit office page";
    } else {
        $query = "UPDATE adminaddoffice SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)) {
            $_SESSION['edit-office'] = "Couldn't update office";
        } else {
            $_SESSION['edit-office-success'] = "Office $title updated successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/admin-manage-office.php');
die();
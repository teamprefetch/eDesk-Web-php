<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$title) {
        $_SESSION['add-office'] = "Enter office";
    } elseif (!$description) {
        $_SESSION['add-category'] = "Enter description";
    }

    // redirect back to add category page with form data if there was invalid input
    if (isset($_SESSION['add-office'])) {
        $_SESSION['add-office-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/admin-add-office.php');
        die();
    } else {
        // insert category into database
        $query = "INSERT INTO adminaddoffice (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['add-office'] = "Couldn't add category";
            header('location: ' . ROOT_URL . 'admin/admin-add-office.php');
            die();
        } else {
            $_SESSION['add-office-success'] = "office $title added successfully";
            header('location: ' . ROOT_URL . 'admin/admin-manage-office.php');
            die();
        }
    }
}

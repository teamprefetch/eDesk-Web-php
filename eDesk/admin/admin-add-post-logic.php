<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['admin-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $picture = $_FILES['picture'];


    // validate form data
    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Enter post body";
    } elseif (!$picture['name']) {
        $_SESSION['add-post'] = "Add Image please";
    } else {
        // WORK ON THUMBNAIL
        // rename the image
        $time = time(); // make each image name unique
        $picture_name = $time . $picture['name'];
        $picture_tmp_name = $picture['tmp_name'];
        $picture_destination_path = '../images/' . $picture_name;

        // make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $picture_name);
        $extension = end($extension);
        if (in_array($extension, $allowed_files)) {
            // make sure image is not too large (20MB+)
            if ($picture['size'] < 2_000_0000) {
                // upload thumbnail
                move_uploaded_file($picture_tmp_name, $picture_destination_path);
            } else {
                $_SESSION['add-post'] = "File size is too large, should be less than 20 MB";
            }
        } else {
            $_SESSION['add-post'] = "File should be png, jpg or jpeg";
        }
    }

    // redirect back (with form data) to add-post page if there is any problem
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/admin-add-post.php');
        die();
    } else {

        // insert post into database
        $query = "INSERT INTO post (title, body, picture, office_id, author_id, type) VALUES ('$title', '$body', '$picture_name', '$category_id', '$author_id', 'Admin')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: ' . ROOT_URL . 'admin/admin-manage-post.php');
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'admin/admin-add-post.php');
die();

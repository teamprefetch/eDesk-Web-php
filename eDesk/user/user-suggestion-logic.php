<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $picture = $_FILES['picture'];


    // validate form data
    if (!$title) {
        $_SESSION['user-suggestion'] = "Enter post title";
    } elseif (!$category_id) {
        $_SESSION['user-suggestion'] = "Select post category";
    } elseif (!$body) {
        $_SESSION['user-suggestion'] = "Enter post body";
    } elseif (!$picture['name']) {
        $_SESSION['user-suggestion'] = "Add Image please";
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
                $_SESSION['user-suggestion'] = "File size is too large, should be less than 20 MB";
            }
        } else {
            $_SESSION['user-suggestion'] = "File should be png, jpg or jpeg";
        }
    }

    // redirect back (with form data) to user-suggestion page if there is any problem
    if (isset($_SESSION['user-suggestion'])) {
        $_SESSION['user-suggestion-data'] = $_POST;
        header('location: ' . ROOT_URL . 'user/user-suggestion.php');
        die();
    } else {

        // insert post into database
        $query = "INSERT INTO post (title, body, picture, office_id, user_id, type) VALUES ('$title', '$body', '$picture_name', '$category_id', '$author_id', 'Suggestion')";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['user-suggestion-success'] = "New suggestion post added successfully";
            header('location: ' . ROOT_URL . 'user/user-dashboard.php');
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'user/user-suggestion.php');
die();

<?php
require 'config/database.php';

// make sure edit post button was clicked
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_picture_name = filter_var($_POST['previous_picture_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $picture = $_FILES['picture'];

    // check and validate input values
    if (!$title) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } else {
        // delete existing picture if new picture is available
        if ($picture['name']) {
            $previous_picture_path = '../images/' . $previous_picture_name;
            if ($previous_picture_path) {
                unlink($previous_picture_path);
            }

            // WORK ON NEW picture
            // rename image
            $time = time(); // make each image name upload unique using current timestamp
            $picture_name = $time . $picture['name'];
            $picture_tmp_name = $picture['tmp_name'];
            $picture_destination_path = '../images/' . $picture_name;

            //make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $picture_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                // make sure picture is not too large (20 MB+)
                if ($picture['size'] < 20000000) {
                    // upload picture
                    move_uploaded_file($picture_tmp_name, $picture_destination_path);
                } else {
                    $_SESSION['edit-post'] = "Couldn't update post. Picture size is too large, should be less than 2 MB";
                }
            } else {
                $_SESSION['edit-post'] = "Couldn't update post. Picture should be png jpg or jpeg";
            }
        }
    }


    if ($_SESSION['edit-post']) {
        // redirect to mannage form page if form was invalid
        header('location: ' . ROOT_URL . 'admin/admin-edit-post.php');
        die();
    } else {

        // set picture name if a new one was uploaded, else keep the old picture name
        $picture_to_insert = $picture_name ?? $previous_picture_name;

        $query = "UPDATE post SET title='$title', body='$body', picture='$picture_to_insert', office_id=$category_id WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }

    if (!mysqli_errno($connection)) {
        $_SESSION['edit-post-success'] = "Post updated successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/admin-edit-post.php');
die();
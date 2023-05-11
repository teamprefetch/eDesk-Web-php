<?php
require 'config/database.php';

// get signup form data if signup button was clicked
if (isset($_POST['submit']))
{
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userid = filter_var($_POST['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $picture = $_FILES['picture'];

    // validate input values
    if (!$firstname)
    {
        $_SESSION['signup'] = "Please enter your First Name";
    }
    elseif (!$lastname)
    {
        $_SESSION['signup'] = "Please enter your Last Name";
    }
    elseif (!$userid)
    {
        $_SESSION['signup'] = "Please enter your Username";
    }
    elseif (!$email)
    {
        $_SESSION['signup'] = "Please enter a valid email";
    }
    elseif (strlen($password) < 8 || strlen($confirmpassword) < 8)
    {
        $_SESSION['signup'] = "Password should be minimum 8 characters long";
    }
    elseif (!$picture['name'])
    {
        $_SESSION['signup'] = "Please add an avatar";
    }
    else
    {
        // check if passwords don't match
        if ($password !== $confirmpassword)
        {
            $_SESSION['signup'] = "Passwords did not match";
        }
        else
        {
            // hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // check if username or email is already exist in the database
            $user_check_query = "SELECT * FROM usermanagement WHERE userid='$userid' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);


            if (mysqli_num_rows($user_check_result) > 0)
            {
                $_SESSION['signup'] = "Username or Email already exist";
            }
            else
            {
                // work on avatar
                // rename avatar
                $time = time(); //make each image name unique using current timestamp
                $picture_name = $time . $picture['name'];
                $picture_tmp_name = $picture['tmp_name'];
                $picture_destination_path = 'images/' . $picture_name;

                // make sure the file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $picture_name);
                $extension = end($extension);

                if (in_array($extension, $allowed_files))
                {
                    // make sure image is not too large (10 MB+)
                    if ($picture['size'] < 10000000)
                    {
                        //upload avatar
                        move_uploaded_file($picture_tmp_name, $picture_destination_path);
                    }
                    else
                    {
                        $_SESSION['signup'] = "File size is too big, should be less than 1 MB";
                    }
                }
                else
                {
                    $_SESSION['signup'] = "File should be png, jpg or jpeg";
                }
            }
        }
    }

    // redirect back to signup page if there was any problem
    if (isset($_SESSION['signup']))
    {
        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    }
    else
    {
        // insert new user into users table
        $insert_user_query = "INSERT INTO usermanagement (firstname, lastname, userid, email, password, picture, stat) VALUES ('$firstname', '$lastname', '$userid', '$email', '$hashed_password', '$picture_name', 'pending')";
        $insert_user_query = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection))
        {
            // redirect to login page with success message
            $_SESSION['signup-success'] = "Registration successful. Please log in!";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}

<?php
include 'partials/header.php';

// get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$userid = $_SESSION['signup-data']['userid'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

//delete signup data session
unset($_SESSION['signup-data']);
?>



<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
        <?php if (isset($_SESSION['signup'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
            <input type="text" name="userid" value="<?= $userid ?>" placeholder="User ID">
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="password" name="password" value="<?= $password ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <div class="form__control">
                <label for="picture">Add Profile Photo</label>
                <input type="file" name="picture" id="picture">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Login</a></small>
        </form>
    </div>
</section>



<?php
include 'partials/footer.php';
?>
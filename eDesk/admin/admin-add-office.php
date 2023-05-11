<?php
include 'partials/header.php';

// get back form data if invalid
$title = $_SESSION['add-office-data']['title'] ?? null;
$description = $_SESSION['add-office-data']['description'] ?? null;

unset($_SESSION['add-office-data']);
?>


<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Office</h2>
        <?php if (isset($_SESSION['add-office'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-office'];
                    unset($_SESSION['add-office']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/admin-add-office-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Office Name">
            <textarea style="resize:none" rows="4" name="description" placeholder="Short description"><?= $description ?></textarea>
            <button type="submit" name="submit" class="btn">Add Office</button>
        </form>
    </div>
</section>



<?php
include '../partials/footer.php';
?>
<?php
include 'partials/header.php';

// fetch categories from database
$query = "SELECT * FROM adminaddoffice";
$categories = mysqli_query($connection, $query);

// get back form data if form was invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

// delete form data session
unset($_SESSION['add-post-data']);
?>


<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/admin-add-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea style="resize:none" rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
            <div class="form__control">
                <label for="picture">Upload images & videos</label>
                <input type="file" name="picture" id="picture">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>
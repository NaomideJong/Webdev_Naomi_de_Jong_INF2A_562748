<?php

$errors = $_SESSION['errors'];

if (isset($errors)) {
    ?>
    <div class="p-4 mb-4 text-sm text-yellow-700 bg-red-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role = "alert" >
        <p><?= $errors ?></p>
    </div >
    <?php
}

unset($_SESSION['errors']);
?>
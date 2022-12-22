<!-- <pre>
    <?php
        print_r($_POST);
        print_r($_FILES);
    ?>
</pre> -->

<?php
require 'post.php';

$filename = uploadImage($_FILES['image']);
addPost($title, $content, $filename);

header("Location: /");
?>
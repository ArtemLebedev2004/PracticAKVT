<?php
require 'model.php';

if (isset($_POST['sign_up'])) {
    signUp($_POST, $_FILES);
}

if (isset($_POST['sign_in'])) {
    signIn($_POST);
}

if (isset($_POST['add_book'])) {
    addBook($_POST, $_FILES);
}

if (isset($_POST['update_book'])) {
    updateBook($_POST, $_FILES);
}

if (isset($_POST['search'])) {
    search($_POST['search']);
}
?>
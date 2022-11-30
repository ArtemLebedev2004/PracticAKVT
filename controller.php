<?php
require 'model.php';



if (isset($_POST['sign_up'])) {
    $date = [
        "fullName" => $_POST['fio'],
        "login" => $_POST['login'],
        "mail" => $_POST['mail'],
        "password" => $_POST['password'],
        "avatar" => $_FILES['avatar']
    ];
    signUp($date, $_POST['password_confirm']);
}

if (isset($_POST['sign_in'])) {
    signIn();
}

if (isset($_POST['add_book'])) {
    // addBook();
}

if (isset($_POST['update_book'])) {
    $date = [
        "id" => $_POST['id'],
        "nameBook" => $_POST['name_book'],
        "author" => $_POST['author'],
        "description" => $_POST['description'],
        "year_of_release" => $_POST['year_of_release'],
        "genre" => $_POST['genre'],
        "cover" => $_FILES['cover']
    ];
    updateBook($date);
}
?>
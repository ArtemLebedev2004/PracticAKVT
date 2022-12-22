<?php
// Файл, где вызывается модель и передаётся в вид - Контроллер

// Модель
require 'post.php';
$posts = getPost();

// Представление
include "views/index.show.php";
?>
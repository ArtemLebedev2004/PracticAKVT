<!-- 
2. Создать скрипт, который будет обрабытывать форму
    2.1. Сгенерировать новое название для картинки
    2.2. Сохранить картинку в папку uploads  
-->

<?php
//Controller

require 'upload.php';
uploadImage($_FILES['image']);
require 'show.view.php';

?>
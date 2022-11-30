<?php
require 'view.php';

function signUp($date, $password_confirm) {
    $isReg = true;

    signUpView();
    $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
    $sql = "SELECT * FROM `users`";
    $statment = $connect->prepare($sql);
    $statment->execute();
    $users = $statment->fetchAll(PDO::FETCH_ASSOC);
    for ($index = 0; $index < count($users); $index++) {
        if ($date['fullName'] == $users[$index]['full_name']) {
            $isReg = false;
            warningName($isReg);
        } else {
            warningName(true);
        }

        if ($date['login'] == $users[$index]['login']) {
            $isReg = false;
            warningLogin($isReg);
        } else {
            warningLogin(true);
        }

        if ($date['mail'] == $users[$index]['email']) {
            $isReg = false;
            warningMail($isReg);
        } else {
            warningMail(true);
        }

        
        
        if (!$isReg) {
            if ($password_confirm != $date['password']) {
                $isReg = false;
                warningPassword($isReg);
            } else {
                warningPassword(true);
            }
    
            if ($date['avatar']['name'] == '') {
                $isReg = false;
                warningFile($isReg);
            } else {
                warningFile(true);
            }

            isReg($isReg);

            break;
        } else if ($index == count($users) - 1) {
            if ($password_confirm != $date['password']) {
                $isReg = false;
                warningPassword($isReg);
            } else {
                warningPassword(true);
            }
    
            if ($date['avatar']['name'] == '') {
                $isReg = false;
                warningFile($isReg);
            } else {
                warningFile(true);
            }
        }
    }

    if ($isReg) {
        function uploadImage($image) {
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $filename = uniqid()."." . $extension;
            move_uploaded_file($image['tmp_name'], "uploads/" . $filename);
            return $filename;
        }
    
        $filename = uploadimage($_FILES['avatar']);
    
        $date["avatar"] = $filename;
    
        $sql = "INSERT INTO `users` (full_name, login, email, avatar, password) VALUES (:fullName, :login, :mail, :avatar, :password)";
        $statment = $connect->prepare($sql);
        $result = $statment->execute($date);
    }
}


function signIn() {
    $date = [
        "login" => $_POST['login'],
        "password" => $_POST['password'],
    ];
    
    if ($date['login'] == "admin_books_ru" && $date['password'] == "admin_books_ru3548684352423545") {
        ?>
        <script>
            let personalAdmin = document.querySelector('.personal_admin'),
                signsButtons = document.querySelector('.signs_buttons');    
            signsButtons.classList.add('hide');
            personalAdmin.classList.remove('hide');

            // let deleteBookButs = $('.delete_book');
            // let idBook = $('.id_of_book');
            // for (let i = 0; i < deleteBookButs.length; i++) {
            //     deleteBookButs[i].addEventListener('click', (e) => {
            //         console.log(idBook[i].innerHTML.replace(/\s/g, ''))
            //         deleteBook(idBook[i].innerHTML.replace(/\s/g, ''));
            //     })
            // }
    
            // async function deleteBook(id) {
            //     await fetch(`http://api.books.ru/books/${id}`, {
            //         method: 'DELETE'
            //     });
            // }
    
            // $(document).on('scroll', () => {
            //     if (!$('.personal').hasClass('hide')) {
            //         $('.id_of_book').removeClass('hide');
            //         $('.delete_book').removeClass('hide');
            //     }
            // })
    
            // $(document).on('click', () => {
            //     if (!$('.personal').hasClass('hide')) {
            //         $('.id_of_book').removeClass('hide');
            //         $('.delete_book').removeClass('hide');
            //     }
            // })
    
            // $('.personal').on('click', () => {
            //     if (!$('.list_of_actives').hasClass("hide")) {
            //         $('.list_of_actives').addClass('hide');
            //         $('.backCover').addClass('hide');    
            //     } else {
            //         $('.list_of_actives').removeClass('hide');
            //         $('.backCover').removeClass('hide');
            //     }
            // })
    
            // $('.backCover').on('click', () => {
            //         $('.list_of_actives').addClass('hide');
            //         $('.modal_add_book').addClass('hide');
            //         $('.modal_update_book').addClass('hide');
            //         $('.backCover').addClass('hide'); 
            // })
    
            // $('.first_active').on('click', () => {
            //         $('.list_of_actives').addClass('hide');
            //         $('.modal_add_book').removeClass('hide');
            //         $('.backCover').removeClass('hide');
            // })
    
            // $('.second_active').on('click', () => {
            //         $('.list_of_actives').addClass('hide');
            //         $('.modal_update_book').removeClass('hide');
            //         $('.backCover').removeClass('hide');
            // })
    
            
        </script>
        <?php
    }
    
    // function uploadImage($image) {
    //     $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    //     $filename = uniqid()."." . $extension;
    //     move_uploaded_file($image['tmp_name'], "uploads/" . $filename);
    //     return $filename;
    // }
    
    // $filename = uploadimage($_FILES['avatar']);
    
    // $date["avatar"] = $filename;
    
    // $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
    // $sql = "INSERT INTO `users` (full_name, login, email, avatar, password) VALUES (:fullName, :login, :mail, :avatar, :password)";
    // $statment = $connect->prepare($sql);
    // $result = $statment->execute($date);
    
}


function updateBook($date) {
    print_r($_FILES);
    $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');

    $id_book = $_POST['id'];

    $date = [
        "name" => $_POST['name_book'],
        "description" => $_POST['description'],
        "yearOfRelease" => $_POST['year_of_release'],
        "genre" => $_POST['genre'],
        "cover" => $_FILES['cover'],
        'author' => $_POST['author']
    ];


    if ($date['name'] !== "") {
        $name_book = $date['name'];
        $sql = "UPDATE `books` SET `name_book` = '$name_book' WHERE `books`.`id_book` = $id_book;";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();
    }

    if ($date['description'] !== "") {
        $description = $date['description'];
        $sql = "UPDATE `books` SET `description` = '$description' WHERE `books`.`id_book` = $id_book;";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();
    }


    if ($date['yearOfRelease'] !== "") {
        $yearOfRelease = $date['yearOfRelease'];
        $sql = "UPDATE `books` SET `year_of_release` = '$yearOfRelease' WHERE `books`.`id_book` = $id_book;";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();
    }


    if ($date['genre'] !== "") {
        $genre = $date['genre'];
        $sql = "UPDATE `books` SET `genre` = '$genre' WHERE `books`.`id_book` = $id_book;";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();
    }


    if ($date['cover']['name'] !== "") {
        echo "fef";
        $sql = "UPDATE `books` SET `cover` = '' WHERE `id_book` = '$id_book'";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();

        function uploadImage($image) {
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $filename = uniqid()."." . $extension;
            move_uploaded_file($image['tmp_name'], "uploadsCover/" . $filename);
            return $filename;
        }
        
        $filename = uploadimage($_FILES['cover']);
        $cover = $filename;
        $sql = "UPDATE `books` SET `cover` = '$cover' WHERE `id_book` = '$id_book'";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();
    }


    if ($date['author'] !== "") {
        $params = explode('/', $date['author']);
        $sql = "SELECT * FROM authors";
        $authors = $connect->prepare($sql);
        $authors->execute();
        $resultAuthors = $authors->fetchAll(PDO::FETCH_ASSOC);

        $sql = "DELETE FROM authors_and_books WHERE id_book = '$id_book'";
        $statment = $connect->prepare($sql);
        $result = $statment->execute();

        for($i = 0; $i < count($params); $i++) {
            for ($j = 0; $j < count($resultAuthors); $j++) {
                if ($params[$i] === $resultAuthors[$j]['name_author']) {
                    $sql = "SELECT * FROM authors WHERE `name_author` = '$params[$i]'";
                    $authors = $connect->prepare($sql);
                    $authors->execute();
                    $resultAuthors = $authors->fetchAll(PDO::FETCH_ASSOC);
                    $id_author = $resultAuthors[0]['id_author'];

                    $dateId = [
                        'id_author' => $id_author,
                        'id_book' => $id_book
                    ];
                    print_r($dateId['id_author']);
                    $sql = "INSERT INTO `authors_and_books` (id_author, id_book) VALUES (:id_author, :id_book)";
                    $statment = $connect->prepare($sql);
                    $result = $statment->execute($dateId);
                    print_r($statment);
                    
                    break;
                } else if ($j == count($resultAuthors) - 1){
                    $dateAuthor = [
                        'author' => $params[$i]
                    ];

                    

                    $sql = "INSERT INTO `authors` (name_author) VALUES (:author)";
                    $statment = $connect->prepare($sql);
                    $result = $statment->execute($dateAuthor);
                    $authorId = $connect->lastInsertId();

                    $dateId = [
                        'id_book' => $id_book,
                        'id_author' => $authorId
                    ];

                    $sql = "INSERT INTO `authors_and_books` (id_book, id_author) VALUES (:id_book, :id_author)";
                    $statment = $connect->prepare($sql);
                    $result = $statment->execute($dateId);
                }
            }
        }
    }

    // $author = $date['author'];
    // $sql = "UPDATE `authors` SET `name_author` = '$author' WHERE `books`.`id_book` = $id_book;";
    // $result = $statment->execute();
    // $authorId = $connect->lastInsertId();
}
?>
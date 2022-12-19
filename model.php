<?php
require 'view.php';

function signUp($data, $dataFiles) {
    $date = [
        "fullName" => $data['fio'],
        "login" => $data['login'],
        "mail" => $data['mail'],
        "password" => $data['password'],
        "avatar" => $dataFiles['avatar']
    ];

    $isReg = true;
    $countFalse = 0;
    signUpView();
    $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
    $sql = "SELECT * FROM `users`";
    $statment = $connect->prepare($sql);
    $statment->execute();
    $users = $statment->fetchAll(PDO::FETCH_ASSOC);
    for ($index = 0; $index < count($users); $index++) {
        if ($date['fullName'] == $users[$index]['full_name']) {
            $isReg = false;
            $countFalse++;
            warningName($isReg);
        } else if ($isReg){
            warningName($isReg);
        }

        if ($date['login'] == $users[$index]['login']) {
            $isReg = false;
            $countFalse++;
            warningLogin($isReg);
        } else if ($isReg){
            warningLogin($isReg);
        }

        if ($date['mail'] == $users[$index]['email']) {
            $isReg = false;
            $countFalse++;
            warningMail($isReg);
        } else if ($isReg){
            warningMail($isReg);
        }

        
        
        if ($countFalse == 3 || $index == count($users) - 1) {
            if ($_POST['password_confirm'] != $date['password']) {
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

            break;
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

        signUpComplete();
        signComplete($date['fullName'], $date['login'], $date['mail'], $date['avatar']);
    }
}


function signIn($data) {
    signInView();

    $date = [
        "login" => $data['login'],
        "password" => $data['password'],
    ];
    
    if ($date['login'] == "admin_books_ru" && $date['password'] == "admin_books_ru3548684352423545") {
        signInAdmin();
    } else {
        $isReg = true;

        $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
        $sql = "SELECT * FROM `users`";
        $statment = $connect->prepare($sql);
        $statment->execute();
        $users = $statment->fetchAll(PDO::FETCH_ASSOC);

        for ($index = 0; $index < count($users); $index++) {
            if ($date['login'] == $users[$index]['login']) {
                warningLoginSignIn($isReg);           
                    
                if ($date['password'] == $users[$index]['password']) {
                    warningPasswordSignIn($isReg);
                } else {
                    $isReg = false;
                    warningPasswordSignIn($isReg);                
                }

                break;
            } else {
                if ($index == count($users) - 1) {
                    $isReg = false;
                    warningLoginSignIn($isReg);
                }
            }

            
        }


        if ($isReg) {
            $userLogin = $date['login'];
            $sql = "SELECT * FROM `users` WHERE `login` = '$userLogin'";
            $statment = $connect->prepare($sql);
            $statment->execute();
            $users = $statment->fetchAll(PDO::FETCH_ASSOC);

            signInUser();
            signComplete($users[0]['full_name'], $users[0]['login'], $users[0]['email'], $users[0]['avatar']);

        }
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


function updateBook($data, $dataFiles) {
    $date = [
        "id" => $data['id'],
        "nameBook" => $data['name_book'],
        "author" => $data['author'],
        "description" => $data['description'],
        "yearOfRelease" => $_POST['year_of_release'],
        "genre" => $data['genre'],
        "cover" => $dataFiles['cover']
    ];

    $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');

    $id_book = $_POST['id'];

    if ($date['nameBook'] !== "") {
        $name_book = $date['nameBook'];
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
    getBooksAndDeleteInViewPHP();
    
    // $author = $date['author'];
    // $sql = "UPDATE `authors` SET `name_author` = '$author' WHERE `books`.`id_book` = $id_book;";
    // $result = $statment->execute();
    // $authorId = $connect->lastInsertId();
}


function addBook($data, $dataFiles) {
    $date = [
        "name" => $data['name'],
        "description" => $data['description'],
        "yearOfRelease" => $data['year_of_release'],
        "genre" => $data['genre'],
        "cover" => $dataFiles['cover']
    ];
    
    $dateAuthor = [
        'author' => $_POST['author']
    ];
    
    function uploadImage($image) {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $filename = uniqid()."." . $extension;
        move_uploaded_file($image['tmp_name'], "uploadsCover/" . $filename);
        return $filename;
    }
    
    $filename = uploadimage($_FILES['cover']);
    
    $date["cover"] = $filename;
    
    $connect = new PDO('mysql:host=localhost; dbname=data_of_books', 'root','');
    $sql = "INSERT INTO `books` (name_book, description, year_of_release, genre, cover) VALUES (:name, :description, :yearOfRelease, :genre, :cover)";
    $statment = $connect->prepare($sql);
    $result = $statment->execute($date);
    $bookId = $connect->lastInsertId();
    echo $bookId;
    
    $sql = "INSERT INTO `authors` (name_author) VALUES (:author)";
    $statment = $connect->prepare($sql);
    $result = $statment->execute($dateAuthor);
    $authorId = $connect->lastInsertId();
    echo $authorId;
    
    $dateId = [
        'id_book' => $bookId,
        'id_author' => $authorId
    ];
    
    $sql = "INSERT INTO `authors_and_books` (id_book, id_author) VALUES (:id_book, :id_author)";
    $statment = $connect->prepare($sql);
    $result = $statment->execute($dateId);

    getBooksAndDeleteInViewPHP();
}

function search($data) {
    if (!empty($data)) {
        $search = $data;
        $search = mb_eregi_replace("[^a-zа-яё0-9 ]", '', $search);

        $connect = new PDO("mysql:host=localhost; dbname=data_of_books", "root", "");
        
        function resultAuthors($connect, $search) {
            ?>
            <div class="result_search_authors">
                <div class="header_in_search header_in_search_authors">
                    Авторы
                </div>
            <?php
            $authors = $connect->prepare("SELECT `name_author` FROM `authors`");
            $authors->execute();
            $resultAuthors = $authors->fetchAll(PDO::FETCH_ASSOC);
            $countTrue = 0;

            for ($i = 0; $i < count($resultAuthors); $i++) {
                if (strpos(mb_strtolower(str_replace(' ', '', $resultAuthors[$i]['name_author'])), mb_strtolower($search)) > -1) {
                    searchInView('authors', $resultAuthors[$i]['name_author']);
                    $countTrue = 1;
                }

                if ($i === count($resultAuthors) - 1 && $countTrue < 1) {
                    searchInView('not found');
                }
            }
            ?>
            </div>
            <?php
        }
        

        function resultBooks($connect, $search) {
            ?>
            <div class="result_search_books">
            <div class="header_in_search header_in_search_books">
                Книги
            </div>
            <?php
            $books = $connect->prepare("SELECT `name_book` FROM `books`");
            $booksId = $connect->prepare("SELECT `id_book` FROM `books`");
            $books->execute();
            $booksId->execute();
            $resultBooks = $books->fetchAll(PDO::FETCH_ASSOC);
            $resultBooksId = $booksId->fetchAll(PDO::FETCH_ASSOC);
            $countTrue = 0;

            for ($i = 0; $i < count($resultBooks); $i++) {
                if (strpos(mb_strtolower(str_replace(' ', '', $resultBooks[$i]['name_book'])), mb_strtolower($search)) > -1) {
                    searchInView('books', $resultBooks[$i]['name_book'], $resultBooksId[$i]['id_book']);
                    $countTrue = 1;

                }

                if ($i === count($resultBooks) - 1 && $countTrue < 1) {
                    searchInView('not found');
                }
            }
            
            ?>
            </div>
            <?php
        }

        resultAuthors($connect, $search);
        resultBooks($connect, $search);

        searchInView();
    }
}
?>
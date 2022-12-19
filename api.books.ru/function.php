<?php
function getBooks($connect, $param) {
    $params = explode(" ", $param);

    if ((int)$param > 0) {
        
        $books = mysqli_query($connect, "SELECT * FROM books INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author WHERE books.id_book = '$param'");
    } else if ((int)$param == 0 && $param != null && !isset($params[1])) {

        $books = mysqli_query($connect, "SELECT * FROM books INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author  WHERE `genre` = '$param' ORDER BY books.id_book");
    } else if (isset($params[1])) {
        $books = mysqli_query($connect, "SELECT * FROM books INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author  WHERE authors.name_author = '$param' ORDER BY books.name_book");
        $arr = [];
        while ($book = mysqli_fetch_assoc($books)) {
            $idBook = $book['id_book'];

            $books2 = mysqli_query($connect, "SELECT * FROM books INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author  WHERE books.id_book = '$idBook' ORDER BY books.name_book");
            while ($book = mysqli_fetch_assoc($books2)) {
                array_push($arr, $book);
            }
        }


        echo json_encode($arr);
    } else {
        $books = mysqli_query($connect, "SELECT * FROM books INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author ORDER BY books.id_book");
    }

    if (mysqli_num_rows($books) == 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Books not found"
        ];
        echo json_encode($res);
    } else if (!isset($params[1])) {
        $bookList = [];

        while ($book = mysqli_fetch_assoc($books)) {
            $bookList[] = $book;
        }

        echo json_encode($bookList);
    }
}

// function getPost() {
//     if ((int)$param > 0) {
//         $book = mysqli_query($connect, "SELECT * FROM `books` INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author WHERE books.id_book = '$param'");
//     } else if ((int)$param == 0) {
//         $books = mysqli_query($connect, "SELECT * FROM books INNER JOIN authors_and_books ON books.id_book = authors_and_books.id_book INNER JOIN authors ON authors.id_author = authors_and_books.id_author  WHERE `genre` = '$param'");
//     }
//     if (mysqli_num_rows($book) == 0) {
//         http_response_code(404);
//         $res = [
//             "status" => false,
//             "message" => "Post not found"
//         ];
//         echo json_encode($res);
//     } else {
//         $book = mysqli_fetch_assoc($book);
//         echo json_encode($book);
//     }
// }

// function getPostsSortGenre($connect, $genre) {
//     $bookList = [];

//     while ($book = mysqli_fetch_assoc($books)) {
//         $bookList[] = $book;
//     }

//     echo json_encode($bookList);
// }

// function addPost($connect, $data, $dataFiles) {
//     $name = $data['name'];
//     $description = $data['description'];
//     $yearOfRelease = $data['year_of_release'];
//     $genre = $data['genre'];
//     $cover = $dataFiles['cover']['tmp_name'];

//     mysqli_query($connect, "INSERT INTO `books` (`name`, `description`, `year_of_release`, `genre`, `cover`) VALUES ('$name', '$description', '$yearOfRelease', '$genre', '$cover')");
//     http_response_code(201);
//     $res = [
//         "status" => true,
//         "message" => "Post was added",
//         "id" => mysqli_insert_id($connect)
//     ];

//     echo json_encode($res);
// }

// function updatePost($connect, $data, $id) {
//     $title = $data['title'];
//     $body = $data['body'];

//     $post = mysqli_query($connect, "SELECT * FROM `posts` WHERE `id` = '$id'");
//     if (mysqli_num_rows($post) == 0) {
//         http_response_code(404);
//         $res = [
//             "status" => false,
//             "message" => "Post, which need update, not found"
//         ];
//         echo json_encode($res);
//     } else {
//         mysqli_query($connect, "UPDATE `posts` SET `title` = '$title', `body` = '$body' WHERE `posts`.`id` = '$id'");
//         http_response_code(200);
//         $res = [
//             "status" => true,
//             "message" => "Post was updated"
//         ];

//         echo json_encode($res);
//         getPost($connect, $id);
//     }
// }

function deleteBook($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM `books` WHERE `id_book` = '$id'");
    if (mysqli_num_rows($post) == 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Book, which need delete, not found"
        ];
        echo json_encode($res);
    } else {
        mysqli_query($connect, "DELETE FROM books WHERE `books`.`id_book` = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => "Post was deleted"
        ];

        echo json_encode($res);
    }
}
?>
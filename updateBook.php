<?php


    
    

?>
<script>
    async function getBooks() {
        let res = await fetch("http://api.books.ru/books");
        let books = await res.json();
    
        document.querySelector('.books').innerHTML = '';
        books.forEach((book) => {
            document.querySelector('.books').innerHTML += `
            <div class="books_item">
                <div class="books_item_img">
                    <img src="uploadsCover/${book['cover']}" alt="">
                </div>

                <div class="book_info">
                    <div class="id_of_book hide">
                        ${book['id_book']}
                    </div>

                    <div class="name_of_book">
                        ${book['genre']}
                    </div>

                    <div class="name_of_book">
                        ${book['name_book']}
                    </div>

                    <div class="name_of_author">
                        ${book['name_author']}
                    </div>

                <div class="delete_book hide">
                    Удалить
                </div>
                </div>
            </div>
            `
        })
    }

    getBooks();
</script>
<?php
// function uploadImage($image) {
//     $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
//     $filename = uniqid()."." . $extension;
//     move_uploaded_file($image['tmp_name'], "uploadsCover/" . $filename);
//     return $filename;
// }

// $filename = uploadimage($_FILES['cover']);

// $date["cover"] = $filename;

// $sql = "INSERT INTO `books` (name_book, description, year_of_release, genre, cover) VALUES (:name, :description, :yearOfRelease, :genre, :cover)";
// $statment = $connect->prepare($sql);
// $result = $statment->execute($date);
// $bookId = $connect->lastInsertId();
// echo $bookId;

// $sql = "INSERT INTO `authors` (name_author) VALUES (:author)";
// $statment = $connect->prepare($sql);
// $result = $statment->execute($dateAuthor);
// $authorId = $connect->lastInsertId();
// echo $authorId;

// $dateId = [
//     'id_book' => $bookId,
//     'id_author' => $authorId
// ];

// $sql = "INSERT INTO `authors_and_books` (id_book, id_author) VALUES (:id_book, :id_author)";
// $statment = $connect->prepare($sql);
// $result = $statment->execute($dateId);
// 
?>

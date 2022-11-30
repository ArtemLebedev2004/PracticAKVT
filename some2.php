<?php
error_reporting(E_ERROR);
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
        $search = mb_eregi_replace("[^a-zа-яё0-9 ]", '', $search);

        $connect = new PDO("mysql:host=localhost; dbname=data_of_books", "root", "");
        
        function resultAuthors($connect, $resultAuthors, $search) {
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
                    ?>
                        <table class="resultAuthors">
                            <tr>
                                <td class="search_result-name">
                                    <?php echo $resultAuthors[$i]['name_author']; ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                    $countTrue = 1;
                }

                if ($i === count($resultAuthors) - 1 && $countTrue < 1) {
                    ?>
                    <div class="not_found_in_search not_found_in_search_authors">
                        <span>Ничего не найдено</span>
                    </div>
                    <?php
                }
            }
            
            ?>
            <script>

                for (let i = 0; i < $('.resultAuthors').length; i++) {
                    
                    let resAuthors = $('.resultAuthors');
                    let resAuthorsName = $('.search_result-name');
                    resAuthors[i].addEventListener('click', (e) => {
                        ds();
                        
                        let books = document.querySelector('.books');
                        books.scrollIntoView();
                        // const offset = 45;
                        // const bodyRect = document.body.getBoundingClientRect().top;
                        // const elementRect = booksItem.getBoundingClientRect().top;
                        // const elementPosition = elementRect - bodyRect;
                        // const offsetPosition = elementPosition - offset;
                        // window.scrollTo({
                        //     top: offsetPosition,
                        //     behavior: "smooth"
                        // });
                        console.log(resAuthorsName[i].innerHTML.trim());
                        getBooksByAuthorName(resAuthorsName[i].innerHTML.trim());
                $('.result_search').html("");

                    })
                }

                async function getBooksByAuthorName(param) {
                    let res;
                    
                    if (param == null) {
                        res = await fetch(`http://api.books.ru/books/`);
                    } else {
                        res = await fetch(`http://api.books.ru/books/${param}`);
                    }
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
                            <div class="buts">
                                <div>
                                    Читать
                                </div>
                                <div class="ab_book">
                                    О книге
                                </div>
                            </div>
                        </div>
                        `
                    })
                }
                // async function getPosts(name_author) {
                //     let res = await fetch("http://api.books.ru/books");
                //     let books = await res.json();
                //     console.log(name_author);
                //     document.querySelector('.books').innerHTML = '';
                //     books.forEach((book) => {
                //         if (book['name_author'].replace(/\s/g, "") == name_author) {
                //             document.querySelector('.books').innerHTML += `
                //             <div class="books_item">
                //                 <div class="books_item_img">
                //                     <img src="uploadsCover/${book['cover']}" alt="">
                //                 </div>

                //                 <div class="book_info">
                //                     <div class="id_of_book hide">
                //                         ${book['id_book']}
                //                     </div>

                //                     <div class="name_of_book">
                //                         ${book['genre']}
                //                     </div>

                //                     <div class="name_of_book">
                //                         ${book['name_book']}
                //                     </div>

                //                     <div class="name_of_author">
                //                         ${book['name_author']}
                //                     </div>

                //                     <div class="delete_book hide">
                //                         Удалить
                //                     </div>
                                    
                //                 </div>
                //                 <div class="buts">
                //                         <div>
                //                             Читать
                //                         </div>
                //                         <div class="ab_book">
                //                             О книге
                //                         </div>
                //                     </div>
                //             </div>
                //             `
                //         }
                //     })
                // }

                function ds() {
                    let search = document.querySelector('.search');
                    // let signs = document.querySelector('.signs');
                    // let mainLogo = document.querySelector('.main_logo');
                    let cover = document.querySelector('.backCover');
                    let resultSearch = document.querySelector('.result_search');
                    let body = document.querySelector('body');
                    let magnificentImg = document.querySelector('.magnificent_img');
                    let closeSearch = document.querySelector('.close_search_img');
                   
                    search.removeAttribute('style');
                    body.removeAttribute('style');
                    cover.classList.add('hide');
                    resultSearch.classList.add('hide');
                    magnificentImg.classList.remove('hide');
                    closeSearch.classList.add('hide');
                }
            </script> 
            </div>
            <?php
        }
        

        function resultBooks($connect, $resultBooks, $search) {
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
                    ?>
                        <table class="open open_book_card resultBooks">
                            <tr>
                                <td class="search_result-name">
                                    "<?php echo $resultBooks[$i]['name_book'];?>"
                                </td>
                                <td class="search_result-id hide">
                                    <?php echo $resultBooksId[$i]['id_book']; ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                    $countTrue = 1;

                }

                if ($i === count($resultBooks) - 1 && $countTrue < 1) {
                    ?>
                    <div class="not_found_in_search not_found_in_search_books">
                        <span>Ничего не найдено</span>
                    </div>
                    <?php
                }
            }
            
            ?>
            <script>
                for (let i = 0; i < $('.resultBooks').length; i++) {
                    let resBooks = $('.resultBooks');
                    let resBookId = $('.search_result-id');
                    resBooks[i].addEventListener('click', (e) => {
                        let id = resBookId[i].innerHTML.replace(/\s/g, "");
                        getBooks(id);
                        $('.book_card').removeClass('hide');
                        $('.book_card').css('zIndex', 3);
                        $('.backCover').css('zIndex', 2);
                        
                        
                    })
                }

                async function getBooks(param) {
        let res;
        
        if (param == null) {
            res = await fetch(`http://api.books.ru/books/`);
        } else {
            res = await fetch(`http://api.books.ru/books/${param}`);
        }
        let books = await res.json();
        document.querySelector('.books').innerHTML = '';

        books.forEach((book) => {
            document.querySelector('.book_card_info').innerHTML = `
                <div class="book_card_img">
                    <img src="uploadsCover/${book['cover']}" alt="">
                </div>

                <div>
                    <h1 class="book_card_info_name">${book['name_book']}</h1>
                    <div class="book_card_info_author">${book['name_author']}</div>
                    <div class="book_card_info_genre">${book['genre']}</div>
                    <div class="book_card_info_year">${book['year_of_release']}</div>
                    <div class="book_card_info_description">${book['description']}</div>
                </div>
            `
        })
    }
                
                // async function getPostOnId(id) {
                //     let res = await fetch(`http://api.books.ru/books/${id}`);
                //     let books = await res.json();
                //     document.querySelector('.book_card').innerHTML = '';
                //         document.querySelector('.book_card').innerHTML = `
                //         <div class="book_card_img">
                //             <img src="uploadsCover/${books['cover']}">
                //         </div>

                //         <div class="book_card_info">
                //             <div class="id_of_book hide">
                //                 ${books['id_book']}
                //             </div>
                //             <h1 class="book_card_info_name">${books['name_book']}</h1>
                //             <div class="book_card_info_author">${books['name_author']}</div>
                //             <div class="book_card_info_genre">${books['genre']}</div>
                //             <div class="book_card_info_year">${books['year_of_release']}</div>
                //             <div class="book_card_info_description">${books['description']}</div>
                            
                                    
                //         </div>
                //         `;

                // }

                function ds() {
                    let search = document.querySelector('.search');
                    // let signs = document.querySelector('.signs');
                    // let mainLogo = document.querySelector('.main_logo');
                    let cover = document.querySelector('.backCover');
                    let resultSearch = document.querySelector('.result_search');
                    let body = document.querySelector('body');
                    let magnificentImg = document.querySelector('.magnificent_img');
                    let closeSearch = document.querySelector('.close_search_img');
                   
                    search.removeAttribute('style');
                    body.removeAttribute('style');
                    cover.classList.add('hide');
                    resultSearch.classList.add('hide');
                    magnificentImg.classList.remove('hide');
                    closeSearch.classList.add('hide');
                }
            </script>

            </div>
            <?php
        }

        resultAuthors($connect, $resultAuthors, $search);
        resultBooks($connect, $resultBooks, $search);
    }
?>
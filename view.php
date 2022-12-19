<?php
function signUpView() {
    function warningName($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_name').hasClass('hide')) {
                        $('.warning_name').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_name').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningLogin($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_login').hasClass('hide')) {
                        $('.warning_login').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_login').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningMail($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_mail').hasClass('hide')) {
                        $('.warning_mail').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_mail').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningPassword($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_password').hasClass('hide')) {
                        $('.warning_password').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_password').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningFile($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_file').hasClass('hide')) {
                        $('.warning_file').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_file').removeClass('hide');
                </script>
            <?php
        }
    }

    function signUpComplete() {
        ?>
            <script>
                $('.signs_buttons').addClass('hide');
                $('.personal_user').removeClass('hide');
            </script>
        <?php
    }
}


function signInView() {
    function warningLoginSignIn($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_login').hasClass('hide')) {
                        $('.warning_login').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_login').removeClass('hide');
                </script>
            <?php
        }
    }

    function warningPasswordSignIn($isReg) {
        if ($isReg) {
            ?>
                <script>
                    if (!$('.warning_password').hasClass('hide')) {
                        $('.warning_password').addClass('hide');
                    }
                </script>
            <?php
        } else {
            ?>
                <script>
                    $('.warning_password').removeClass('hide');
                </script>
            <?php
        }
    }

    function signInUser() {
        ?>
            <script>
                $('.signs_buttons').addClass('hide');
                $('.personal_user').removeClass('hide');
            </script>
        <?php
    }

    function signInAdmin() {
        ?>
        <script>
            $('.signs_buttons').addClass('hide');
            $('.personal_admin').removeClass('hide');
        </script>
        <?php
        getBooksAndDeleteInViewPHP();
    }
}


function signComplete($name, $login, $mail, $avatar) {
    ?>
        <script>
            $('.user_card_info').html(`\
                <div class="user_card_img"><img src="uploads/<?php echo $avatar ?>" alt="" class="close"></div>\
                <div>\
                    <h1 class="user_card_info_name"><?php echo $name ?></h1>\
                    <div class="user_card_info_login">Ваш логин: <?php echo $login ?></div>\
                    <div class="user_card_info_email">Ваша почта: <?php echo $mail ?></div>\
                </div>\
            `);
        </script>
    <?php
}


function searchInView($param = '', $name = '', $id = '') {
    if ($param == "authors") {
        ?>
            <table class="resultAuthors">
                <tr>
                    <td class="search_result-name">
                        <?php echo $name; ?>
                    </td>
                </tr>
            </table>
        <?php
    } else if ($param == "books") {
        ?>
            <table class="open open_book_card resultBooks">
                <tr>
                    <td class="search_result-name">
                        "<?php echo $name;?>"
                    </td>
                    <td class="search_result-id hide">
                        <?php echo $id; ?>
                    </td>
                </tr>
            </table>
        <?php
    } else if ($param == "not found") {
        ?>
            <div class="not_found_in_search">
                <span>Ничего не найдено</span>
            </div>
        <?php
    } else if ($param == '') {
        ?>
        <script>
            for (let i = 0; i < $('.resultAuthors').length; i++) {
                
                let resAuthors = $('.resultAuthors');
                let resAuthorsName = $('.search_result-name');
                resAuthors[i].addEventListener('click', (e) => {
                    ds();
                    
                    let books = document.querySelector('.books');
                    books.scrollIntoView();

                    console.log(resAuthorsName[i].innerHTML.trim());
                    getBooksByAuthorName(resAuthorsName[i].innerHTML.trim());
                })
            }


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
                
                res = await fetch(`http://api.books.ru/books/${param}`);
                
                let books = await res.json();

                for (let index = 0; index < books.length; index++) {
            document.querySelector('.book_card_info').innerHTML = `
                <div class="book_card_img">
                    <img src="uploadsCover/${books[index]['cover']}" alt="">
                </div>

                <div>
                    <h1 class="book_card_info_name">${books[index]['name_book']}</h1>
                    <div class="book_card_info_author">${books[index]['name_author']}</div>
                    <div class="book_card_info_genre">${books[index]['genre']}</div>
                    <div class="book_card_info_year">${books[index]['year_of_release']}</div>
                    <div class="book_card_info_description">${books[index]['description']}</div>
                </div>
            `

            if (index != books.length - 1 && books[index + 1]['id_book'] == books[index]['id_book']) {
                let j = 1;
                while (books[index + j]['id_book'] == books[index]['id_book']) {
                    document.querySelector('.book_card_info_author').innerHTML += `,&nbsp
                        ${books[index + j]['name_author']}
                    `;
                    j++;
                }

                index += j - 1;
            }
        }
            }


            async function getBooksByAuthorName(param) {
                let res;
                    
                
                res = await fetch(`http://api.books.ru/books/${param}`);
                
                let books = await res.json();
                document.querySelector('.books').innerHTML = '';
                console.log(books);
                for (let index = 0; index < books.length; index++) {
                    document.querySelector('.books').innerHTML += `
                    <div class="books_item">
                        <div class="books_item_img">
                            <img src="uploadsCover/${books[index]['cover']}" alt="">
                        </div>

                        <div class="book_info">
                            <div class="id_of_book hide">
                                ${books[index]['id_book']}
                            </div>

                            <div class="genre_of_book">
                                ${books[index]['genre'].toLowerCase()}
                            </div>

                            <div class="name_of_book">
                                ${books[index]['name_book']}
                            </div>

                            <div class="name_of_author">
                                ${books[index]['name_author']}
                            </div>
                        </div>
                        <div class="buts">
                            <div class="delete_book hide">
                                Удалить
                            </div>

                            <div>
                                Читать
                            </div>

                            <div class="ab_book">
                                О книге
                            </div>
                        </div>
                    </div>
                    `

                    if (!document.querySelector('.personal_admin').classList.contains('hide')) {
                        document.querySelectorAll('.id_of_book')[index].classList.remove('hide');

                        document.querySelectorAll('.delete_book')[index].classList.remove('hide');
                    }

                    if (index != books.length - 1 && books[index + 1]['id_book'] == books[index]['id_book']) {
                        let j = 1;
                        while (books[index + j]['id_book'] == books[index]['id_book']) {
                            document.querySelectorAll('.name_of_author')[index].innerHTML += `
                            <div>
                                ${books[index + j]['name_author']}
                            </div>
                            `;
                            j++;
                        }

                        index += j - 1;
                    }
                }

                if (!document.querySelector('.personal_admin').classList.contains('hide')) {
                    deleteBooks();
                }
            }
            

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

            function deleteBooks() {
                for (let i = 0; i < $('.delete_book').length; i++) {
                    $('.delete_book')[i].addEventListener('click', (e) => {
                        console.log($('.id_of_book')[i].innerHTML.replace(/\s/g, ''))
                        deleteBook($('.id_of_book')[i].innerHTML.replace(/\s/g, ''));
                    })
                }
            }

            async function deleteBook(id) {
                await fetch(`http://api.books.ru/books/${id}`, {
                    method: 'DELETE'                    
                })
                .then(async response => {
                    getBooks();
                })
            }
        </script> 
        <?php
    }
}


function getBooksAndDeleteInViewPHP() {
    ?>
        <script>
            console.log('esfs');
            async function getBooks() {
                let res,
                    index = 0;
                
                res = await fetch(`http://api.books.ru/books/`);
                
                let books = await res.json();
            
                $('.books').html('');
                for (let index = 0; index < books.length; index++) {
            console.log('esfs2324');

                    document.querySelector('.books').innerHTML += `
                    <div class="books_item">
                        <div class="books_item_img">
                            <img src="uploadsCover/${books[index]['cover']}" alt="">
                        </div>

                        <div class="book_info">
                            <div class="id_of_book">
                                ${books[index]['id_book']}
                            </div>

                            <div class="genre_of_book">
                                ${books[index]['genre'].toLowerCase()}
                            </div>

                            <div class="name_of_book">
                                ${books[index]['name_book']}
                            </div>

                            <div class="name_of_author">
                                ${books[index]['name_author']}
                            </div>
                        </div>
                        <div class="buts">
                            <div class="delete_book">
                                Удалить
                            </div>

                            <div>
                                Читать
                            </div>

                            <div class="ab_book">
                                О книге
                            </div>
                        </div>
                    </div>
                    `

                    if (index != books.length - 1 && books[index + 1]['id_book'] == books[index]['id_book']) {
                        let j = 1;
                        while (j != books.length - index && books[index + j]['id_book'] == books[index]['id_book']) {
                            document.querySelectorAll('.name_of_author')[index].innerHTML += `
                            <div>
                                ${books[index + j]['name_author']}
                            </div>
                            `;
                            j++;
                        }

                        index += j - 1;
                    }
                }

                deleteBooks();
            }

            getBooks();


            function deleteBooks() {
                    for (let i = 0; i < $('.delete_book').length; i++) {
                        $('.delete_book')[i].addEventListener('click', (e) => {
                            console.log($('.id_of_book')[i].innerHTML.replace(/\s/g, ''))
                            deleteBook($('.id_of_book')[i].innerHTML.replace(/\s/g, ''));
                        })
                    }
            }

            async function deleteBook(id) {
                await fetch(`http://api.books.ru/books/${id}`, {
                    method: 'DELETE'                    
                })
                .then(async response => {
                    getBooks();
                })
            }
        </script>
    <?php
}
?>
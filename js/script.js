document.addEventListener("DOMContentLoaded", function(event) { 
    let body = document.querySelector('body');
    let cover = document.querySelector('.backCover');
    
    let closeModalAddBook = document.querySelector('.close_modal_add_book');
    let modalAddBook = document.querySelector('.modal_add_book');
    let genresInGalleryMmenu = document.querySelector('.genres_in_gallery_menu');
    let genres = document.querySelectorAll('.list_of_genres div');
    let updateBook = document.querySelector('.update_book');
    let modalUpdateBook = document.querySelector('.modal_update_book');
    let modalUpdateBookId = document.querySelector('.modal_update_book .id');
    let bookCard = document.querySelector('.book_card');
    let buts = document.querySelectorAll('.buts');
    let butsBook = document.querySelectorAll('.buts .ab_book');
    let idOfBook = document.querySelectorAll('.id_of_book');

    let isPaused = false;

    function slider() {
        let rightArrow = document.querySelector('.next_slide'),
            leftArrow = document.querySelector('.back_slide'),
            slides = document.querySelectorAll('.slides div'),
            pointsUnderSlider = document.querySelectorAll('.points div');

        let timeSlider = setInterval(function() {
            if (!isPaused) {
                slideNext();        
            }
        }, 4000);

        function slideNext() {
            for (let index = 0; index < slides.length; index++) {
                if (!slides[index].classList.contains('hide') && index == slides.length - 1) {
                    slides[index].classList.add('hide');
                    pointsUnderSlider[index].innerHTML = `<img src="icons/white_circle.png">`
    
                    pointsUnderSlider[0].innerHTML = `<img src="icons/grey_circle.png">`
                    slides[0].classList.remove('hide');
                    break;
                } else if (!slides[index].classList.contains('hide')) {
                    slides[index].classList.add('hide');
                    pointsUnderSlider[index].innerHTML = `<img src="icons/white_circle.png">`
            
                    pointsUnderSlider[index + 1].innerHTML = `<img src="icons/grey_circle.png">`
                    slides[index + 1].classList.remove('hide');
                    break;
                }            
            }
        }
        
        function slideBack() {
            for (let index = 0; index < slides.length; index++) {
                if (!slides[index].classList.contains('hide') && index == 0) {
                    slides[index].classList.add('hide');
                    pointsUnderSlider[index].innerHTML = `<img src="icons/white_circle.png">`
        
                    pointsUnderSlider[slides.length - 1].innerHTML = `<img src="icons/grey_circle.png">`
                    slides[slides.length - 1].classList.remove('hide');
                    break;
                } else if (!slides[index].classList.contains('hide')) {
                    slides[index].classList.add('hide');
                    pointsUnderSlider[index].innerHTML = `<img src="icons/white_circle.png">`
        
                    pointsUnderSlider[index - 1].innerHTML = `<img src="icons/grey_circle.png">`
                    slides[index - 1].classList.remove('hide');
                    break;
                }            
            }
        }
        
        rightArrow.addEventListener('click', (event) => {
            slideNext();
            if (!isPaused) {
                isPaused = true;
                setTimeout(function() {
                    isPaused = false;   
                }, 8000);
            }
        })
        
        leftArrow.addEventListener('click', (event) => {
            slideBack();
            if (!isPaused) {
                isPaused = true;
                setTimeout(function() {
                    isPaused = false;   
                }, 8000);
            }
        })
        
        for(let index = 0; index < pointsUnderSlider.length; index++) {
            pointsUnderSlider[index].addEventListener('click', (event) => {
                if (!isPaused) {
                    isPaused = true;
                    setTimeout(function() {
                        isPaused = false;   
                    }, 8000);
                }
    
                for(let index = 0; index < pointsUnderSlider.length; index++) {
                    pointsUnderSlider[index].innerHTML = `<img src="icons/white_circle.png">`;
                    slides[index].classList.add('hide');
                }
                
                pointsUnderSlider[index].innerHTML = `<img src="icons/grey_circle.png">`;
    
                slides[index].classList.remove('hide');
            })
        }
    }
    
    slider();


    function clickMenuBooks() {
        let booksMenu = document.querySelector('.books_menu'),
            listOfGenres = document.querySelector('.list_of_genres'),
            arrListOfGenres = document.querySelectorAll('.list_of_genres div');

        booksMenu.addEventListener('click', (e) => {
            for (let index = 0; index < arrListOfGenres.length; index++) {
                arrListOfGenres[index].addEventListener('click', (e) => {
                    let genre = arrListOfGenres[index].innerHTML.replace(/\s/g, '');
                    getBooks(genre);
                    listOfGenres.classList.add('hide');
                    cover.classList.add('hide');
                    body.removeAttribute('style');
                })
            }

            if (e.target.classList.contains('all_in_gallery_menu')) {
                console.log("fe");
                getBooks();
            }
        });
    }

    clickMenuBooks();


    // Функция открытия и закрытия модальных окон
    function closeAndOpenModals() {
        let opens = document.querySelectorAll('.open'),
            opensModalMini = document.querySelectorAll('.open_modal_mini'),
            modalAddBook = document.querySelector('.modal_add_book'),
            personalAdmin = document.querySelector('.personal_admin'),
            modalUpdateBook = document.querySelector('.modal_update_book'),
            modalDeleteBook = document.querySelector('.modal_delete_book'),
            modalMini = document.querySelectorAll('.modal_mini'),
            modal = document.querySelectorAll('.modal'),
            bookCard = document.querySelector('.book_card'),
            resultSearch = document.querySelector('.result_search'),
            closeModal = document.querySelectorAll('.close_modal'),
            listOfActives = document.querySelector('.list_of_actives');

        // Открывает модальные окна
        for(let index = 0; index < opens.length; index++) {
            opens[index].addEventListener('click', (e) => {
                let classOfElem = "";

                for (let index2 = 0; index2 < opens[index].classList.length; index2++) {
                    if (opens[index].classList[index2].indexOf("open_") == 0) {
                        classOfElem = opens[index].classList[index2];

                        break;
                    }
                }

                for (let index2 = 0; index2 < modal.length; index2++) {
                    if (modal[index2].classList.contains(classOfElem)) {
                        modal[index2].classList.remove('hide');
                        cover.classList.remove('hide');
                        body.style.overflow = "hidden";
                        isPaused = true;

                        break;
                    }
                }

                for (let index2 = 0; index2 < modalMini.length; index2++) {
                    if (modalMini[index2].classList.contains(classOfElem) && modalMini[index2].classList.contains('hide')) {
                        opens[index].style.zIndex = '1';
                        modalMini[index2].classList.remove('hide');
                        cover.classList.remove('hide');
                        body.style.overflow = "hidden";
                        isPaused = true;
                        console.log(index2);

                        break;
                    } else if (!modalMini[index2].classList.contains('hide')) { // Закрывает модальные окна
                        if (!listOfActives.classList.contains('hide') && !e.target.classList.contains('active') && modalAddBook.classList.contains('hide') && modalUpdateBook.classList.contains('hide') && modalDeleteBook.classList.contains('hide')) {
                            console.log('wegwwrasadsdsweet');
                            opens[index].removeAttribute('style');
                            modalMini[index2].classList.add('hide');
                            cover.classList.add('hide');
                            body.removeAttribute('style');
                            isPaused = false;
                        } else if (!e.target.classList.contains('active') &&(!modalAddBook.classList.contains('hide') ||!modalUpdateBook.classList.contains('hide') || !modalDeleteBook.classList.contains('hide'))) {
                            console.log('wegw');
                            modalMini[index2].classList.add('hide');
                        } else if (!e.target.classList.contains('active')) {
                            modalMini[index2].classList.add('hide');
                            cover.classList.add('hide');
                            body.removeAttribute('style');
                        } else {
                            modalMini[index2].classList.add('hide');
                            opens[index].removeAttribute('style');
                        }
                    }
                }
            })
        }

        // Закрывает модальные окна
        for (let index = 0; index < closeModal.length; index++) {
            closeModal[index].addEventListener('click', (e) => {
                if (!bookCard.classList.contains('hide')) {
                    cover.removeAttribute('style');
                    modal[index].classList.add('hide');
                    getBooks();
                } else if (!listOfActives.classList.contains('hide')) {
                    modal[index].classList.add('hide');
                } else if (listOfActives.classList.contains('hide')) {
                    modal[index].classList.add('hide');
                    cover.classList.add('hide');
                    body.removeAttribute('style');

                    personalAdmin.removeAttribute('style');
                } else {
                    console.log("fdsf");
                    modal[index].classList.add('hide');
                    cover.classList.add('hide');
                    body.removeAttribute('style');
                    isPaused = false;
                }

                for (let index2 = 0; index2 < modalMini.length; index2++) {
                    if (!modalMini[index2].classList.contains('hide') && listOfActives.classList.contains('hide')) {
                        modalMini[index2].classList.add('hide');
                    }
                }
            })
        }

        cover.addEventListener('click', (e) => {
            
            if (!bookCard.classList.contains('hide')) {
                cover.removeAttribute('style');
                getBooks();
            } else {
                isPaused = false;
                cover.removeAttribute('style');
                cover.classList.add('hide');
                body.removeAttribute('style');
                personalAdmin.removeAttribute('style');

                for (let index = 0; index < modal.length; index++) {
                    if (!modal[index].classList.contains('hide')) {
                        modal[index].classList.add('hide');
                    } 
                }
    
                for (let index = 0; index < modalMini.length; index++) {
                    if (!modalMini[index].classList.contains('hide')) {
                        for(let index2 = 0; index2 < opens.length; index2++) {
                            if (opens[index2].getAttribute('style')) {
                                console.log("egw");
                                opens[index2].removeAttribute('style');
                                break;
                            }
                        }
                        modalMini[index].classList.add('hide');
                        
                    } 
                }
            }
            
            
        })
    }
        
    closeAndOpenModals();


    function changeStatusAfterSelectFile() {
        let input = document.querySelector('.input__file'),
            input2 = document.querySelector('.input__file2'),
            inputText = document.querySelector('.input__file-button-text'),
            inputText2 = document.querySelector('.input__file-button-text2');

        input.addEventListener('change', (event) => {
            inputText.innerHTML = "Выбран 1 файл";
        })

        input2.addEventListener('change', (event) => {
            inputText2.innerHTML = "Выбран 1 файл";
        })
    }

    changeStatusAfterSelectFile();


    function closeAndOpenSearch() {
        let searchBlock = document.querySelector('.search'),
            closeSearch = document.querySelector('.close_search_img'),
            magnificentImg = document.querySelector('.magnificent_img'),
            resultSearch = document.querySelector('.result_search'),
            personal = document.querySelector('.personal');

        // Открывает поиск
        searchBlock.addEventListener('click', function(e){
            if((e.target.tagName == "IMG" || e.target.tagName == "INPUT") && searchBlock.getAttribute('style') == null){
                cover.classList.remove('hide');
                searchBlock.style.zIndex = '1';
                searchBlock.style.margin = '0';
                searchBlock.style.position = 'absolute';
                searchBlock.style.width = '100%';
                searchBlock.style.height = '60%';
                searchBlock.style.borderRadius = '0 0 20px 20px';
                body.style.overflow = "hidden";
                magnificentImg.classList.add('hide');
                closeSearch.classList.remove('hide');
                isPaused = true;
            } else if (e.target.tagName == "IMG" && searchBlock.getAttribute('style') != null) { // Закрывает поиск
                if (!resultSearch.classList.contains('hide')) {
                    console.log('esgr');
                    resultSearch.classList.add('hide');
                }

                cover.classList.add('hide');
                searchBlock.removeAttribute('style');
                body.removeAttribute('style');
                magnificentImg.classList.remove('hide');
                closeSearch.classList.add('hide');
        
                isPaused = false;
            }
        })

        // Зарывает поиск
        cover.addEventListener('click', (e) => {
            if (!bookCard.classList.contains('hide')) {
                cover.removeAttribute('style');
                bookCard.classList.add('hide');
                getBooks();
            } else {
                cover.classList.add('hide');
                body.removeAttribute('style');
    
                magnificentImg.classList.remove('hide');
                closeSearch.classList.add('hide');
    
                if (!resultSearch.classList.contains('hide')) {
                    resultSearch.classList.add('hide');
                    console.log('esgr');
    
                }
    
                function removeStyles(elem) {
                    elem.removeAttribute('style')
    
                    elem.childeNodes.forEach(x => {
                        if(x.nodeType == 1) removeStyles(x);
                    })
                }
    
                removeStyles(searchBlock);
            }
            
        })
    }
    
    closeAndOpenSearch();


    function butSubmit() {
        let formBut = document.querySelectorAll('.form_bd button'),
            personalAdmin = document.querySelector('.personal_admin'),
            personalUser = document.querySelector('.personal_user'),
            jsDiv = document.querySelector('.js'),
            modalSignInBut = document.querySelector('.modal_sign_in form button');

        // for (let index = 0; index < formBut.length; index++) {
        //     formBut[index].addEventListener('click', (e) => {
        //         setTimeout(function() {
        //             getBooks();
        //         }, 1000);
        //     })
        // }

        // modalSignInBut.addEventListener('click', (e) => {
        //     setTimeout(function() {
        //         if (!personalAdmin.classList.contains('hide')) {        
        //                 console.log('faegfsdf');
        //                 getBooks();
        //                 setTimeout(function() {
        //                     deleteBooks();
        //                 }, 800);

        //         }
        //     }, 1000); 
        // })
    }
    butSubmit();

    
    function activesOfAdmin() {
        let body = document.querySelector('body'),
            listOfActives = document.querySelectorAll('.list_of_actives'),
            modals = document.querySelectorAll('.modal'),
            modalAddBook = document.querySelector('.modal_add_book'),
            modalUpdateBook = document.querySelector('.modal_update_book'),
            modalDeleteBook = document.querySelector('.modal_delete_book'),
            userCard = document.querySelector('.user_card'),
            signsButtons = document.querySelector('.signs_buttons'),
            personalAdmin = document.querySelector('.personal_admin'),
            personalUser = document.querySelector('.personal_user'),
            cover = document.querySelector('.backCover');

        listOfActives[0].addEventListener('click', (e) => {
            for (let index = 0; index < modals.length; index++) {
                if (!modals[index].classList.contains('hide')) {
                    modals[index].classList.add('hide');
                }
            }

            if (e.target.classList.contains('first_active')) {
                modalAddBook.classList.remove('hide');
            }

            if (e.target.classList.contains('second_active')) {
                modalUpdateBook.classList.remove('hide');
            }

            if (e.target.classList.contains('third_active')) {
                modalDeleteBook.classList.remove('hide');
            }

            if (e.target.classList.contains('fourth_active')) {
                personalAdmin.classList.add('hide');
                signsButtons.classList.remove('hide');
                cover.classList.add('hide');
                body.removeAttribute('style');
                getBooks();
            }
        })

        listOfActives[1].addEventListener('click', (e) => {
            for (let index = 0; index < modals.length; index++) {
                if (!modals[index].classList.contains('hide')) {
                    modals[index].classList.add('hide');
                }
            }

            if (e.target.classList.contains('first_active')) {
                userCard.classList.remove('hide');
            }

            if (e.target.classList.contains('fourth_active')) {
                personalUser.classList.add('hide');
                signsButtons.classList.remove('hide');
                cover.classList.add('hide');
                body.removeAttribute('style');
            }
        })
    }
    activesOfAdmin();


    function deleteBooks() {
        let deleteBookButs = document.querySelectorAll('.delete_book'),
            idBook = document.querySelectorAll('.id_of_book'),
            deleteBut = document.querySelector('.delete_book_but'),
            deleteIdInput = document.querySelector('.delete_id');

            for (let i = 0; i < deleteBookButs.length; i++) {
                deleteBookButs[i].addEventListener('click', (e) => {
                    console.log(idBook[i].innerHTML.replace(/\s/g, ''))
                    deleteBook(idBook[i].innerHTML.replace(/\s/g, ''));
                })
            }       

            deleteBut.addEventListener('click', (e) => {
                let arr = deleteIdInput.ariaValueMax.split('/');

                deleteBook(arr);
            })
    }

    async function deleteBook(id) {
        if (!isNaN(id)) {
            await fetch(`http://api.books.ru/books/${id}`, {
                method: 'DELETE'
            })
            .then(async response => {
                getBooks();
            })
        } else {
            for (let index = 0; index < id.length; index++) {
                await fetch(`http://api.books.ru/books/${id[index]}`, {
                    method: 'DELETE'
                })
                .then(async response => {
                    if (index == id.length - 1) {
                        getBooks();                        
                    }
                })  
            }
        }
        
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
                        <div>
                            ${books[index]['name_author']}
                        </div>
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


        let aboutBook = document.querySelectorAll('.ab_book'),
            idBook = document.querySelectorAll('.id_of_book');
        for (let index = 0; index < aboutBook.length; index++) {
            aboutBook[index].addEventListener('click', (e) => {
                console.log(idBook[index].innerHTML.trim());
                getBooksModal(idBook[index].innerHTML.trim());
            })
        }

        if (!document.querySelector('.personal_admin').classList.contains('hide')) {
            deleteBooks();
        }
    }

    getBooks();

    async function getBooksModal(param) {
        let res;
        
        res = await fetch(`http://api.books.ru/books/${param}`);
        
        let books = await res.json();
        console.log(books);

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


//    async function getBooksSortGenre(genre) {
//         let res = await fetch(`http://api.books.ru/books/${genre}`);
//         let books = await res.json();
//         console.log(books.length);
//         document.querySelector('.books').innerHTML = '';
//         books.forEach((book) => {
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

//                 <div class="delete_book hide">
//                     Удалить
//                 </div>
//                 </div>
//             </div>
//             `
//         })
//     }

    


    // async function addPost() {
    //     let name = document.querySelector('.modal_add_book .name').value;
    //     let description = document.querySelector('.modal_add_book .description').value;
    //     let yearOfRelease = document.querySelector('.modal_add_book .year_of_release').value;
    //     let genre = document.querySelector('.modal_add_book .genre').value;
    //     let cover = document.querySelector('.modal_add_book .description');
    
    //     let formData = new FormData();
    //     formData.append("name", name);
    //     formData.append("description", description);
    //     formData.append("year_of_release", yearOfRelease);
    //     formData.append("genre", genre);
    //     formData.append("cover", cover);
    
    //     const res = await fetch('http://api.books.ru/posts', {
    //         method: 'POST',
    //         body: formData
    //     })
    
    //     let data = await res.json();
    //     // if (data.status === true) {
    //     //     await getPosts();
    //     // }
    
    //     console.log(data);
    // }

    // addBookBut.addEventListener('click', (event) => {
    //     event.preventDefault();
    //     addPost();
    // })

});
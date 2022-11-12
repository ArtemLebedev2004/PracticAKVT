document.addEventListener("DOMContentLoaded", function(event) { 
    let rightArrow = document.querySelector('.next_slide');
    let leftArrow = document.querySelector('.back_slide');
    let slides = document.querySelectorAll('.slides div');
    let slidesImg = document.querySelectorAll('.slides div img');
    let pointsUnderSlider = document.querySelectorAll('.points div');

    let isPaused = false;
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
});
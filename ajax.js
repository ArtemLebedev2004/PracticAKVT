$(document).ready(function (){
    var result = $('.js');

    $('.form_sign_up').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(msg){
                result.html(msg);
            }
        })
    })
});


$(document).ready(function (){
    var result = $('.js');

    $('.form_sign_in').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache : false,
            contentType: false,
            processData: false,
            success: function(msg){
                result.html(msg);
                
            }
        })
        .done(function( msg ) {
            alert( "Data Saved: " + msg );
        });
    })
});

$(document).ready(function() {	
	var result = $('.result_search');
	
	$('.search_place').on('keyup', function(){
		var search = $(this).val();
		if ((search != '') && (search.length > 1)){
			$.ajax({
				type: "POST",
				url: "controller.php",
				data: {'search' : search},
                cache: false,
				success: function(msg){
					result.html(msg);
					if(msg != ''){	
						result.removeClass('hide');
					}
				}
			})
            .done(function( msg ) {
                alert( "Data Saved: " + msg );
            });
		 } else {
			// result.html('');
			// result.fadeOut(100);
		 }
	});
})

$(document).ready(function() {	
	let result = $('.js');
	
	$('.form_add_book').on('submit', function(e){
    let formData = new FormData(this);
    e.preventDefault();

		
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: formData,
                cache: false,
                contentType: false,
            processData: false,
				success: function(msg){
					result.html(msg);
				}
			})
            .done(function( msg ) {
                alert( "Data Saved: " + msg );
            });
	});
})

// let resultSearch = document.querySelector('.result_search');

// $(document).ready(function (){
//     $('.search_place').on('keyup', function (e){
//         let search = $('.search_place').val();
//         $.ajax({
//             type: "POST",
//             url: 'controller.php',
//             data: search,
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function(msg) {
//                 resultSearch.classList.remove('hide');
//                 resultSearch.innerHTML = msg;
//             }
//         })
//         .done(function( msg ) {
//             alert(msg);
//         });
//     })
// });
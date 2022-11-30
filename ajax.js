$(document).ready(function (){
    $('.form_sign_up').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);

        let result = $('.js');
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(msg){
				result.html(msg);
				result.fadeIn();
			}
        })
        // .done(function(msg) {
        //     alert( "Data Saved: " + msg );
        // });

        // $('input.title').val("");
        // $('textarea.content').val("");
    })

	$('.form_add_book').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function( msg ) {
            alert( "Data Saved: " + msg );
        });

        // $('input.title').val("");
        // $('textarea.content').val("");
    })

	$('.form_update_book').on('submit', function (e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function( msg ) {
            alert( "Data Saved: " + msg );
        });

        // $('input.title').val("");
        // $('textarea.content').val("");
    })

    let resultSigns = $('.js');
	
	$('.form_sign_in').on('submit', function (e){
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
				resultSigns.html(msg);
				resultSigns.fadeIn();
			}
        })

        // $('input.title').val("");
        // $('textarea.content').val("");
    })


    let $resultSearch = $('.result_search');
	
	$('.search_place').on('keyup', function(){
		var search = $(this).val();
		search = search.replace(/\s/g, "");
		if (search != ''){
			$resultSearch.removeClass('hide');
			$.ajax({
				type: "POST",
				url: "some2.php",
				data: {'search': search},
				success: function(msg){
					$resultSearch.html(msg);
					if(msg != ''){	
						$resultSearch.fadeIn();
					} else {
						$resultSearch.fadeOut(100);
						$resultSearch.addClass('hide');
					}
				}
			});
		 } else {
			$resultSearch.html('');
			$resultSearch.addClass('hide');
			$resultSearch.fadeOut(100);
		 }
	});
 
	// $(document).on('click', function(e){
	// 	if (!$(e.target).closest('.search').length){
	// 		$resultSearch.html('');
	// 		$resultSearch.addClass('hide');
	// 		$resultSearch.fadeOut(100);
	// 	}
	// });
	
	// $(document).on('click', '.search_result-name a', function(){
	// 	$('#search').val($(this).text());
	// 	$resultSearch.fadeOut(100);
	// 	$resultSearch.addClass('hide');
	// 	return false;
	// });
	
	// $(document).on('click', function(e){
	// 	if (!$(e.target).closest('.search').length){
	// 		$resultSearch.html('');
	// 		$resultSearch.fadeOut(100);
	// 		$resultSearch.addClass('hide');
	// 	}
	// });
})
    // let result = $('.result_search');
    // $('.form_search').on('keyup', function (e){
    //     e.preventDefault();
    //     let formData = new FormData(this);
    //     console.log('w');
        
    //         $.ajax({
    //             type: "POST",
    //             url: $(this).attr('action'),
    //             data: formData,
    //             cache: false,
    //             contentType: false,
    //             processData: false
    //         })
    //         result.removeClass('hide');
        
    // })
//     $(document).ready(function() {
    
// });
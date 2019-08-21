$(function () {
  'user strict';



    // $('.live-title').keyup(function (){
    //   $('.live-preview .captionone h3').text($(this).val());
    // });

    $('.live').keyup(function (){
      $('.live-preview .captionone h3').text($(this).val());
    });

  // Dashboard

	// $('.toggle-info').click(function () {
  //
	// 	$(this).toggleClass('selected').parent().next('.uk-card-body').fadeToggle(100);
  //
  //
  //   if ($(this).hasClass('selected')) {
  //
	// 		$(this).html('<i class="fas fa-plus fa-1x"></i>');
  //
	// 	} else {
  //
	// 		$(this).html('<i class="fas fa-minus fa-1x"></i>');
  //
	// 	}
  //
	// });

  // $('.uk-navbar-nav li a').click( function() {
  //
  //     $(this).parent().addClass('acitve');
  //     $(this).parent().siblings().removeClass('acitve');
  //
  // });

  // Hide Placeholder On Form Focus

	$('[placeholder]').focus(function () {

		$(this).attr('data-text', $(this).attr('placeholder'));

		$(this).attr('placeholder', '');

	}).blur(function () {

		$(this).attr('placeholder', $(this).attr('data-text'));

	});
});

$(function () {
  'user strict';

  // Dashboard

	$('.toggle-info').click(function () {

		$(this).toggleClass('selected').parent().next('.uk-card-body').fadeToggle(100);


    if ($(this).hasClass('selected')) {

			$(this).html('<i class="fas fa-plus fa-1x"></i>');

		} else {

			$(this).html('<i class="fas fa-minus fa-1x"></i>');

		}

	});

  // Hide Placeholder On Form Focus

  $('[placeholder]').focus(function () {

    $(this).attr('data-text', $(this).attr('placeholder'));

    $(this).attr('placeholder', '');

  }).blur(function () {

    $(this).attr('placeholder', $(this).attr('data-text'));

  });


});

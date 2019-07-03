/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

jQuery(function($){
    var $body = $('body'),
    $wrapper = $('.body-innerwrapper'),
    $toggler = $('#offcanvas-toggler'),
    $close = $('.close-offcanvas'),
    $offCanvas = $('.offcanvas-menu');

    $toggler.on('click', function(event){
        event.preventDefault();
        stopBubble (event);
        setTimeout(offCanvasShow, 50);
    });

    $close.on('click', function(event){
        event.preventDefault();
        offCanvasClose();
    });

    $( ".offcanvas-inner ul li a" ).click(function() {
        offCanvasClose();
    });


    var offCanvasShow = function(){
        $body.addClass('offcanvas');
        $wrapper.on('click',offCanvasClose);
        $close.on('click',offCanvasClose);
        $offCanvas.on('click',stopBubble);

    };

    var offCanvasClose = function(){
        $body.removeClass('offcanvas');
        $wrapper.off('click',offCanvasClose);
        $close.off('click',offCanvasClose);
        $offCanvas.off('click',stopBubble);
    };

    var stopBubble = function (e) {
        e.stopPropagation();
        return true;
    };
    
	$menu_items = $('ul.sp-megamenu-parent > li.sp-menu-item');
	$('ul.sp-megamenu-parent > li.sp-menu-item a').click(function(event) {
		var target = $(this).prop('hash');
		if(target) {
			event.preventDefault();

			$menu_items.removeClass('active');
			$(this).parent().addClass('active');

			$('html, body').animate({
				scrollTop: $(target).offset().top - $('#sp-top-bar').height()
			}, 500);
		}
	});
	//scrollspy
	$('[data-spy="scroll"]').each(function () {
		var $spy = $(this).scrollspy('refresh')
	});
});
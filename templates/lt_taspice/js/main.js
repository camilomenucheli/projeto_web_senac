/**
* @package Helix3 Framework
* @author L.THEME http://www.ltheme.com
* @copyright Copyright (c) 2010 - 2015 L.THEME
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

jQuery(function($) {
    $('#offcanvas-toggler').on('click', function(event){
        event.preventDefault();
        $('body').toggleClass('offcanvas');
    });

    $('.close-offcanvas').on('click', function(event){

        $('body').removeClass('offcanvas');
    });
    $('.close-offcanvas').on('click', function(event){
        event.stopPropagation();
        $('body').removeClass('offcanvas');
    });

    //Mega Menu
    $('.sp-megamenu-wrapper').parent().parent().css('position','static').parent().css('position', 'relative');
    $('.sp-menu-full').each(function(){
        $(this).parent().addClass('menu-justify');
    });

    //Sticky Menu
    $(document).ready(function(){
        $("body.sticky-header").find('#sp-header').sticky({topSpacing:0})
    });

    //Tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
    
    //one page nav with smoth scroll and active nav


});
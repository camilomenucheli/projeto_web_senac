/* ======================================================
# Web357 Framework - Joomla! System Plugin v1.3.9
# -------------------------------------------------------
# For Joomla! 3.0
# Author: Yiannis Christodoulou (yiannis@web357.eu)
# Copyright (©) 2009-2017 Web357. All rights reserved.
# License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
# Website: https://www.web357.eu/
# Support: support@web357.eu
# Last modified: 01 Mar 2017, 07:29:16
========================================================= */

// Powered by: http://www.jqueryscript.net/lightbox/Super-Simple-Modal-Popups-with-jQuery-CSS3-Transitions.html
var jModal = jQuery.noConflict();
jModal(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

  jModal('a[data-modal-id]').click(function(e) {
    e.preventDefault();
    jModal("body").append(appendthis);
    jModal(".modal-overlay").fadeTo(500, 0.7);
    //jModal(".js-modalbox").fadeIn(500);
    var modalBox = jModal(this).attr('data-modal-id');
    jModal('#'+modalBox).fadeIn(jModal(this).data());
  });  

jModal(".js-modal-close, .modal-overlay").click(function() {
  jModal(".modal-box, .modal-overlay").fadeOut(500, function() {
    jModal(".modal-overlay").remove();
  });
});
 
jModal(window).resize(function() {
  jModal(".modal-box").css({
    top: (jModal(window).height() - jModal(".modal-box").outerHeight()) / 2,
    left: (jModal(window).width() - jModal(".modal-box").outerWidth()) / 2
  });
});
 
jModal(window).resize();
 
});
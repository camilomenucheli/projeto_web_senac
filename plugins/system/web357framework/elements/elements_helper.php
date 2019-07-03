<?php
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

defined('_JEXEC') or die;

// Load modal
JHTML::_('behavior.modal');

// BEGIN: Custom CSS & Javascript

// some useful params
jimport('joomla.environment.uri' );
$host = JURI::root();
$document = JFactory::getDocument();
JLoader::import( "joomla.version" );
$version = new JVersion();

// jQuery
if (version_compare( $version->RELEASE, "2.5", "<=")) :
	$document->addScript(JURI::root(true).'/plugins/system/web357framework/elements/assets/js/jquery-1.10.2.min.js');
endif;

// Custom JS Script
$document->addScript(JURI::root(true).'/plugins/system/web357framework/elements/assets/js/script.js');

// CSS Style
$document->addStyleSheet(JURI::root(true).'/plugins/system/web357framework/elements/assets/css/web357framework.css');

// END: Custom CSS & Javascript

// BEGIN: Loading plugin language file
$lang = JFactory::getLanguage();
$current_lang_tag = $lang->getTag();
$lang = JFactory::getLanguage();
$extension = 'plg_system_web357framework';
$base_dir = JPATH_ADMINISTRATOR;
$language_tag = (!empty($current_lang_tag)) ? $current_lang_tag : 'en-GB';
$reload = true;
$lang->load($extension, $base_dir, $language_tag, $reload);
// END: Loading plugin language file

 // Check if extension=php_curl.dll is enabled in PHP
function isCurl(){
	if (function_exists('curl_version')):
		return true;
	else:
		return false;
	endif;
}

// Check if allow_url_fopen is enabled in PHP
function allowUrlFopen(){
	if(ini_get('allow_url_fopen')):
		return true;
	else:
		return false;
	endif;
}
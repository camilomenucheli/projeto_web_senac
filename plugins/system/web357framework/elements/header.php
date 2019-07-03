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

defined('JPATH_BASE') or die;

require_once('elements_helper.php');

jimport('joomla.form.formfield');

class JFormFieldHeader extends JFormField {
	
	function getInput()
	{
		return "";
	}

	function getLabel()
	{
		// Retrieving request data using JInput
		$jinput = JFactory::getApplication()->input;

		if (method_exists($this, 'fetchTooltip')):
			$label = $this->fetchTooltip($this->element['label'], $this->description, $this->element, $this->options['control'], $this->element['name'] = '');
		else:
			$label = parent::getLabel();
		endif;
		
		// get joomla version
		JLoader::import( "joomla.version" );
		$version = new JVersion();
		if (version_compare( $version->RELEASE, "2.5", "<=")) :
			// v2.5
			$jversion = 'vj25x';
		elseif (version_compare( $version->RELEASE, "3.0", "<=")) :
			// v3.0.x
			$jversion = 'vj30x';
		elseif (version_compare( $version->RELEASE, "3.1", "<=")) :
			// v3.1.x
			$jversion = 'vj31x';
		elseif (version_compare( $version->RELEASE, "3.2", "<=")) :
			// v3.2.x
			$jversion = 'vj32x';
		elseif (version_compare( $version->RELEASE, "3.3", "<=")) :
			// v3.3.x
			$jversion = 'vj33x';
		elseif (version_compare( $version->RELEASE, "3.4", "<=")) :
			// v3.4.x
			$jversion = 'vj34x';
		else:
			// other
			$jversion = 'j00x';
		endif;
		
		// There are two types of class, the w357_large_header, w357_small_header, w357_xsmall_header.
		$class = (!empty($this->element['class'])) ? $this->element['class'] : '';
		
		// Output
		return '<div class="w357frm_param_header '.$class.' '.$jversion.' '.$jinput->get('option').'">'.$label.'</div>';
	}

}
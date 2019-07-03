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

class JFormFieldjedreview extends JFormField {
	
	protected $type = 'jedreview';

	protected function getInput()
	{
		return ' ';
	}

	protected function getLabel()
	{	
		// get extension's details
		$extension_type_single = $this->element['extension_type']; // component, module, plugin 
		$extension_type = $this->element['extension_type'].'s'; // components, modules, plugins 
		$extension_name = preg_replace('/(plg_|com_|mod_)/', '', $this->element['extension_name']);
		$plugin_type = $this->element['plugin_type']; // system, authentication, content etc.
		$plugin_folder = (!empty($plugin_type) && $plugin_type != '') ? $plugin_type.'/' : '';
		$real_name = $this->element['real_name'];
		$real_name = JText::_($real_name);
		
		if (empty($extension_type) || empty($extension_name)):
			JFactory::getApplication()->enqueueMessage("Error in XML. Please, contact us at support@web357.eu!", "error");
			return false;
		endif;
		
		// BEGIN: get button links
		switch ($extension_name):
			case "cookiespolicynotificationbar":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/site-management/cookie-control/cookies-policy-notification-bar';
			break;
			case "countdown":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/calendars-a-events/events/count-down';
			break;
			case "datetime":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/calendars-a-events/time/display-date-time';
			break;
			case "failedloginattempts":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/access-a-security/site-security/failed-login-attempts';
			break;
			case "loginasuser":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/clients-a-communities/user-management/login-as-user';
			break;
			case "monthlyarchive":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/news-display/articles-display/monthly-archive';
			break;
			case "fixedhtmltoolbar": // toolbar
				$jed_link = 'http://extensions.joomla.org/extensions/extension/social-web/social-display/toolbar';
			break;
			case "vmcountproducts":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/extension-specific/virtuemart-extensions/virtuemart-count-products';
			break;
			case "vmsales":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/extension-specific/virtuemart-extensions/virtuemart-sales';
			break;
			case "supporthours":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/contacts-and-feedback/opening-hours/support-hours';
			break;
			case "fix404errorlinks":
				$jed_link = 'http://extensions.joomla.org/extensions/extension/site-management/fix-404-error-links';
			break;

			default:
				$jed_link = '';
		endswitch;
		// END: get button links
		
		$html = '<p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p>';
		
		return $html;	
	}

}
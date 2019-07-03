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

class JFormFieldDescription extends JFormField {
	
	protected $type = 'description';

	// check if url exists
	protected function url_exists($url) {
		
		if ($this->_isCurl()):
	
			// cUrl method
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_exec($ch);
			$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // $retcode >= 400 -> not found, $retcode = 200, found.
			curl_close($ch);
			
			if ($retcode == 200):
				return true;
			else:
				return false;
			endif;
			
		else:
			
			// default method
			$file_headers = @get_headers($url);
			if($file_headers[0] == 'HTTP/1.1 404 Not Found'):
				return false;
			else:
				return true;
			endif;
			
		endif;
	}
	
	protected function getInput()
	{
		return ' ';
	}

	function getHtmlDescription($extension_type = '', $extension_name = '', $plugin_type = '', $real_name = '') // e.g. 'plugin', 'loginasuser', 'system', 'Login as User'
	{		
		// BEGIN: get extension's details
		$extension_type = (!empty($extension_type)) ? $extension_type : $this->element['extension_type']; // component, module, plugin 
		$extension_name = (!empty($extension_name)) ? $extension_name : preg_replace('/(plg_|com_|mod_)/', '', $this->element['extension_name']);
		$plugin_type = (!empty($plugin_type)) ? $plugin_type : $this->element['plugin_type'].' '; // system, authentication, content etc.
		$real_name = (!empty($real_name)) ? $real_name : $this->element['real_name'];
		$real_name = JText::_($real_name);//.' - Joomla! '.$plugin_type.''.$extension_type;
		// END: get extension's details
		
		// Retrieving request data using JInput
		$jinput = JFactory::getApplication()->input;

		// BEGIN: get button links
		switch ($extension_name):
			
			case "cookiespolicynotificationbar":
				$extension_type = 'Plugin';
				$view_demo_link = 'http://demo.web357.eu/joomla-plugins/cookies-policy-notification-bar';
				$more_details_link = 'https://www.web357.eu/products/joomla-plugins/cookies-policy-notification-bar';
				$doc_link = 'https://www.web357.eu/docs/joomla-plugins/cookies-policy-notification-bar';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/site-management/cookie-control/cookies-policy-notification-bar';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "countdown":
				$extension_type = 'Module';
				$view_demo_link = 'http://demo.web357.eu/joomla-modules/count-down';
				$more_details_link = 'https://www.web357.eu/products/joomla-modules/count-down';
				$doc_link = 'https://www.web357.eu/docs/joomla-modules/count-down';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/calendars-a-events/events/count-down';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "datetime":
				$extension_type = 'Module';
				$view_demo_link = 'http://demo.web357.eu/joomla-modules/date-time';
				$more_details_link = 'https://www.web357.eu/products/joomla-modules/date-time';
				$doc_link = 'https://www.web357.eu/docs/joomla-modules/date-time';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/calendars-a-events/time/display-date-time';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "failedloginattempts":
				$extension_type = 'Plugin';
				$view_demo_link = 'http://demo.web357.eu/joomla-plugins/failed-login-attempts';
				$more_details_link = 'https://www.web357.eu/products/joomla-plugins/failed-login-attempts';
				$doc_link = 'https://www.web357.eu/docs/joomla-plugins/failed-login-attempts';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/access-a-security/site-security/failed-login-attempts';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "loginasuser":
				$extension_type = 'Component &amp; Plugin';
				$view_demo_link = 'http://goo.gl/ZmJJ5s';
				$more_details_link = 'https://www.web357.eu/products/joomla-plugins/login-as-user';
				$doc_link = 'https://www.web357.eu/docs/joomla-plugins/login-as-user';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '<p><strong>To see plugin in action, <a href="index.php?option=com_loginasuser&plg=loginasuser">visit Component\'s page</a>.</strong></p>';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/clients-a-communities/user-management/login-as-user';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "monthlyarchive":
				$extension_type = 'Component &amp; Module';
				$view_demo_link = 'http://demo.web357.eu/joomla-components/monthly-archive';
				$more_details_link = 'https://www.web357.eu/products/joomla-components/monthly-archive';
				$doc_link = 'https://www.web357.eu/docs/joomla-components/monthly-archive';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/news-display/articles-display/monthly-archive';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "toolbar":
				$extension_type = 'Module';
				$view_demo_link = 'http://demo.web357.eu/joomla-modules/toolbar';
				$more_details_link = 'https://www.web357.eu/products/joomla-modules/toolbar';
				$doc_link = 'https://www.web357.eu/docs/joomla-modules/toolbar';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/social-web/social-display/toolbar';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "fixedhtmltoolbar":
				$extension_type = 'Module';
				$view_demo_link = 'http://demo.web357.eu/joomla-modules/toolbar';
				$more_details_link = 'https://www.web357.eu/products/joomla-modules/toolbar';
				$doc_link = 'https://www.web357.eu/docs/joomla-modules/toolbar';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/social-web/social-display/toolbar';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "vmcountproducts":
				$extension_type = 'Module';
				$view_demo_link = 'http://demo.web357.eu/joomla-modules/vm-count-products';
				$more_details_link = 'https://www.web357.eu/products/joomla-modules/virtuemart-count-products';
				$doc_link = 'https://www.web357.eu/docs/joomla-modules/virtuemart-count-products';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/extension-specific/virtuemart-extensions/virtuemart-count-products';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "vmsales":
				$extension_type = 'Component';
				$view_demo_link = 'http://demo.web357.eu/joomla-components/virtuemart-sales';
				$more_details_link = 'https://www.web357.eu/products/joomla-components/virtuemart-sales';
				$doc_link = 'https://www.web357.eu/docs/joomla-components/virtuemart-sales';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = 'http://extensions.joomla.org/extensions/extension/extension-specific/virtuemart-extensions/virtuemart-sales';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;
			
			case "fix404errorlinks":
				$extension_type = 'Component &amp; Plugin';
				$view_demo_link = 'http://demo.web357.eu/joomla-components/fix-404-error-links';
				$more_details_link = 'https://www.web357.eu/products/joomla-components/fix-404-error-links';
				$doc_link = 'https://www.web357.eu/docs/joomla-components/fix-404-error-links';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = $more_details_link.'#support';
				$more_description = '';
				$jed_link = '';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
				
				// post-installation message
				if ($jinput->get('option') == 'com_installer' && $jinput->get('view') == 'install'):
				
					// BEGIN: Enable 'fix404errorlinks' Plugin
					$db = JFactory::getDbo();
					$query = "UPDATE #__extensions SET enabled=1 WHERE element='fix404errorlinks' AND type='plugin'";
					$db->setQuery($query);
					$db->query();
					// END: Enable 'fix404errorlinks' Plugin
					
					// BEGIN: Disable 'redirect' Plugin
					$db = JFactory::getDbo();
					$query = "UPDATE #__extensions SET enabled=0 WHERE element='redirect' AND type='plugin'";
					$db->setQuery($query);
					$db->query();
					// END: Enable 'redirect' Plugin
					
					$installation_instructions = '<h4>Installation Instructions</h4><p>The component &amp; plugin have been installed correctly.<br />Do not forget to enable the "Fix 404 Error Links" plugin and disable the Joomla! redirect plugin.</p>';
					
					// BEGIN: Check if Web357 Framework plugin exists and is enabled
					jimport('joomla.plugin.helper');
					if(!JPluginHelper::isEnabled('system', 'web357framework')):
						$web357framework_required_msg = JText::_('<div class="alert alert-error"><p>The <strong>"Web357 Framework"</strong> is required for this extension and must be active. Please, download and install it from <a href="http://downloads.web357.eu/?item=web357framework&type=free">here</a>. It\'s FREE!</p></div>');
						JFactory::getApplication()->enqueueMessage($web357framework_required_msg, 'error');
						//return false;
					endif;
					// END: Check if Web357 Framework plugin exists and is enabled
					
					// BEGIN: Check if Redirect Joomla! system plugin is disabled
					if(JPluginHelper::isEnabled('system', 'redirect')):
						$installation_instructions .= JText::_('<div class="alert alert-error"><p>The <strong>"System - Redirect"</strong> Joomla! plugin must be disabled for avoiding conflicts! Please, unpublish it from the <a href="index.php?option=com_plugins&view=plugins" target="_blank">Plugin Manager</a>.</p></div>');
					endif;
					// END: Check if Redirect Joomla! system plugin is disabled
					
					// BEGIN: Check if Virtuemart's handle_404 is disabled
						
					// Check if Virtuemart is installed
					$db = JFactory::getDBO();
					$query = "SELECT COUNT(*) FROM #__extensions WHERE type='component' AND element='com_virtuemart' AND enabled=1";
					$db->setQuery($query);
					$db->query();
					$vm_enabled = $db->loadResult();
					
					if($vm_enabled > 0):
						// get handle_404 value from #__virtuemart_configs 
						$db = JFactory::getDBO();
						$query = "SELECT config FROM #__virtuemart_configs";
						$db->setQuery($query);
						$db->query();
						$vm_config = $db->loadResult();
						$vm_config_arr = explode("|", $vm_config);
						$vm_handle_404 = false;
						foreach ($vm_config_arr as $vm_config_value):
							if ($vm_config_value == 'handle_404="1"'):
								$vm_handle_404 = true;
							endif;
						endforeach;
						
						// message
						if ($vm_handle_404):
							// If you are using "Virtuemart", navigate to "Configuration > Shopfront > Enable VirtueMart 404 error handling" and ensure that is unchecked.
							$installation_instructions .= JText::_('<div class="alert alert-error"><p>If you are using <strong>"Virtuemart"</strong>, navigate to "<a href="index.php?option=com_virtuemart&view=config" target="_blank">Virtuemart Configuration</a> > Shopfront > Enable VirtueMart 404 error handling" and ensure that is unchecked.</p></div>');
						endif;
					endif;
					// END: Check if Virtuemart's handle_404 is disabled
					
					// BEGIN: Check if Fix404ErrorLinks plugin is enabled
					if(!JPluginHelper::isEnabled('system', 'fix404errorlinks')):
						// get ID of plugin
						$db = JFactory::getDBO();
						$query = "SELECT extension_id FROM #__extensions WHERE element='fix404errorlinks' AND type='plugin' AND folder='system'";
						$db->setQuery($query);
						$db->query();
						$extension_id = (int)$db->loadResult();
						
						// link
						$edit_plugin = ($extension_id > 0) ? 'index.php?option=com_plugins&view=plugin&layout=edit&extension_id='.$extension_id : 'index.php?option=com_plugins&view=plugins';
						
						// message
						$web357framework_required_msg = JText::_('<div class="alert alert-error"><p><strong>"Fix 404 Error Links"</strong> plugin must be enabled to allow error 404 logging. Please, enable it from the <a href="'.$edit_plugin.'" target="_blank">Plugin Manager</a> and fix your 404 Error Links asap.</p></div>');
						JFactory::getApplication()->enqueueMessage($web357framework_required_msg, 'error');
						//return false;
					endif;
					// END: Check if Fix404ErrorLinks plugin is enabled
				
				endif;

			break;
			
			case "supporthours":
				$extension_type = 'Module';
				$view_demo_link = 'http://demo.web357.eu/joomla/browse/support-hours';
				$more_details_link = 'https://www.web357.eu/extensions/support-hours';
				$doc_link = 'https://www.web357.eu/documentation/support-hours';
				$changelog_link = $more_details_link.'#changelog';
				$support_link = 'https://www.web357.eu/support';
				$more_description = '';
				$jed_link = '';
				$jed_review = (!empty($jed_link)) ? '<div class="w357_item_full_desc"><h4>'.JText::_('W357FRM_HEADER_JED_REVIEW_AND_RATING').'</h4><p>'.sprintf(JText::_('W357FRM_LEAVE_REVIEW_ON_JED'), $jed_link, $real_name).'</p></div>' : '';
				$installation_instructions = '';
			break;

			default:
				$view_demo_link = '';
				$more_details_link = '';
				$doc_link = '';
				$changelog_link = '';
				$support_link = '';
				$more_description = '';
				$jed_link = '';
				$jed_review = '';
				$installation_instructions = '';
		endswitch;
		// END: get button links

		// output
		$html = '';

		$html .= '</strong>'; // remove strong tag by default post-installation of any joomla! extension

		// Header
		$html .= '<h1>'.$real_name.' - Joomla! '.$extension_type.'</h1>';
		
		// Installation Instructions
		if (!empty($installation_instructions)):
			$html .= '<p>'.$installation_instructions.'</p>';
		endif; 

		// begin row
		$html .= '<div class="row-fluid w357 '.$jinput->get('option').'">';

		// BEGIN: get product's image and buttons
		$product_image = 'https://www.web357.eu/images/products/productpage/'.$extension_name.'.png';
		$html .= '<div class="span3 text-center" style="max-width: 220px;">';

		// image
		$html .= '<p>';
		$html .= (!empty($more_details_link)) ? '<a href="'.$more_details_link.'" target="_blank">' : '';
		$html .= '<img src="'.$product_image.'" alt="'.$real_name.'" />';
		$html .= (!empty($more_details_link)) ? '<a href="'.$more_details_link.'" target="_blank">' : '';
		$html .= '</p>';

		// buttons
		$html .= '<p>';
		$html .= (!empty($view_demo_link)) ? '<a href="'.$view_demo_link.'" class="btn btn-primary" target="_blank">View Demo</a> ' : '';
		$html .= (!empty($more_details_link)) ? '<a href="'.$more_details_link.'" class="btn btn-success" target="_blank">More Details</a> ' : '';
		$html .= '</p>';

		$html .= '<p>';
		$html .= (!empty($doc_link)) ? '<a href="'.$doc_link.'" class="btn btn-warning" target="_blank">Documentation</a> ' : '';
		$html .= '</p>';
		
		$html .= '<p>';
		$html .= (!empty($changelog_link)) ? '<a href="'.$changelog_link.'" class="btn btn-small btn-info" target="_blank">Changelog</a> ' : '';
		$html .= (!empty($support_link)) ? '<a href="'.$support_link.'" class="btn btn-small btn-danger" target="_blank">Support</a> ' : '';
		$html .= '</p>';

		$html .= '</div>';
		// END: get product's image and buttons
		
		// BEGIN: get html description of item
		$html_desc_path = 'http://www.web357.eu/components/com_estore/helpers/html/item_descriptions/'.preg_replace('/(plg_|com_|mod_)/', '', $extension_name).'.html';
				
		if ($this->url_exists($html_desc_path)):
	
			if ($this->_isCurl()): // check if extension=php_curl.dll is enabled from php.ini
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $html_desc_path);
				$html_desc_data = curl_exec($ch);
				curl_close($ch);
				$html .= '<div class="span9">'.((!empty($installation_instructions)) ? '<h4>Description</h4>' : '').$html_desc_data.''.$more_description.''.$jed_review.'</div>';
			elseif ($this->_allowUrlFopen()):
				$html_desc_data = file_get_contents($html_desc_path);
				$html .= '<div class="span9">'.((!empty($installation_instructions)) ? '<h4>Description</h4>' : '').$html_desc_data.''.$more_description.''.$jed_review.'</div>';
			else:
				$html .= '<div class="span9" style="color:red; font-weight: 700;">ERROR! The description of this product couldn\'t be displayed.<br />This is a small bug. Please, report this problem at support@web357.eu.</div>';
			endif;
		endif;
		// END: get html description of item
		
		$html .= '</div>'; // .row

		//$html .= '<strong>'; // remove strong tag by default post-installation of any joomla! extension

		return $html;
	}
	
	protected function getLabel()
	{
		return $this->getHtmlDescription();
	}

	protected function getTitle()
	{
		return $this->getLabel();
	}
	
	protected function _isCurl(){
		return function_exists('curl_version');
	}
	
	protected function _allowUrlFopen(){
		return ini_get('allow_url_fopen');
	}

}
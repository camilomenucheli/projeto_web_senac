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

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.event.plugin');
jimport('joomla.plugin.plugin');
jimport( 'joomla.html.parameter' );

if (!class_exists('plgSystemWeb357framework')):
	class plgSystemWeb357framework extends JPlugin
	{
		public function __construct(&$subject, $config)
		{
			parent::__construct($subject, $config);
		}
		
		public function onAfterDispatch()
		{
			jimport('joomla.environment.uri' );
			$host = JURI::root();
			$document = JFactory::getDocument();
			$app = JFactory::getApplication();
			
			// CSS - backend
			if ($app->isAdmin()):
				$document->addStyleSheet($host.'plugins/system/web357framework/assets/css/style.css');
			endif;
		}
	}
endif;
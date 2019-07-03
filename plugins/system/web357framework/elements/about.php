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
jimport( 'joomla.form.form' );

class JFormFieldAbout extends JFormField {
	
	protected $type = 'about';

	protected function getInput()
	{
		return ' ';
	}

	protected function getLabel()
	{
		$html  = '<div class="container-fluid">';
		$html .= '<div class="row-fluid">';
		$html .= '<div class="span12">';

		// About
		$web357_link = 'https://www.web357.eu/?utm_source=CLIENT&utm_medium=CLIENT-AboutUsLink-web357&utm_content=CLIENT-AboutUsLink&utm_campaign=aboutelement';
		$html .= '<a href="'.$web357_link.'" target="_blank"><img src="https://www.web357.eu/images/web357-logo.jpg" alt="Web357 logo" class="pull-left" style="margin-right: 20px;" /></a>';
		$html .= "<p>We are a young team of professionals and internet lovers who specialise in the development of professional websites and premium extensions for Joomla! CMS. We pride ourselves on providing expertise via our talented and skillful team. We are passionate of our work and that is what makes us stand out in our goal to improve joomla! websites by providing better user interface, increasing performance, efficiency and security.</p>

<p>Our Web357 team carries years of experience in web design and development especially with Joomla! and WordPress platforms. As a result we decided to put together our expertise and eventually Web357 was born. We are proud to be able to contribute to the Joomla! world by delivering the smartest and most cost efficient solutions for the web.</p>

<p>Our products focus on extending Joomla's functionality and making repetitive tasks easier, safer and faster. Our source code is completely open (not encoded or encrypted), giving you the maximum flexibility to either modify it yourself or through our consultants.</p>

<p>We believe in strong long-term relationships with our clients and our working ethic strives for delivering high standard of products and customer support. All our extensions are being regularly updated and improved based on our customers' feedback and new web trends. In addition, Web357 supports personal customisations, as well as we provide assistance and guidance to our clients' individual requirements</p>

<p>Whether you are thinking of using our expertise for the first time or you are an existing client, we are here to help.</p>

<p>Web357 Team<br><a href=\"".$web357_link."\" target=\"_blank\">www.web357.eu</a></p>";
	
		$html .= '</div>'; // .span12
		$html .= '</div>'; // .row
		
		// BEGIN: Social sharing buttons
		$html .= '<div class="row-fluid">';
		$html .= '<div class="span12">';
		$html .= '<h2>Stay connected!</h2>';
		
		$juri_base = str_replace('/administrator', '', JURI::base());
		$social_icons_dir_path = $juri_base.'plugins/system/web357framework/elements/assets/images/social-icons';
		$social_sharing_buttons  = '<div class="w357_social">'; // https://www.iconfinder.com/icons/252077/tweet_twitter_icon#size=32
				
		// facebook
		$social_sharing_buttons .= '<a href="https://www.facebook.com/web357eu" target="_blank" title="Like us on Facebook" class="w357_social_icon"><img src="'.$social_icons_dir_path.'/facebook.png" alt="Facebook" /></a>';

		// twitter
		$social_sharing_buttons .= '<a href="https://twitter.com/web357" target="_blank" title="Follow us on Twitter" class="w357_social_icon"><img src="'.$social_icons_dir_path.'/twitter.png" alt="Twitter" /></a>';
	
		// google+
		$social_sharing_buttons .= '<a href="https://plus.google.com/+Web357Europe/posts" target="_blank" title="Follow us on Google+" class="w357_social_icon"><img src="'.$social_icons_dir_path.'/googleplus.png" alt="Google+" /></a>';
		
		// rss
		$social_sharing_buttons .= '<a href="http://feeds.feedburner.com/web357" target="_blank" title="Subscribe to our RSS Feed" class="w357_social_icon"><img src="'.$social_icons_dir_path.'/rss.png" alt="RSS Feed" /></a>';
		
		// newsletter
		$social_sharing_buttons .= '<a href="https://www.web357.eu/newsletter" target="_blank" title="Subscribe to our Newsletter" class="w357_social_icon"><img src="'.$social_icons_dir_path.'/newsletter.png" alt="Newsletter" /></a>';

		// jed
		$social_sharing_buttons .= '<a href="http://extensions.joomla.org/profile/profile/details/12368" target="_blank" title="Find us on Joomla! Extensions Directory" class="w357_social_icon"><img src="'.$social_icons_dir_path.'/jed.png" alt="JED" /></a>';
		
		$social_sharing_buttons .= '</div>'; // .w357_social
		
		$html .= $social_sharing_buttons;
		$html .= '</div>'; // .span12
		$html .= '</div>'; // .row
		// END: Social sharing buttons

		$html .= '</div>'; // .container

		return $html;
	}

	protected function getTitle()
	{
		return $this->getLabel();
	}
}
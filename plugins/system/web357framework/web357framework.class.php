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

defined('_JEXEC') or die('Restricted access');

if (!class_exists('Web357FrameworkHelperClass')):
class Web357FrameworkHelperClass
{
	var $is_j25x = '';
	var $is_j3x = '';
	
	function __construct()
	{
		// Define the DS (DIRECTORY SEPARATOR)
		$this->defineDS();

		// call the JVersion class
		JLoader::import( "joomla.version" );
		$version = new JVersion();

		// get the Joomla! version
		if (!version_compare( $version->RELEASE, "2.5", "<=")) :
			// is Joomla! 3.x
			$this->is_j3x = true;
			$this->is_j25 = false;
		else:
			// is Joomla! 2.5.x
			$this->is_j3x = false;
			$this->is_j25 = true;
		endif;
	}
	
	// Define the DS (DIRECTORY SEPARATOR)
	public static function defineDS()
	{
		if (!defined("DS")):
			define("DS", DIRECTORY_SEPARATOR);
		endif;
	}
	
	public static function getBrowser()
	{ 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$ub = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}
	
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} 
		elseif(preg_match('/Trident/i',$u_agent)) 
		{ // this condition is for IE11
			$bname = 'Internet Explorer'; 
			$ub = "rv"; 
		} 
		elseif(preg_match('/Firefox/i',$u_agent)) 
		{ 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} 
		elseif(preg_match('/Chrome/i',$u_agent)) 
		{ 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} 
		elseif(preg_match('/Safari/i',$u_agent)) 
		{ 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} 
		elseif(preg_match('/Opera/i',$u_agent)) 
		{ 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} 
		elseif(preg_match('/Netscape/i',$u_agent)) 
		{ 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		} 
		
		// finally get the correct version number
		// Added "|:"
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		 ')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}
	
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1):
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)):
				$version= $matches['version'][0];
			else:
				if (isset($matches['version'][1])):
					$version = $matches['version'][1];
				elseif (isset($matches['version'][0])):
					$version= $matches['version'][0];
				else:
					$version = '';
				endif;
			endif;
		else:
			if (isset($matches['version'][0])):
				$version= $matches['version'][0];
			else:
				$version = '';
			endif;
		endif;

		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
	
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	} 
	
	public static function getOS($userAgent) {
		$oses = array (
			'iPhone' => '(iPhone)',
			'Windows 3.11' => 'Win16',
			'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
			'Windows 98' => '(Windows 98)|(Win98)',
			'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
			'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
			'Windows 2003' => '(Windows NT 5.2)',
			'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
			'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
			'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'Windows ME' => 'Windows ME',
			'Open BSD'=>'OpenBSD',
			'Sun OS'=>'SunOS',
			'Linux'=>'(Linux)|(X11)',
			'Safari' => '(Safari)',
			'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
			'QNX'=>'QNX',
			'BeOS'=>'BeOS',
			'OS/2'=>'OS/2',
			'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
		);
	
		foreach($oses as $os=>$pattern):
			if(preg_match('#'.$pattern.'#', $userAgent)):
				return $os;
			endif;
		endforeach;
		return 'Unknown';
	}

	public static function getCountry()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		$result  = "Unknown";
		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
	
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
	
		if($ip_data && $ip_data->geoplugin_countryName != null)
		{
			$result = $ip_data->geoplugin_countryName;
		}
	
		return $result;
	}
	
}
endif;

// HOW TO USE
/*
function W357FrameworkHelperClass()
{
	// Call the Web357 Framework Helper Class
	require_once(JPATH_PLUGINS.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'web357framework'.DIRECTORY_SEPARATOR.'web357framework.class.php');
	$w357frmwrk = new Web357FrameworkHelperClass;
	return $w357frmwrk;
}

$this->W357FrameworkHelperClass();
echo $this->W357FrameworkHelperClass()->test;
*/
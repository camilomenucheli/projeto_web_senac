<?php
/**
 * @package angi4j
 * @copyright Copyright (C) 2009-2017 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 */

abstract class AngieHelperSetup
{
    public static function cleanLiveSite($url)
    {
        // If the URL is empty there's nothing to do
        if(!$url)
        {
            return $url;
        }

        // If the url doesn't start with http or https let's strip any protocol and force HTTP
        if(!preg_match('#^http(s)?://#', $url))
        {
            $url = 'http://'.preg_replace('#^.*?://#', '', $url);
        }

        // Trim trailing slash
        $url = rtrim($url, '/');

        // Remove anything after the hash or a question mark
        $url = preg_replace('@(#|\?).*@', '', $url);

        //If the URL ends in .php, .html or .htm remove the last part of the URL.
        if(preg_match('#(\.php|\.htm(l)?)$#', $url))
        {
            $url = substr($url, 0, strrpos($url, '/'));
        }

        // Replace commas with dots (common spelling mistake)
        $url = str_replace(',', '.', $url);

        return $url;
    }
}
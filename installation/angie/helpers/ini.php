<?php
/**
 * @package angi4j
 * @copyright Copyright (C) 2009-2017 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 */

/**
 * PHP has a very strange way of handling INI files, thoroughly undocumented. For example, using ${bollocks}
 * in a value will replace that string with the php.ini setting or an environment variable of the same name.
 * Of course this kind of asshattery completely breaks parsing when you have the character sequence ${ in,
 * let's say, a password. In fact it will throw a warning and stop parsing the file. Same applies if you include
 * special characters without enclosing them in double quotes – despite that something like that is perfectly
 * allowed in INI files and even supported in php.ini itself.
 *
 * Basically, PHP's handling of INI is a massive pile of undocumented crap and WTF. So despite the native
 * functions being faster we will NOT use them as they are also completely broken in too many ways. And then you
 * wonder why PHP developers drink to oblivion in conferences... Sigh...
 */
abstract class AngieHelperIni
{
	/**
	 * Parse an INI file and return an associative array.
	 *
	 * @param    string  $file              The file to process
	 * @param    bool    $process_sections  True to also process INI sections
	 *
	 * @return   array    An associative array of sections, keys and values
	 */
	public static function parse_ini_file($file, $process_sections)
	{
		return self::parse_ini_file_php($file, $process_sections);
	}

	/**
	 * Parse an INI string and return an associative array.
	 *
	 * @param    string  $data              The raw INI data to parse
	 * @param    bool    $process_sections  True to also process INI sections
	 *
	 * @return   array    An associative array of sections, keys and values
	 */
	public static function parse_ini_string($data, $process_sections)
	{
		return self::parse_ini_file_php($data, $process_sections, true);
	}

	/**
	 * A PHP based INI file parser.
	 *
	 * Thanks to asohn ~at~ aircanopy ~dot~ net for posting this handy function on
	 * the parse_ini_file page on http://gr.php.net/parse_ini_file
	 *
	 * @param    string $file             Filename to process
	 * @param    bool   $process_sections True to also process INI sections
	 * @param    bool   $rawdata          If true, the $file contains raw INI data, not a filename
	 *
	 * @return    array    An associative array of sections, keys and values
	 */
	static function parse_ini_file_php($file, $process_sections = false, $rawdata = false)
	{
		$process_sections = ($process_sections !== true) ? false : true;

		if (!$rawdata)
		{
			$ini = file($file);
		}
		else
		{
			$file = str_replace("\r", "", $file);
			$ini = explode("\n", $file);
		}

		if (count($ini) == 0)
		{
			return array();
		}

		$sections = array();
		$values = array();
		$result = array();
		$globals = array();
		$i = 0;
		foreach ($ini as $line)
		{
			$line = trim($line);
			$line = str_replace("\t", " ", $line);

			// Comments
			if (!preg_match('/^[a-zA-Z0-9[]/', $line))
			{
				continue;
			}

			// Sections
			if ($line{0} == '[')
			{
				$tmp = explode(']', $line);
				$sections[] = trim(substr($tmp[0], 1));
				$i++;
				continue;
			}

			// Key-value pair
			$lineParts = explode('=', $line, 2);
			if (count($lineParts) != 2)
			{
				continue;
			}
			$key = trim($lineParts[0]);
			$value = trim($lineParts[1]);
			unset($lineParts);

			if (strstr($value, ";"))
			{
				$tmp = explode(';', $value);
				if (count($tmp) == 2)
				{
					if ((($value{0} != '"') && ($value{0} != "'")) ||
						preg_match('/^".*"\s*;/', $value) || preg_match('/^".*;[^"]*$/', $value) ||
						preg_match("/^'.*'\s*;/", $value) || preg_match("/^'.*;[^']*$/", $value)
					)
					{
						$value = $tmp[0];
					}
				}
				else
				{
					if ($value{0} == '"')
					{
						$value = preg_replace('/^"(.*)".*/', '$1', $value);
					}
					elseif ($value{0} == "'")
					{
						$value = preg_replace("/^'(.*)'.*/", '$1', $value);
					}
					else
					{
						$value = $tmp[0];
					}
				}
			}
			$value = trim($value);
			$value = trim($value, "'\"");

			if ($i == 0)
			{
				if (substr($line, -1, 2) == '[]')
				{
					$globals[$key][] = $value;
				}
				else
				{
					$globals[$key] = $value;
				}
			}
			else
			{
				if (substr($line, -1, 2) == '[]')
				{
					$values[$i - 1][$key][] = $value;
				}
				else
				{
					$values[$i - 1][$key] = $value;
				}
			}
		}

		for ($j = 0; $j < $i; $j++)
		{
			if ($process_sections === true)
			{
				if (isset($sections[$j]) && isset($values[$j]))
				{
					$result[$sections[$j]] = $values[$j];
				}
			}
			else
			{
				if (isset($values[$j]))
				{
					$result[] = $values[$j];
				}
			}
		}

		return $result + $globals;
	}
}
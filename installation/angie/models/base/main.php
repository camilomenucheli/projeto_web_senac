<?php
/**
 * @package angi4j
 * @copyright Copyright (C) 2009-2017 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 */

defined('_AKEEBA') or die();

abstract class AngieModelBaseMain extends AModel
{
    /**
     * Are all required settings met?
     *
     * @staticvar   null|bool  $ret  The cached result
     *
     * @return  bool
     */
    public function isRequiredMet()
    {
        static $ret = null;

        if (is_null($ret))
        {
            $required = $this->getRequired();
            $ret = true;
            foreach ($required as $setting)
            {
                if ($setting['warning'])
                {
                    continue;
                }

                $ret = $ret && $setting['current'];
                if (!$ret)
                {
                    break;
                }
            }
        }

        return $ret;
    }

    /**
     * Are all recommended settings met?
     *
     * @staticvar   null|bool  $ret  The cached result
     *
     * @return  bool
     */
    public function isRecommendedMet()
    {
        static $ret = null;

        if (is_null($ret))
        {
            $required = $this->getRequired();
            $ret = true;
            foreach ($required as $setting)
            {
                $ret = $ret && ($setting['current'] == $setting['recommended']);
                if (!$ret)
                {
                    break;
                }
            }
        }

        return $ret;
    }

    /**
     * Descendant class must implement their requirements
     *
     * @return mixed
     */
    abstract public function getRequired();

    /**
     * Detects the CMS version in use and stores it inside the session
     *
     * @return void
     */
    abstract public function detectVersion();

    /**
     * Recommended settings for the current installer
     *
     * @return array
     */
    public function getRecommended()
    {
        return array();
    }

    /**
     * Parses extra info stored while taking the backup
     *
     * @return array
     */
    public function getExtraInfo()
    {
        static $extraInfo = null;

        if (is_null($extraInfo))
        {
            $filename = APATH_INSTALLATION . '/extrainfo.ini';

	        if (file_exists($filename))
	        {
		        $parsedData = AngieHelperIni::parse_ini_file($filename, false);
		        $extraInfo  = array();

		        if (array_key_exists('host', $parsedData))
		        {
			        $extraInfo['host'] = array(
				        'label'   => AText::_('MAIN_EXTRAINFO_HOST'),
				        'current' => $parsedData['host']
			        );
		        }

		        if (array_key_exists('backup_date', $parsedData))
		        {
			        $extraInfo['backup_date'] = array(
				        'label'   => AText::_('MAIN_EXTRAINFO_BACKUPDATE'),
				        'current' => $parsedData['backup_date'] . ' UTC'
			        );
		        }

		        if (array_key_exists('akeeba_version', $parsedData))
		        {
			        $extraInfo['akeeba_version'] = array(
				        'label'   => AText::_('MAIN_EXTRAINFO_AKEEBAVERSION'),
				        'current' => $parsedData['akeeba_version']
			        );
		        }

		        if (array_key_exists('php_version', $parsedData))
		        {
			        $extraInfo['php_version'] = array(
				        'label'   => AText::_('MAIN_EXTRAINFO_PHPVERSION'),
				        'current' => $parsedData['php_version']
			        );
		        }

		        if (array_key_exists('root', $parsedData))
		        {
			        $extraInfo['root'] = array(
				        'label'   => AText::_('MAIN_EXTRAINFO_ROOT'),
				        'current' => $parsedData['root']
			        );
		        }
	        }
        }

        return $extraInfo;
    }

    /**
     * Checks the availability of the parse_ini_file and parse_ini_string functions.
     *
     * @return	boolean
     */
    public function getIniParserAvailability()
    {
        $disabled_functions = ini_get('disable_functions');

        if (!empty($disabled_functions))
        {
            // Attempt to detect them in the disable_functions black list
            $disabled_functions = explode(',', trim($disabled_functions));
            $number_of_disabled_functions = count($disabled_functions);

            for ($i = 0; $i < $number_of_disabled_functions; $i++)
            {
                $disabled_functions[$i] = trim($disabled_functions[$i]);
            }

            $result = !in_array('parse_ini_string', $disabled_functions);
        }
        else
        {
            // Attempt to detect their existence; even pure PHP implementation of them will trigger a positive response, though.
            $result = function_exists('parse_ini_string');
        }

        return $result;
    }

    /**
     * Resets the database connection information of all databases
     */
    public function resetDatabaseConnectionInformation()
    {
        /** @var AngieModelDatabase $model */
        $model = AModel::getAnInstance('Database', 'AngieModel', array(), $this->container);
        $databasesIni = $model->getDatabasesIni();

        foreach ($databasesIni as $key => $data)
        {
            $data['dbhost'] = '';
            $data['dbuser'] = '';
            $data['dbpass'] = '';
            $data['dbname'] = '';

            $model->setDatabaseInfo($key, $data);
        }

        $model->saveDatabasesIni();

        $this->container->session->set('main.resetdbinfo', true);
    }
}
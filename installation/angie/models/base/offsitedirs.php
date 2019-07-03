<?php
/**
 * @package angi4j
 * @copyright Copyright (C) 2009-2017 Nicholas K. Dionysopoulos. All rights reserved.
 * @author Nicholas K. Dionysopoulos - http://www.dionysopoulos.me
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL v3 or later
 */

defined('_AKEEBA') or die();

class AngieModelBaseOffsitedirs extends AModel
{
    protected $offsiteini = array();

    public function getDirs($associative = false, $force = false)
    {
        if (empty($this->offsiteini))
        {
            if(!$force)
            {
                $this->offsiteini = $this->container->session->get('directories.offsiteini', null);
            }

            if (empty($this->offsiteini))
            {
                $temp     = array();
                $filename = APATH_INSTALLATION . '/eff.ini';

                if (file_exists($filename))
                {
                    $handle   = fopen($filename, 'r');

                    if($handle !== false)
                    {
                        while (($line = fgets($handle)) !== false)
                        {
                            $parts = explode('=', $line);

                            if(count($parts) < 2)
                            {
                                continue;
                            }

                            $parts = str_replace(array("\n", "\r"), '', $parts);
                            $key   = str_replace('external_files/', '', trim($parts[1], '"'));

                            if($associative)
                            {
                                $temp[$key] = array(
                                        'target'  => trim($parts[0], '"'),
                                        'virtual' => trim($parts[1], '"')
                                    );
                            }
                            else
                            {
                                $temp[] = $key;
                            }

                        }
                    }
                }

                $this->offsiteini = $temp;

                $this->container->session->set('directories.offsiteini', $this->offsiteini);
            }
        }

        return $this->offsiteini;
    }

    public function moveDir($key)
    {
        $dirs = $this->getDirs(true, true);
        
        if(!isset($dirs[$key]))
        {
            throw new Exception(AText::_('OFFSITEDIRS_VIRTUAL_DIR_NOT_FOUND'), 0);
        }
        
        $dir  = $dirs[$key];
        $info = $this->input->get('info', array(), 'array');

        $virtual = APATH_ROOT.'/'.$dir['virtual'];
        $target  = str_replace(array('[SITEROOT]', '[ROOTPARENT]'), array(APATH_ROOT, realpath(APATH_ROOT.'/..')), $info['target']);

        if(!file_exists($virtual))
        {
            throw new Exception(AText::_('OFFSITEDIRS_VIRTUAL_DIR_NOT_FOUND'), 0);
        }

        if(!$this->recurse_copy($virtual, $target))
        {
            throw new Exception(AText::_('OFFSITEDIRS_VIRTUAL_COPY_ERROR'), 0);
        }
    }

    protected function recurse_copy($src, $dst)
    {
        $dir = opendir($src);

        if(!is_dir($dst))
        {
            if(!@mkdir($dst, 0755))
            {
                closedir($dir);

                return false;
            }
        }

        while(false !== ( $file = readdir($dir)) )
        {
            if (( $file != '.' ) && ( $file != '..' ))
            {
                if ( is_dir($src . '/' . $file) )
                {
                    if(!$this->recurse_copy($src . '/' . $file, $dst . '/' . $file))
                    {
                        closedir($dir);

                        return false;
                    }
                }
                else
                {
                    if(!copy($src . '/' . $file, $dst . '/' . $file))
                    {
                        closedir($dir);

                        return false;
                    }
                }
            }
        }

        closedir($dir);

        return true;
    }
}
<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine;

class View
{
    private $_sPath;
    private $_sOutput = ''; // Default Output value
    private $_sExt = '.tpl.php'; // Defaut Template extension

    public function __construct($sDir)
    {
        $sPath =  realpath($sDir);
        if (is_dir($sPath))
            $this->_sPath = $sPath;
        else
            throw new \Exception('The "' . $sPath . '" path doesn\'t exist');
    }

    public function set($sFile)
    {
        $sFullPath = $this->_sPath . '/' . $sFile . $this->_sExt;
        if (is_file($sFullPath))
        {
            ob_start();
            require $sFullPath;
            $this->_sOutput .= ob_get_contents();
            ob_end_clean();

            return $this;
        }
        else
            throw new \Exception('The "' . $sFullPath . '" file doesn\'t exist');
    }

    /**
     * Returns the Output to display on the Web browser.
     *
     * @return string
     */
    public function output()
    {
        echo $this->_sOutput;
    }

    /**
     * Set variables for the template views.
     *
     *@param string $sKey The Key name.
     *@param mixed $mVal The value to set.
     * @return void
     */
    public function __set($sKey, $mVal)
    {
        $this->$sKey = $mVal;
    }
}
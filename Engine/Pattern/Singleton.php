<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\Pattern;

trait Singleton
{
    use Stic;

    protected static $_oInstance = null;

    /**
     * Get instance of class.
     *
     * @access public
     * @static
     * @return object Return the instance class or create first instance of the class.
     */
    public static function getInstance()
    {
        return (null === static::$_oInstance) ? static::$_oInstance = new static : static::$_oInstance;
    }
    
    /**
     * Directly call "static::getInstance()" method when the object is called as a function.
     * This is of couse optional (especially for that Daft.ie Free Search project). However, it can be sometime useful, especially in big projects...
     */
    public function __invoke()
    {
        return static::getInstance();
    }
    
    /**
     * Private serialize/unserialize method to prevent serializing/unserializing.
     */
    private function __wakeup() {}
    private function __sleep() {}
}
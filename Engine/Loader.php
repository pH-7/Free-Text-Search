<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine;

// First off, include necessary Pattern classes
require_once __DIR__ . '/Pattern/Stic.php';
require_once __DIR__ . '/Pattern/Singleton.php';

class Loader
{
    use \FreeTextSearch\Engine\Pattern\Singleton; // Thanks PHP Traits (PHP >= 5.4), I don't duplicate pattern code ;-)

    public function init()
    {
        // I register the "_loadClasses" method
        spl_autoload_register(array(__CLASS__, '_loadClasses'));
    }

    private function _loadClasses($sClass)
    {
        // Remove namespace and backslash
        $sClass = str_replace(array(__NAMESPACE__, 'FreeTextSearch', '\\', '//'), '/', $sClass);

        // First off, find in the Engine folder
        if (is_file(__DIR__ . '/' . $sClass . '.php'))
            require_once __DIR__ . '/' . $sClass . '.php';

        // Then, find in the root folder
        if (is_file(dirname(__DIR__) . '/' . $sClass . '.php'))
            require_once dirname(__DIR__) . '/' . $sClass . '.php';
    }

}
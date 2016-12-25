<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine;

class Str
{
    // Include the Static Trait, because it is a Static class (there are only static methods).
    use \FreeTextSearch\Engine\Pattern\Stic;

    /**
     * Escape string with htmlspecialchars() PHP function.
     *
     * @param string $sVal
     * @param boolean $bStrip Default FALSE
     * @return string
     */
     public static function escape($sVal, $bStrip = false)
     {
        return ($bStrip) ? strip_tags($sVal) : htmlspecialchars($sVal, ENT_QUOTES);
     }
}

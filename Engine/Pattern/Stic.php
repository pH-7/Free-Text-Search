<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\Pattern;

/**
 * Concerning the trait name, I use "Stic" and not "Static", because "static" is a reseved PHP keyword.
 */
trait Stic
{
    /**
     * Pivate Constructor & Cloning to prevent direct creation of object and blocking cloning.
     */
    final private function __construct() {}
    final private function __clone() {}
}
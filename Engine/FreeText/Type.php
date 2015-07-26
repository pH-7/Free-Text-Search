<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText;

/**
 * Interface with the predefined methods for the Type classes.
 */
interface Type
{
    /**
     * @array $aVal Searched Terms
     * @array Daft Parameters.
     */
    public function __construct(array $aVals, array $aParms);
    
    /**
     * @return boolean TRUE if validated, FALSE otherwise.
     */
    public function check();
    
    /**
     * @mixed (integer, string, array, ...) The value to get.
     */
    public function get();
}
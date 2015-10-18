<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText\Type;

class Bedroom implements \FreeTextSearch\Engine\FreeText\Type
{
    private $_aBeds = []; // Short PHP 5.4 Array Syntax
    private $_bValidated = false;
    private $_aTerms = ['bed', 'beds', 'bedroom', 'bedrooms']; // Short PHP 5.4 Array Syntax

    /**
     * Find bedrooms between 0 and 9 (what it should be the number of rooms...)
     */
   public function __construct(array $aVals, array $aParms)
   {
        foreach ($this->_aTerms as $sTerm)
        {
            if ($iNum = array_search($sTerm, $aVals))
            {
                if(!empty($aVals[$iNum-1]) && is_numeric($aVals[$iNum-1]) && preg_match('#\b[0-9]{1}\b#', $aVals[$iNum-1]))
                {
                    $this->_aBeds[] = $aVals[$iNum-1];
                    $this->_bValidated = true;

                    /*
                     * For multiple numbers (e.g., "Looking for '2' or '3' bedrooms apartment to buy").
                     */
                    if (isset($aVals[$iNum-2], $aVals[$iNum-3]) && preg_match('#\b[0-9]{1}\b#', $aVals[$iNum-3]))
                        $this->_aBeds[] = $aVals[$iNum-3]; // Push the new bedroom amount into the array ("[]" operator is nicer and even faster than array_push() ...)
                }
            }
        }
   }

   /**
    * @return boolean TRUE if "bed" terms search has been found, FALSE otherwise.
    */
   public function check()
   {
        return $this->_bValidated;
   }

   /**
    * Get the number of bedrooms (always returns the minimums number even if there is more than one amount).
    *
    * @return integer
    */
   public function get()
   {
        return min($this->_aBeds);
   }

   /**
    * If there was two amounts of bedroom specified, returns the maximum one, returns FALSE otherwise.
    *
    * @return mixed (integer|boolean)
    */
   public function getMax()
   {
        return (count($this->_aBeds) > 1) ? max($this->_aBeds) : false;
   }
}
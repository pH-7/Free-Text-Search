<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText\Type;

class Price implements \FreeTextSearch\Engine\FreeText\Type
{
    private $_aPrices = []; // PHP 5.4 Array syntax
    private $_bValidated = false;
    private $_iMinAmount = 80; // The Minimum price for a property
    private $_aTerms = ['euro', 'euros', 'eur', '€']; // PHP 5.4 Array syntax

    /**
     * Find prices in a input string.
     */
   public function __construct(array $aVals, array $aParms)
   {
        /*
         * This first "Foreach" loop is optional in most cases, it is useful only if the user specify the euro currency for the price.
         */
        foreach ($this->_aTerms as $sTerm)
        {
            if ($iNum = array_search($sTerm, $aVals))
            {
                if(!empty($aVals[$iNum-1]) && is_numeric($aVals[$iNum-1]) && settype($aVals[$iNum-1], 'int') >= $this->_iMinAmount && preg_match('#\b[0-9]{2,}\b#', $aVals[$iNum-1]))
                {
                    $this->_aPrices[] = $aVals[$iNum-1];
                    $this->_bValidated = true;

                    /*
                     * For multiple numbers (e.g., "flat between '400' and '800' euros to let").
                     */
                    if (isset($aVals[$iNum-2], $aVals[$iNum-3]) && settype($aVals[$iNum-3], 'int') >= $this->_iMinAmount && preg_match('#\b[0-9]{2,}\b#', $aVals[$iNum-3]))
                        $this->_aPrices[] = $aVals[$iNum-3];
                }
                /* Basicaly only for "€" which is before the amount */
                elseif(!empty($aVals[$iNum+1]) && is_numeric($aVals[$iNum+1]) && settype($aVals[$iNum+1], 'int') >= $this->_iMinAmount && preg_match('#\b[0-9]{2,}\b#', $aVals[$iNum+1]))
                {
                    $this->_aPrices[] = $aVals[$iNum+1];
                    $this->_bValidated = true;
                }
            }
        }

        /* If the user didn't specify the "euro" currency... */
        if (!$this->_bValidated)
        {
            foreach ($aVals as $sVal)
            {
                if(is_numeric($sVal) && settype($sVal, 'int') >= $this->_iMinAmount && preg_match('#\b[0-9]{2,}\b#', $sVal))
                {
                    $this->_aPrices[] = $sVal;
                    $this->_bValidated = true;
                }
            }
        }
   }

   /**
    * @return boolean TRUE if a "price" terms search has been found, FALSE otherwise.
    */
   public function check()
   {
        return $this->_bValidated;
   }

   /**
    * Get the price (always the minimum one even if there is more than one...).
    *
    * @return integer
    */
   public function get()
   {
        return min($this->_aPrices);
   }

   /**
    * If there was more than one price specidied, returns the maximum one, returns FALSE otherwise.
    *
    * @return mixed (integer|boolean)
    */
   public function getMax()
   {
        return (count($this->_aPrices) > 1) ? max($this->_aPrices) : false;
   }
}
<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */
 
namespace FreeTextSearch\Engine\FreeText;

/**
 * Abstract class to search keywords in the search terms.
 * The class must be inherited and contain the "$aTerms" attribute" including keywords to to match with the search terms.
 */
abstract class Looking
{
    protected $sTerm;
    protected $bValidated = false;
    
    /**
     * Check if someone is looking for something to ...
     */
   public function __construct(array $aVals, array $aParms)
   {
        foreach ($this->aTerms as $sTerm)
        {
            if ($iNum = array_search($sTerm, $aVals))
            {
                $this->sTerm = $aVals[$iNum];
                $this->bValidated = true;
                break;
            }
        }
   }
   
   /**
    * @return boolean TRUE if the term search has been found, FALSE otherwise.
    */
   public function check()
   {
        return $this->bValidated;
   }
   
   /**
    * Return the exact searched term.
    *
    * @return string
    */
   public function get()
   {
        return $this->sTerm;
   }
}
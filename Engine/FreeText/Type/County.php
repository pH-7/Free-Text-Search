<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText\Type;

class County implements \FreeTextSearch\Engine\FreeText\Type
{
    protected $sVal;
    protected $bValidated = false;

    /**
     * Search counties using the Daft API.
     */
   public function __construct(array $aVals, array $aParms)
   {
        $oAreas = $aParms['api_obj']->areas(array(
            'api_key' => $aParms['api_key'],
            'area_type' => 'county'
        ));

        $this->looking($oAreas, $aVals);
   }

   /**
    * Check if the location entered matches with the location list from Daft API.
    *
    * @param object $aAreas Daft Api's elements.
    * @param array $aVals
    * @return void
    */
   public function looking($oAreas, array $aVals)
   {
        foreach ($oAreas->areas as $oArea)
        {
            // "_clean()" makes the "location string" from the API lowercase ($aVals in already lowercase from Parser class).
            $sLocation = $this->clean($oArea->name);

            if ($iNum = array_search($sLocation, $aVals))
            {
                $this->sVal = $aVals[$iNum];
                $this->bValidated = true;
                break;
            }
        }
   }

   /**
    * @return boolean Returns TRUE if the location entered has been found in the API list, FALSE otherwise.
    */
   public function check()
   {
        return $this->bValidated;
   }

   /**
    * @return string The areas
    */
   public function get()
   {
        return $this->sVal;
   }

   /**
    * Makes the string lowercase (for areas & counties) and removes "co. " (for counties only).
    *
    * @return string The value cleared.
    */
   protected function clean($sVal)
   {
        $sVal = strtolower($sVal); // For counties and areas
        return str_replace('co. ', '', $sVal); // For counties
   }
}
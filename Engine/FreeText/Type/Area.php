<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText\Type;

class Area extends County implements \FreeTextSearch\Engine\FreeText\Type
{
    /**
     * Search areas using the Daft API.
     */
   public function __construct(array $aVals, array $aParms)
   {
        $oAreas = $aParms['api_obj']->areas(array(
            'api_key' => $aParms['api_key'],
            'area_type' => 'area'
        ));

        $this->looking($oAreas, $aVals);
   }
}
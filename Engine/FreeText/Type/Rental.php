<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText\Type;
use FreeTextSearch\Engine\FreeText as FT;

class Rental extends FT\Looking implements FT\Type
{
    /**
     * @var array Searched term used for rental properties.
     */
    protected $aTerms = ['rental', 'let', 'letting', 'rent', 'renting'];
}
<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Controller;

use FreeTextSearch\Engine as E;

abstract class Controller
{
    protected $oView;
    
    public function __construct()
    {
        $this->oView = new E\View(dirname(__DIR__) . '/View/');
        $this->oView->sTitle = E\Config::SITE_NAME;    
    }   
}
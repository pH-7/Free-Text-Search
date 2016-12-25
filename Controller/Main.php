<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Controller;

use FreeTextSearch\Engine as E;
use FreeTextSearch\Engine\FreeText\Parser;

class Main extends Controller
{
    public function index()
    {
        /** Display the view **/
        $this->oView->set('inc/header')->set('search_form')->set('inc/footer')->output();
    }

    public function result()
    {
        // If someone has made a search request
        if (!empty($_GET['free_text']))
        {
            /** Initialization of the Parser class */
            $sFreeText = E\Str::escape($_GET['free_text']);
            $oParser = new Parser($sFreeText, E\Config::DAFT_API_KEY);
            $this->oView->mSearch = $oParser->search();
            $this->oView->aParamResults = $oParser->getParms();
        }

        $this->oView->set('inc/header')->set('result')->set('inc/footer')->output();
    }

    public function notFound()
    {
        $this->oView->set('inc/header')->set('not_found')->set('inc/footer')->output();
    }
}
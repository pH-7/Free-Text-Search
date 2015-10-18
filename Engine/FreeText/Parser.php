<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

namespace FreeTextSearch\Engine\FreeText;

class Parser
{
    private $_sSentence;
    private $_sApiKey;
    private $_oDaftApi;

    public function __construct($sSentence, $sApiKey)
    {
        $this->_sSentence = $sSentence;
        $this->_sApiKey = $sApiKey;

        $this->init();
    }

    /**
     * Returns all Daft Parameters necessaried for the API.
     *
     * @return array
     */
    public function getParms()
    {
        $this->clean(); // Clean the "$this->_sSentence" input string data

        $aRet = ['input_string' => $this->_sSentence]; // First, define the return array
        $aWords = explode(' ', $this->_sSentence);

        $aTypes = $this->getTypes();
        $sNS = '\FreeTextSearch\Engine\FreeText\Type\\'; // The namepsaces of Type classes

        foreach($aTypes as $sType)
        {
            $sClassName = $sNS . $sType;
            $oMatcher = new $sClassName($aWords, ['api_obj' => $this->_oDaftApi, 'api_key' => $this->_sApiKey]);

            if ($oMatcher->check())
            {
                switch ($sType)
                {
                    case 'Sale':
                        $aRet['sale'] = $oMatcher->get(); // Set the value of the type into the array (like all other bellow)
                    break;

                    case 'Rental':
                        $aRet['rent'] = $oMatcher->get();
                    break;

                    case 'Property':
                        $aRet['property_type'] = $oMatcher->get();
                    break;

                    case 'HouseType':
                        $aRet['house_type'] = $oMatcher->get();
                    break;

                    case 'County':
                        $aRet['counties'] = $oMatcher->get();
                    break;

                    case 'Area':
                        $aRet['areas'] = $oMatcher->get();
                    break;

                    case 'Price':
                    {
                        // Always stored functions value into variables (like $mMaxPrice too) in order to optimized the script
                        $iMinPrice = $oMatcher->get();

                        if ($mMaxPrice = $oMatcher->getMax()) // There is more than one price specified
                        {
                            $aRet['min_price'] = $iMinPrice;
                            $aRet['max_price'] = $mMaxPrice;
                        }
                        else
                        {
                            $aRet['min_price'] = $iMinPrice;
                            $aRet['max_price'] = $iMinPrice;
                        }
                    }

                    case 'Bedroom':
                    {
                        $iMinBed = $oMatcher->get();
                        $mMaxBed = $oMatcher->getMax();

                        if ($mMaxBed && $iMinBed >= 10) // Bed amount must be under 10
                            break;

                        if ($mMaxBed) // There is more than one bedroom specified
                        {
                            $aRet['min_bedrooms'] = $iMinBed;
                            $aRet['max_bedrooms'] = $mMaxBed;
                        }
                        else
                            $aRet['bedrooms'] = $iMinBed;

                        // Clear value
                        if (isset($aRet['min_bedrooms'], $aRet['max_bedrooms']))
                            unset($aRet['bedrooms']);
                    }
                }
            }
        }

        return $aRet;
    }

    /**
     * Returns the API elements in object if there is a property to rental or sale, returns FALSE otherwise.
     *
     * @return mixed (object|boolean)
     */
    public function search()
    {
        $aDaftParms = $this->getParms();

        if (!empty($aDaftParms['rent']) && is_string($aDaftParms['rent']))
            $sApiMethodName = 'search_rental';
        elseif (!empty($aDaftParms['sale']) && is_string($aDaftParms['sale']))
            $sApiMethodName = 'search_sale';
        else
            return false; // Stop the method

        unset($aDaftParms['sale'], $aDaftParms['rent'], $aDaftParms['input_string']); // First, I removed the array keys incompatible with Daft API

        return $this->_oDaftApi->$sApiMethodName(['api_key' => $this->_sApiKey, 'query' => $aDaftParms]);
    }

    /**
     * Initialization and creating a new SOAP object.
     *
     * @return void
     */
    protected function init()
    {
        /* First off, it is usually a good idea to check if external PHP extensions are installed
         (for example, when we move to another host, the extension could no longer exist...) */
        if (!class_exists('SOAPClient'))
            exit( sprintf('The class %s requires PHP SOAPClient.', get_class()) );

        $this->_oDaftApi = new \SoapClient('http://api.daft.ie/v2/wsdl.xml', ['features' => SOAP_SINGLE_ELEMENT_ARRAYS]); // PHP 5.4 Array Syntax "[]"
    }

    /**
     * Cleans the input string and makes the string lowercase.
     *
     * @return void
     */
    protected function clean()
    {
        $this->_sSentence = strtolower(\FreeTextSearch\Engine\String::escape($this->_sSentence, true));
    }

    protected function getTypes()
    {
        $aTypes = glob(__DIR__ . '/Type/*.php');

        /* PHP 5.3 lambda (anonymous) function */
        return array_map(
            function($sVal)
            {
                return str_replace(array(__DIR__ . '/Type/', '.php'), '', $sVal);
            }, $aTypes);
    }
}
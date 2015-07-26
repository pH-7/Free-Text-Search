<?php
/**
 * @author           Pierre-Henry Soria <pierrehenrysoria@gmail.com>
 * @copyright        (c) 2015, Pierre-Henry Soria. All Rights Reserved.
 * @license          CC-BY - http://creativecommons.org/licenses/by/3.0/
 * @link             http://hizup.uk
 */

// Hey there! Be careful, the script requires PHP 5.4 or higher ;-)
namespace FreeTextSearch;
use FreeTextSearch\Engine as E;

/* Check if the current PHP version us compatible with the script */
if (version_compare(PHP_VERSION, '5.4.0', '<'))
    exit('Whoops! Your PHP version is ' . PHP_VERSION . '. The script requires PHP 5.4 or higher.');
    
try
{
    require __DIR__ . '/Engine/Loader.php';
    E\Loader::getInstance()->init(); // Loads necessary classes
    
    $aParams = ['ctrl' => (!empty($_GET['p']) ? $_GET['p'] : 'main'), 'act' => (!empty($_GET['a']) ? $_GET['a'] : 'index')]; // I use the new PHP 5.4 short array syntax
    E\Router::run($aParams);
}
catch (\Exception $oE)
{
    echo $oE->getMessage();
}
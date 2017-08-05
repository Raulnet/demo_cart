<?php
/**
 * Created by PhpStorm.
 * User: raulnet
 * Date: 01/08/17
 * Time: 19:51
 */

define ('ROOT', realpath(dirname(__FILE__) . '/../') . '/');
function autoloadItemsClass($sClassName)
{
    $sFilePath = str_replace("\\", "/", ROOT . 'src/' . $sClassName . '.php');
    $sFilePath = realpath($sFilePath);
    if (is_file($sFilePath)) {
        require_once $sFilePath;
    } else {
        die ('class not found ' . $sClassName);
    }
}
spl_autoload_register('autoloadItemsClass');

$data = "banana";

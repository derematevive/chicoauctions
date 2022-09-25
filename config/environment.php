<?php
/**
* 2022 Chico-Auction
*
* NOTICE OF LICENSE
*
*  This source file is subject to the Open Software License (OSL 3.0)
*  that is bundled with this package in the file LICENSE.txt.
*  It is also available through the world-wide-web at this URL:
*  @See : https://opensource.org/licenses/OSL-3.0
*
*  @author : Walter E. Hernandez derematevive@gmail.com
*  @copyright : 2022 DeRemateVive SA
*  @See : https://www.derematevive.com
*  @license : https://opensource.org/licenses/OSL-3.0
*  International Registered Trademark & Property of DeRemateVive
*/

if (!defined('CONTROL_FILE')) {
    exit;
}

switch (ENVIRONMENT) {
    case '1':
        error_reporting(-1);
        ini_set('display_errors', 1);
    break;
    case '0':
        ini_set('display_errors', 0);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
    break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        exit('El entorno de la aplicación no está configurado correctamente.');
}

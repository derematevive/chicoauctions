<?php
/**
* 2022 Chico-Auction
*
* NOTICE OF LICENSE
*
*  This source file is subject to the Open Software License (OSL 3.0)
*  that is bundled with this package in the file LICENSE.txt.
*  It is also available through the world-wide-web at this URL:
*  https://opensource.org/licenses/OSL-3.0
*
*  @author : Walter E. Hernandez derematevie@gmail.com
*  @copyright : 2022 DeRemateVive SA
*  @license    https://opensource.org/licenses/OSL-3.0
*  International Registered Trademark & Property of DeRemateVive SA
*/

ob_start();

if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
    header('X-Frame-Options: sameorigin');
    header('X-XSS-Protection: 1; mode=block');
    header('X-Content-Type-Options: nosniff');
    header_remove('x-powered-by');
    header('Cache-control: private');
}

require(dirname(__FILE__).'/config/defines.php');

/** implementar load app
$app = ob_get_clean();

$app = new App;
*/

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
*  @license : https://opensource.org/licenses/OSL-3.0
*  International Registered Trademark & Property of DeRemateVive  https://www.derematevive.com
*/

if (!defined('CONTROL_FILE')) {
    exit;
}

/**
 * @NOTE definir prefix desde install
 * TODO CREATE INSTALL DIR AND FILE
 *
 */
$db = new MysqliDb(array(
    'host' => 'localhost',
    'username' => '----root----',
    'password' => '*****',
    'db' => 'base',
    'port' => '3306',
    'prefix' => 'au_',
    'charset' => 'UTF-8'
));

global $db;

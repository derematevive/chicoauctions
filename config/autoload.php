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

set_include_path(
    get_include_path()
    .NOT_SCANDIR.PS.CLASSES_DIR
    .NOT_SCANDIR.PS.MODELS_DIR
    .NOT_SCANDIR.PS.CORE_DIR
);

spl_autoload_extensions('.classes.php,.models.php,.core.php');

$autoload = spl_autoload_functions();

if ($autoload === false) {
    spl_autoload_register();
} elseif (!in_array('spl_autoload', $autoload)) {
    spl_autoload_register('spl_autoload');
}

dbObject::autoload();

require_once(VENDOR_DIR.'autoload.php');

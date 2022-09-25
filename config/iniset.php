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

@ini_set('mbstring.internal_encoding', DEFAULT_CHARSET);
@ini_set('iconv.internal_encoding', DEFAULT_CHARSET);
@ini_set('upload_max_filesize', '20M');
@ini_set('precision', '14');
@ini_set('expose_php', 'Off');
@ini_set('display_errors', 'On');
@ini_set('safe_mode', 'On');
@ini_set('default_charset', DEFAULT_CHARSET);
@ini_set("session.use_trans_sid", 'Off');
@ini_set('memory_limit', '64M');
@ini_set('session.cookie_lifetime', '0');
@ini_set('session.hash_function', 'sha256');
@ini_set('session.use_cookies', 'On');
@ini_set('session.use_only_cookies', 'On');
@ini_set('session.use_strict_mode', 'On');
@ini_set('session.cookie_httponly', 'On');
@ini_set('session.cache_limiter', 'nocache');
@ini_set('session.use_strict_mode', 1);

@ini_set('session.name', Encryptor::hasSimple(
    'md5',
    Helper::getVisitorIp().Configuration::getVal('INI_SET_KEY')
));

@ini_set('session.cookie_secure', 'On');
/** @ini_set('output_buffering', 'Off'); */

@ini_set('session.cookie_samesite', 'Strict');

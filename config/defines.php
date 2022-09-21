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

define('CONTROL_FILE', '4333');
define('THIS_PATH', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('PSS', PHP_SHLIB_SUFFIX);
define('DEFAULT_CHARSET', 'UTF-8');
define('NOT_SCANDIR', '.');

/**
 *  php_uname(string $mode = "a"): string
 *  NOTE or change for /../getcwd()
 *  @See https://www.php.net/manual/en/function.getcwd.php
 */
/**
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
*/
define('ROOT_DIR', realpath(THIS_PATH.DS.'..').DS);
/**
} elseif (PHP_OS === 'Linux') {
   define('ROOT_DIR', realpath(NOT_SCANDIR).DS);
} else {
    define('ROOT_DIR', realpath(getcwd().'/../'));
}
*/

define('CACHE_DIR', ROOT_DIR.'cache'.DS);
define('CLASSES_DIR', ROOT_DIR.'classes'.DS);
define('THEMES_DIR', ROOT_DIR.'themes'.DS);
define('CONTROLLERS_DIR', ROOT_DIR.'controllers'.DS);
define('CORE_DIR', ROOT_DIR.'core'.DS);
define('CONFIG_DIR', ROOT_DIR.'config'.DS);
define('MODELS_DIR', ROOT_DIR.'models'.DS);
define('TEMP_DIR', ROOT_DIR.'temps'.DS);
define('VENDOR_DIR', ROOT_DIR.'vendor'.DS);
/** translations */
define('I18N_DIR', ROOT_DIR.'i18n'.DS);
define('UPLOADS_DIR', ROOT_DIR.'uploads'.DS);
define('ADDONS_DIR', ROOT_DIR.'addons'.DS);
define('DOWNLOADS_DIR', ROOT_DIR.'downloads'.DS);
define('MEDIA_DIR', ROOT_DIR.'media'.DS);

define('ASSETS_DIR', ROOT_DIR.'assets'.DS);
define('CSS_DIR', ASSETS_DIR.'css'.DS);
define('JS_DIR', ASSETS_DIR.'js'.DS);
define('IMG_DIR', ASSETS_DIR.'img'.DS);
define('FONTS_DIR', ASSETS_DIR.'fonts'.DS);
define('PLUGINS_CSS_DIR', CSS_DIR.'plugins'.DS);
define('PLUGINS_JS_DIR', CSS_DIR.'plugins'.DS);

require_once(CONFIG_DIR.'autoload.php');
require_once(CONFIG_DIR.'datadb.php');

/**
 * @NOTE AUTO LOAD MODELS FILE
 * @see CREATE DOC
 */
define('DEFAULT_LANG', (int)Configuration::defaultLang());

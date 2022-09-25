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
*  @author : Walter E. Hernandez derematevive@gmail.com
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


define('DEFAULT_LANG', (int)Configuration::defaultLang());
define('THEME_DEFAULT', (string)Configuration::getVal('THEME_DEFAULT'));
define('SITE_NAME', (string)Configuration::getVal('SITE_NAME'));
define('ENVIRONMENT', (int)Configuration::getVal('ENVIRONMENT_ACTIVE', DEFAULT_LANG));

require_once(CONFIG_DIR.'environment.php');
include_once(CONFIG_DIR.'iniset.php');

define('THEME_FRONT_DIR', THEMES_DIR.THEME_DEFAULT.DS);
define('TEMPLATES_FRONT', THEME_FRONT_DIR.'templates'.DS);
define('THEME_IMG_FRONT', THEME_FRONT_DIR.'img'.DS);
define('THEME_CSS_FRONT', THEME_FRONT_DIR.'css'.DS);
define('THEME_JS_FRONT', THEME_FRONT_DIR.'js'.DS);
define('THEME_I18N_FRONT', THEME_FRONT_DIR.'i18n'.DS);

define('THEME_MODIFIED_DIR', THEME_FRONT_DIR.'override'.DS);
define('MODIFIED_ADDONS_DIR', THEME_MODIFIED_DIR.'addons'.DS);

include_once(CONFIG_DIR.'smarty.php');

define('LINK_URL', Helper::createUrl());
define('ADDONS_URL', LINK_URL.'addons/');
define('URL_ASSETS', LINK_URL.'assets/');
define('URL_CSS', URL_ASSETS.'css/');
define('URL_JS', URL_ASSETS.'js/');
define('URL_IMG', URL_ASSETS.'img/');
define('URL_FONTS', URL_ASSETS.'fonts/');
define('URL_ICONS', URL_ASSETS.'icons/');
define('URL_CSS_PLUGINS', URL_CSS.'plugins/');
define('URL_JS_PLUGINS', URL_JS.'plugins/');

define('URL_I18N', LINK_URL.'i18n/');
define('URL_IMG_I18N', URL_I18N.'img/');

define('URL_THEME', LINK_URL.'themes/'.THEME_DEFAULT.'/');
define('URL_TEMPLATES', URL_THEME.'templates/');

define('URL_THEME_CSS', URL_THEME.'css/');
define('URL_THEME_JS', URL_THEME.'js/');
define('URL_THEME_IMG', URL_THEME.'img/');
define('URL_THEME_FONTS', URL_THEME.'fonts/');
define('URL_THEME_SVG', URL_THEME.'svg/');
define('URL_THEME_I18N', URL_THEME.'i18n/');

define('MODE_BOOTSTRAP_BUNDLE', (int)Configuration::getVal('MODE_BOOTSTRAP_BUNDLE'));

/** @NOTE : test gettype(mixed $var): string */
define('BOOTSTRAP_VERSION', (string)Configuration::getVal('BOOTSTRAP_VERSION'));
define('ANIMATE_CSS_VERSION', (string)Configuration::getVal('ANIMATE_CSS_VERSION'));
define('JQUERY_UI_VERSION', (string)Configuration::getVal('JQUERY_UI_VERSION'));
define('OWLCAROUSEL_VERSION', (string)Configuration::getVal('OWLCAROUSEL_VERSION'));
define('JQUERY_VERSION', (string)Configuration::getVal('JQUERY_VERSION'));

define('POPPER_VERSION', (string)Configuration::getVal('POPPER_VERSION'));
define('BOOTSTRAP_ICONS_VERSION', (string)Configuration::getVal('BOOTSTRAP_ICONS_VERSION'));
define('FONTAWESOME_VERSION', (string)Configuration::getVal('FONTAWESOME_VERSION'));

define('BOOTSTRAP_CSS', URL_CSS.'bootstrap/'.BOOTSTRAP_VERSION.'/');
define(
    'INTEGRITY_BOOTSTRAP_CSS',
    CSS_DIR.'bootstrap'.DS.BOOTSTRAP_VERSION.DS
);

define('BOOTSTRAP_ICONS', URL_FONTS.'bootstrap-icons/'.BOOTSTRAP_ICONS_VERSION.'/bootstrap-icons.css');
define(
    'INTEGRITY_BOOTSTRAP_ICONS',
    Encryptor::integrity384(
        FONTS_DIR.'bootstrap-icons'.DS.BOOTSTRAP_ICONS_VERSION.DS.'bootstrap-icons.css'
    )
);

define('FONTAWESOME_CSS', URL_FONTS.'fontawesome/'.FONTAWESOME_VERSION.'/css/all.min.css');
define(
    'INTEGRITY_FONTAWESOME_CSS',
    Encryptor::integrity384(
        FONTS_DIR.'fontawesome'.DS.FONTAWESOME_VERSION.DS.'css'.DS.'all.min.css'
    )
);

define('ANIMATE_CSS', URL_CSS.'animate-css/'.ANIMATE_CSS_VERSION.'/animate.min.css');
define(
    'INTEGRITY_ANIMATE_CSS',
    Encryptor::integrity384(
        CSS_DIR.'animate-css'.DS.ANIMATE_CSS_VERSION.DS.'animate.min.css'
    )
);

define('JQUERY_UI_CSS', URL_CSS.'jquery-ui/'.JQUERY_UI_VERSION.'/jquery-ui.min.css');
define(
    'INTEGRITY_JQUERY_UI_CSS',
    Encryptor::integrity384(
        CSS_DIR.'jquery-ui'.DS.JQUERY_UI_VERSION.DS.'jquery-ui.min.css'
    )
);

define('OWLCAROUSEL_CSS', URL_CSS.'owlcarousel/'.OWLCAROUSEL_VERSION.'/owl.carousel.min.css');
define('OWLCAROUSEL_THEME_CSS', URL_CSS.'owlcarousel/'.OWLCAROUSEL_VERSION.'/owl.theme.default.min.css');
define(
    'INTEGRITY_OWLCAROUSEL_CSS',
    Encryptor::integrity384(
        CSS_DIR.'owlcarousel'.DS.OWLCAROUSEL_VERSION.DS.'owl.carousel.min.css'
    )
);
define(
    'INTEGRITY_OWLCAROUSEL_THEME_CSS',
    Encryptor::integrity384(
        CSS_DIR.'owlcarousel'.DS.OWLCAROUSEL_VERSION.DS.'owl.theme.default.min.css'
    )
);

define('SWEETALERT_CSS', URL_CSS.'sweetalert/sweetalert.css');
define('INTEGRITY_SWEETALERT_CSS', Encryptor::integrity384(CSS_DIR.'sweetalert'.DS.'sweetalert.css'));

/** js loads */
define('POPPER_JS', URL_JS.'popper/'.POPPER_VERSION.'/popper.min.js');
define(
    'INTEGRITY_POPPER_JS',
    Encryptor::integrity384(JS_DIR.'popper'.DS.POPPER_VERSION.DS.'popper.min.js')
);

define('BOOTSTRAP_JS', URL_JS.'bootstrap/'.BOOTSTRAP_VERSION.'/bootstrap.min.js');
define(
    'INTEGRITY_BOOTSTRAP_JS',
    Encryptor::integrity384(JS_DIR.'bootstrap'.DS.BOOTSTRAP_VERSION.DS.'bootstrap.min.js')
);

define('BOOTSTRAP_BUNDLE', URL_JS.'bootstrap/'.BOOTSTRAP_VERSION.'/bootstrap.bundle.min.js');
define(
    'INTEGRITY_BOOTSTRAP_BUNDLE',
    Encryptor::integrity384(JS_DIR.'bootstrap'.DS.BOOTSTRAP_VERSION.DS.'bootstrap.bundle.min.js')
);

define('JQUERY_JS', URL_JS.'jquery/'.JQUERY_VERSION.'/jquery-'.JQUERY_VERSION.'.min.js');
define(
    'INTEGRITY_JQUERY_JS',
    Encryptor::integrity384(JS_DIR.'jquery'.DS.JQUERY_VERSION.DS.'jquery-'.JQUERY_VERSION.'.min.js')
);

define('SWEETALERT_JS', URL_JS.'sweetalert/sweetalert.min.js');
define(
    'INTEGRITY_SWEETALERT_JS',
    Encryptor::integrity384(JS_DIR.'sweetalert'.DS.'sweetalert.min.js')
);

define('OWLCAROUSEL_JS', URL_JS.'owlcarousel/'.OWLCAROUSEL_VERSION.'/owl.carousel.min.js');
define(
    'INTEGRITY_OWLCAROUSEL_JS',
    Encryptor::integrity384(JS_DIR.'owlcarousel'.DS.OWLCAROUSEL_VERSION.DS.'owl.carousel.min.js')
);

define('JQUERY_UI_JS', URL_JS.'jquery-ui/'.JQUERY_UI_VERSION.'/jquery-ui.min.js');
define(
    'INTEGRITY_JQUERY_UI_JS',
    Encryptor::integrity384(JS_DIR.'jquery-ui'.DS.JQUERY_UI_VERSION.DS.'jquery-ui.min.js')
);

if (!Tools::inputCookie(Encryptor::hasSimple('md5', Helper::getVisitorIp())) || !isset($cookie)) {
    $cookie = new Cookies(Encryptor::hasSimple('md5', Helper::getVisitorIp()));
}

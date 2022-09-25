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

define('SMARTY_RESOURCE_CHAR_SET', DEFAULT_CHARSET);
define('SMARTY_DIR', VENDOR_DIR.'smarty'.DS.'smarty'.DS);
define('LIBS_SMARTY_DIR', SMARTY_DIR.'libs'.DS);
define('SMARTY_PLUGINS_DIR', LIBS_SMARTY_DIR.'plugins'.DS);
define('SMARTY_SYSPLUGINS_DIR', LIBS_SMARTY_DIR.'sysplugins'.DS);
define('ADD_SMARTY_EXTEND_DIR', CONFIG_DIR);
define('CONFIG_SMARTY_DIR', CONFIG_DIR);
define('SMARTY_COMPILE_DIR', CACHE_DIR.'smarty_co'.DS);
define('SMARTY_CACHE_DIR', CACHE_DIR.'smarty_ca'.DS);

$smarty = new Smarty;

global $smarty;

$smarty->setCompileDir(SMARTY_COMPILE_DIR);
$smarty->setCacheDir(SMARTY_CACHE_DIR);
$smarty->setConfigDir(CONFIG_SMARTY_DIR);
$smarty->setTemplateDir(TEMPLATES_FRONT);
$smarty->use_sub_dirs = true;

if (ENVIRONMENT == 1) {
    $smarty->force_compile = true;
    $smarty->debugging = true;
} else {
    $smarty->force_compile = false;
    $smarty->debugging = false;
}

$smarty->debugging_ctrl = ($_SERVER['SERVER_NAME'] == 'localhost') ? 'URL' : 'NONE';
$smarty->compile_check = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;
$smarty->enableSecurity();
$smarty->setEscapeHtml(false);

function minify_html($tpl_output, Smarty_Internal_Template $template)
{
    $tpl_output = preg_replace('![\t ]*[\r\n]+[\t ]*!', ' ', $tpl_output);
    $tpl_output = preg_replace('/>\s+/', '>', $tpl_output);
    $tpl_output = preg_replace('/\s+</', '<', $tpl_output);
    $tpl_output = preg_replace('/>\s+</', '><', $tpl_output);
    $tpl_output = preg_replace('/\s+>/', '>', $tpl_output);
    $tpl_output = preg_replace('/\s+"/', '"', $tpl_output);
    $tpl_output = preg_replace('/="\s+/', '="', $tpl_output);
    return $tpl_output;
}

$smarty->registerFilter('output', 'minify_html');
$smarty->registerPlugin('modifier', 'intval', 'intval');
$smarty->registerPlugin('modifier', 'trim', 'trim');

Helper::smartyRegisterFunction('function', 'home', array('Helper', 'home'));
Helper::smartyRegisterFunction('function', 'createUrl', array('Helper', 'createUrl'));
Helper::smartyRegisterFunction('function', 'translate', array('Translations', 'translateTpl'));

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

class Helper
{
    public static function createUrl() : string
    {
        global $cookie;
        $url = self::getProtocolo().self::composerHost().(self::ctrlDir() ? self::ctrlDir() : '/');
        $url = self::deletIndex($url);
        if (isset($cookie->id_admin) && isset($cookie->admin_dir)) {
            $url = str_replace($cookie->admin_dir.'/', '', $url);
            $url = Filter::filterUrl($url);
        } else {
            $url = Filter::filterUrl($url);

        }
        return Filter::filterUrl($url);
    }

    private static function deletIndex($url)
    {
        if (substr($url, -9) == 'index.php') {
            return str_replace('index.php', '', $url);
        }
        return $url;
    }

    public static function ctrlDir()
    {
        if (strlen(self::isSubDir()) > 3) {
            return self::isSubDir();
        } else {
            return false;
        }
    }

    public static function composerHost() : ? string
    {
        if (Tools::inputServer('HTTP_X_FORWARDED_HOST')) {
            return Filter::filterServer('HTTP_X_FORWARDED_HOST');
        } elseif (Tools::inputServer('HTTP_HOST')) {
            return Filter::filterServer('HTTP_HOST');
        }
        /** @see https://www.php.net/manual/en/function.getenv.php */
        return getenv('HTTP_HOST');
    }

    public static function secureMode() : ? bool
    {
        if (Tools::inputServer('HTTPS')) {
                return Filter::filterServer('HTTPS') == 1 || strtolower(Filter::filterServer('HTTPS') == 'on');
            if (Filter::filterServer('HTTPS') == '1')
                return Tools::inputServer('SSL') == 1 || strtolower(Filter::filterServer('SSL') == 'on');
        }
        return false;
    }

    public static  function getAddress() : string
    {
        $protocol = Tools::inputServer('HTTPS') == 'on' ? 'https' : 'http';
        return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }

    public static function activeSecureMode() : bool
    {
        if ((int)Configuration::getVal('ACTIVE_SECURE_MODE') == '1') {
            return true;
        }
        return false;
    }

    public static function getProtocolo() : string
    {
        if (self::secureMode() && self::activeSecureMode()) {
            return 'https://';
        }
        return 'http://';
    }

    public static function getRealProtocol()
    {
        if (!empty($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] != 'off');
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            $protocol = ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https');
        } elseif (isset($_SERVER['HTTP__WSSC'])) {
            $protocol = ($_SERVER['HTTP__WSSC'] == 'https');
        } else {
            $protocol = false;
        }
        return $protocol ? 'https://' : 'http://';
    }

    public static function cleanStatCache()
    {
        return clearstatcache();
    }

    public static function fileExits($paht_and_file)
    {
        if (file_exists($paht_and_file)) {
            self::cleanStatCache();
            unset($paht_and_file);
            return true;
        }
        self::cleanStatCache();
        unset($paht_and_file);
        return false;
    }

    public static function recursiveFileExists(string $filename, string $directory) : ? bool
    {
        try
        {
            foreach(new recursiveIteratorIterator(new recursiveDirectoryIterator($directory)) as $file) {
                if( $directory.DS.$filename == $file ) {
                    self::cleanStatCache();
                    return true;
                }
            }
            self::cleanStatCache();
            return false;
        }
        catch(Exception $e)
        {
            self::cleanStatCache();
            return false;
        }
    }

    public static function getClientIp()
    {
        foreach([
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_X_CLUSTER_CLIENT_IP',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR'
            ] as $key) {
            if (array_key_exists($key, $_SERVER)) {
                foreach(array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                    if (ENVIRONMENT == '1') {
                        if (!Validate::isIp($ip)) {
                            return false;
                        } else {
                            return $ip;
                        }
                    } else {
                        if (!Validate::isIpNotPrivate($ip)) {
                            return false;
                        } else {
                            return $ip;
                        }
                    }
                }
            }
        }
        return false;
    }

    public static function getIp()
    {
        $ip_adress = false;
        if (Tools::inputServer('HTTP_CLIENT_IP')) {
            $ip_adress = Filter::filterServer('HTTP_CLIENT_IP');
        }
        elseif (Tools::inputServer('HTTP_X_FORWARDED_FOR')) {
            $ip_adress = Filter::filterServer('HTTP_X_FORWARDED_FOR');
        } else {
            $ip_adress = Filter::filterServer('REMOTE_ADDR');
        }
        return !Validate::isIp($ip_adress) ? false : $ip_adress;
    }

    private static function oneSearchIP()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return !Validate::isIp($_SERVER["HTTP_CLIENT_IP"]) ? false : $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return !Validate::isIp($_SERVER["HTTP_X_FORWARDED_FOR"]) ? false : $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return !Validate::isIp($_SERVER["HTTP_X_FORWARDED"]) ? false : $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return !Validate::isIp($_SERVER["HTTP_FORWARDED_FOR"]) ? false : $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return !Validate::isIp($_SERVER["HTTP_FORWARDED"]) ? false : $_SERVER["HTTP_FORWARDED"];
        } else {
            return !Validate::isIp($_SERVER["REMOTE_ADDR"]) ? false : $_SERVER["REMOTE_ADDR"];
        }
    }

    /**
     * NOTE ENVIRONMENT entorno, for mode production use getClientIp() functions.
     */
    public static function getVisitorIp()
    {
        $ip = false;
        if (self::getClientIp()) {
            $ip = self::getClientIp();
        } elseif (self::getIP()) {
            $ip = self::getIP();
        } elseif (self::oneSearchIP()) {
            $ip = self::oneSearchIP();
        } else {
            $ip = '0000';
        }
        return $ip;
    }

    public static function isSubDir()
    {
        if (isset($_SERVER['SCRIPT_NAME']) || !empty($_SERVER['SCRIPT_NAME'])) {
            if (is_dir(Filter::filterServer('SCRIPT_NAME')) ||
                substr(Filter::filterServer('SCRIPT_NAME'), -1) == '/') {
                self::cleanStatCache();
                return Filter::filterServer('SCRIPT_NAME');
            } else {
                return dirname(Filter::filterServer('SCRIPT_NAME')).'/';
            }
        } elseif (isset($_SERVER['REQUEST_URI']) || !empty($_SERVER['REQUEST_URI'])) {
            if (is_dir(Filter::filterServer('REQUEST_URI')) ||
                substr(Filter::filterServer('REQUEST_URI'), -1) == '/') {
                self::cleanStatCache();
                return Filter::filterServer('REQUEST_URI');
            } else {
               return Filter::filterServer('REQUEST_URI').'/';
            }
        } else {
            return false;
        }
    }

    /**
    * @see https://www.smarty.net/docs/en/api.register.plugin.tpl
    *
    */
    public static function smartyRegisterFunction($type, $function, $params)
    {
        global $smarty;
        if (!Validate::isRegisterSmarty($type) ||
            !is_array($params) ||
            !Validate::isFunctionName($function)) {
            unset($type, $function, $params);
            exit;
        }
        $params = Filter::xssFilter($params);
        return $smarty->registerPlugin($type, $function, $params);
    }

    /**
    * @see https://www.smarty.net/docs/en/plugins.modifiers.tpl
    */

    public static function forceInt($value)
    {
        if (/** !array_key_exists('value', $value) || */ !Validate::isIntRange($value , '1', '790')) {
            unset($value);
            return 'NaN';
        } else {
            return (int)trim($value);
        }
    }

    public static function home() : never
    {
        header('location: '.Filter::filterString(self::createUrl()));
        exit();
    }

    public static function displayError(string $code) : never
    {
        global $cookie;
        if (!Validate::isHeaderType($code)) {
            unset($code);
            $code = '500';
        }

        if (!$cookie->get('response')) {
            $cookie->response = (int)$code;
        }

        unset($code);
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('location: '.Filter::filterString(self::createUrl().'error/printerror'));
        exit();
    }

    public static function loginWithCookie() : never
    {
        header('location: '.Filter::filterString(self::createUrl().'signin/loginWithCookie'));
        exit();
    }

    public static function to(string $path) : never
    {
        header('location: '.Filter::filterString(self::createUrl().$path));
        exit();
    }

    public static function toBack() : never
    {
        header('Location: '.getenv('HTTP_REFERER'));
        exit();
    }
}

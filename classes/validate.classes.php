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

class Validate
{
    /**
     * Validate a Gregorian date
     *  checkdate(int $month, int $day, int $year): bool
     * @see https://www.php.net/manual/en/function.checkdate.php
     *
     */
    public static function isGregorianDate(int $month, int $day, int $year) : bool
    {
        return checkdate($month, $day, $year);
    }

    /**
     * admite format ATOMIC = DateTime::ATOM
     * validacion gregorian all format
     */
    public static function allFormDateTime($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /** formato dd-mm-Y */
    public static function datTimG($value)
    {
        return preg_match('/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/', $value);
    }

    public static function isConfigName(string $string) : bool
    {
        return (bool)preg_match('/^[A-Z0-9-_]{3,28}$/s', $string);
    }

    public static function isFileName(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-zA-Z0-9_.-]{4,21}$/'
                )
            )
        );
    }

    public static function isHookName(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-zA-Z]{2,28}$/'
                )
            )
        );
    }

    public static function isPasswd(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[.a-zA-Z_0-9-!@#$%\^&*()¿=?€]{6,12}$/'
                )
            )
        );
    }

    public static function isAddonsName(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-zA-Z0-9_-]{4,20}$/'
                )
            )
        );
    }

    public static function isFunctionName(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-zA-Z0-9_-]{4,21}$/'
                )
            )
        );
    }

    public static function isIsoLangDos(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-z]{2}$/'
                )
            )
        );
    }

    public static function isSha1(string $string) : bool
    {
        return preg_match('/^[a-z0-9]{40}$/ui', $string);
    }

    public static function isHashTypeOne(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-z0-9]{40}$/ui'
                )
            )
        );
    }

    public static function isText($string) : bool
    {
        return preg_match(
            '/^[[:word:][:punct:][:space:]]+$/ui',
            $string
        );
    }

    public static function typeVar($value)
    {
        return gettype($value);
    }

    public static function isTplName($string) : bool
    {
       return preg_match('/^[[:lower:]_0-9-\/]{4,24}$/', $string);
    }

    public static function isUrl($url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function isUrlQuery($url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED);
    }

    public static function isUrlHost($url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
    }

    public static function isUrlPath($url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
    }

    public static function isUrScheme($url) : bool
    {
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED);
    }

    public static function validateIsDomain($value)
    {
        return filter_var($value, FILTER_VALIDATE_DOMAIN);
    }

    public static function isMediaType(string $type) : bool
    {
        return preg_match('/^(js|css|img|fonts|icons|svg)$/', $type);
    }

    public static function isEmail($value) : bool
    {
       return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function isFloat($value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }

    public static function isInt($value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    public static function isIntRange($value, $min, $max)
    {
        if (!self::isInt($min) || !self::isInt($max)) {
            return false;
        }
        return filter_var(
            $value,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => $min,
                    'max_range' => $max
                )
            )
        );
    }

    /**
     *
     * @flag default FILTER_NULL_ON_FAILURE
     * true para "1", "true", "on" y "yes". Devuelve false en caso contrario.
     * NOTE no es confiable! > php 7.4
     *
     */
    public static function isBool($value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public static function isBoolTrueOrFalse($val)
    {
        return preg_match('/^(true|false)$/', is_bool($val) ? ($val ? 'true' : 'false') : $val);
    }

    public static function isRegisterSmarty($val) : bool
    {
        return preg_match_all('/^(function|modifier)$/', $val);
    }

    public static function isTypeTranslate($val) : bool
    {
        return preg_match('/^(file|addons|theme)$/', $val);
    }

    public static function isIp($value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_IP);
    }

    public static function isIpNotPrivate($value) : bool
    {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    public static function isImgExt(string $type) : bool
    {
        return preg_match('/^(.jpg|.png|.jpeg|.svg)$/', $type);
    }

    /**
     * @Note: PhpToken::getAll() has been renamed to PhpToken::tokenize() prior to the PHP 8.0 release.
     * The RFC text still refers to PhpToken::getAll().
     * @SEE https://www.php.net/manual/en/function.token-get-all.php
     * @TODO aplicar nuevo metodo!
     */
    public static function isPostToken() : bool
    {
        global $cookie;
        $token = Request::post('token');
        if ($token) {
            return $token === Session::get('token') && !empty($token) && Session::get('token') === $cookie->token;
        } else {
            return false;
        }
    }

    public static function isSmartyToken($token) : bool
    {
        global $cookie;
        return $token === Session::get('token') && !empty($token) && Session::get('token') === $cookie->token;
    }

    public static function isGetToken() : bool
    {
        global $cookie;
        $token = Request::get('token');
        if ($token) {
            return $token === Session::get('token') && !empty($token) && Session::get('token') === $cookie->token;
        } else {
            unset($token);
            return false;
        }
    }

    public static function isTemporitations($key1, $key2)
    {
        return Encryptor::hashEquals($key1, $key2);
    }

    public static function isHeaderType($value) : bool
    {
        /** return preg_match('/^(404|400|500|403)$/', $val); */
        $values = array(
            '100', '101', '102', '200', '201',
            '202', '203', '204', '205', '206',
            '207', '300', '301', '302', '303',
            '304', '305', '307', '400', '401',
            '402', '403', '404', '405', '406',
            '407', '408', '409', '410', '411',
            '412', '413', '414', '415', '416',
            '417', '422', '423', '424', '426',
            '500', '501', '502', '503', '504',
            '505', '506', '507', '509', '510'
        );
        return in_array($value, $values, true);
    }

    public static function isMsjType($value)
    {
        return preg_match('/^(primary|secondary|success|danger|warning|info|light|dark)$/', $value);
    }

    public static function isCaptcha($captcha)
    {
        return Session::get('captcha') && $captcha === Session::get('captcha');
    }

    public static function isNickName(string $string) : bool
    {
        return filter_var(
            $string,
            FILTER_VALIDATE_REGEXP,
            array(
                'options' => array(
                    'regexp' => '/^[a-zA-Z0-9_-]{4,21}$/'
                )
            )
        );
    }

    public static function isNickOrMail(string $string) : bool
    {
        return self::isNickName($string) || self::isEmail($string);
    }

    /** valida fortaleza pass al menos una letra al menos un caracter especial etc etc
        preg_match(
        '/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',
        $password)
    */

    /**
     * @note: Mejorar para embiguedad, que sirva para todo el nucleo...
     */
    public static function isMailTemplate($value) : bool
    {
        $values = array(
            'password_reset.html',
            'password_reset.txt',
            'critical_security_alert.html',
            'critical_security_alert.txt',
            'welcome.html'
        );
        return in_array($value, $values, true);
    }

    public static function isKeyExists(string $search_key, array $insearch) : bool
    {
        foreach ($insearch as $key => $value) {
            if ($search_key === $key) {
                return true;
            }
            if (is_array($value)) {
                if (self::isKeyExists($search_key, $value) == true ) {
                    return true;
                } else {
                    continue;
                }
            }
        }
        return false;
    }

    /**
     * NOTE : using the default locale
     *
     */
    public static function ctypeAlpha(string $value) : bool
    {
        return ctype_alpha($value);
    }

    public static function ctypeAlnum(string $value) : bool
    {
        return ctype_alnum($value);
    }

    public static function ctypeCntrl(string $value) : bool
    {
        return ctype_cntrl($value);
    }

    public static function ctypeDigit(string $value) : bool
    {
        return ctype_digit($value);
    }

    /**
     * NOTE idem  ctype_print(string $text): bool
     */
    public static function ctypeGraph(string $value) : bool
    {
        return ctype_graph($value);
    }

    /**
     * solo minusculas
     */
    public static function ctypeLower(string $value) : bool
    {
        return ctype_lower($value);
    }

    public static function ctypePunct(string $value) : bool
    {
        return ctype_punct($value);
    }

    public static function ctypeSpace(string $value) : bool
    {
        return ctype_space($value);
    }

    /**
     * solo mayusculas
     */
    public static function ctypeUpper(string $value) : bool
    {
        return ctype_upper($value);
    }

    public static function ctypeXdigit(string $value) : bool
    {
        return ctype_xdigit($value);
    }

}

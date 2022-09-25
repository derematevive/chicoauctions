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

class Filter
{

    public static function filterString(string $value) : string
    {
        return trim(filter_var($value, FILTER_SANITIZE_STRING));
    }

    public static function filterUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    public static function xssFilterHtml5(&$value)
    {
        if (is_string($value)) {
            $value = htmlspecialchars($value, ENT_QUOTES|ENT_HTML5, DEFAULT_CHARSET);
        } else if (is_array($value) || is_object($value)) {
            foreach ($value as &$valueInValue) {
                self::xssFilterHtml5($valueInValue);
            }
        }
        return $value;
    }

    public static function xssFilter(&$value)
    {
        if (is_string($value)) {
            $value = htmlspecialchars($value, ENT_QUOTES, DEFAULT_CHARSET);
        } elseif (is_array($value) || is_object($value)) {
            foreach ($value as &$valueInValue) {
                self::xssFilter($valueInValue);
            }
        }
        return $value;
    }

    public static function filterArray($value)
    {
        if (is_array($value)) {
            return filter_var_array($value, FILTER_SANITIZE_STRING);
        } else {
            return self::filterString($value);
        }
    }

    public static function filterServer($key)
    {
        if (!Tools::inputServer($key)) {
            return false;
        }
        return filter_input(INPUT_SERVER, $key, FILTER_SANITIZE_STRING);
    }

    public static function filterGet($key)
    {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
    }

    public static function filterPost($key)
    {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }

    public static function filterCookie($key)
    {
        return filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_STRING);
    }

    public static function inputEnv($key)
    {
        return filter_input(INPUT_ENV, $key, FILTER_SANITIZE_STRING);
    }

}

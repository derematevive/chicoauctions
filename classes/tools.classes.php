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

class Tools
{
    /** filter_has_var — Comprueba si existe una variable de un tipo concreto existe */
    public static function inputServer($value) : bool
    {
        return filter_has_var(INPUT_SERVER, $value);
    }

    public static function renderJSON($data)
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public static function inputGet($value) : bool
    {
        return filter_has_var(INPUT_GET, $value);
    }

    public static function inputPost($value) : bool
    {
        return filter_has_var(INPUT_POST, $value);
    }

    public static function inputCookie($value) : bool
    {
        return filter_has_var(INPUT_COOKIE, $value);
    }

    public static function resolvePath(string $path)
    {
        if(DS !== '/') {
            $path = str_replace(DS, '/', $path);
        }
        $search = explode('/', $path);
        $search = array_filter($search, function($part) {
            return $part !== NOT_SCANDIR;
        });
        $append = array();
        $match = false;
        while(count($search) > 0) {
            $match = realpath(implode('/', $search));
            if($match !== false) {
                break;
            }
            array_unshift($append, array_pop($search));
        };
        if($match === false) {
            $match = getcwd();
        }
        if(count($append) > 0) {
            $match .= DS.implode(DS, $append);
        }
        return $match;
    }

    public static function cleanBase64($value)
    {
        return preg_replace('/[+=\/.]/', '', $value);
    }

    public static function clearIdemsChart($value)
    {
        return preg_replace('/[I1l0Oo]/', '', $value);
    }

    public static function gregwarCaptcha()
    {
        $phrase = new Gregwar\Captcha\PhraseBuilder;
        $code = $phrase->build(4);
        $builder = new Gregwar\Captcha\CaptchaBuilder($code, $phrase);
        $builder->setBackgroundColor(34, 0, 45);
        $builder->setMaxAngle(12);
        $builder->setMaxBehindLines(10);
        $builder->setMaxFrontLines(10);
        $builder->setTextColor(230, 81, 175);
        $builder->build($width = 120, $height = 40, $font = null);
        /** $phrase = $builder->getPhrase(); */
        Session::set('captcha', $builder->getPhrase());
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header('Content-type: image/jpeg');
        $builder->output();
    }

    /** DEPRECATED */
    public static function securimageCaptcha()
    {
        /** Helper::createUrl().'vendor/dapphp/securimage/securimage_show.php'; */
        $options = array();
        $img = new Securimage($options);
        $img->case_sensitive = true;
        $img->perturbation = 0.75;
        $img->perturbation = 1;
        $img->perturbation = 0;
        $img->num_lines = 6;
        $img->num_lines = 0;
        $img->image_width = 160;
        $img->image_height = (int)($img->image_width * 0.35);
        $img->image_height = 50;
        $img->image_width = (int)($img->image_height * 2.875);
        $img->image_signature = 'yourdomain.com';
        $img->signature_color = new Securimage_Color('#000000');
        $img->code_length = 5;
        $img->num_lines = 5;
        $img->show();
    }

    public static function headerStatus(int $code)
    {
            $status = array (
                100 => 'Continue',
                101 => 'Switching Protocols',
                102 => 'Processing',
                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',
                207 => 'Multi-Status',
                300 => 'Multiple Choices',
                301 => 'Moved Permanently',
                302 => 'Found',
                303 => 'See Other',
                304 => 'Not Modified',
                305 => 'Use Proxy',
                307 => 'Temporary Redirect',
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required',
                408 => 'Request Timeout',
                409 => 'Conflict',
                410 => 'Gone',
                411 => 'Length Required',
                412 => 'Precondition Failed',
                413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Long',
                415 => 'Unsupported Media Type',
                416 => 'Requested Range Not Satisfiable',
                417 => 'Expectation Failed',
                422 => 'Unprocessable Entity',
                423 => 'Locked',
                424 => 'Failed Dependency',
                426 => 'Upgrade Required',
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                505 => 'HTTP Version Not Supported',
                506 => 'Variant Also Negotiates',
                507 => 'Insufficient Storage',
                509 => 'Bandwidth Limit Exceeded',
                510 => 'Not Extended'
            );

        if ($status[$code] !== null) {
            $status_text = $code. ' '.$status[$code];
            header($_SERVER['SERVER_PROTOCOL'].' '.Filter::filterString($status_text), true, $code);
            header('Cache-Control: no-cache');
        }
    }

    /** NOTE : mixed !not funtional */
    public static function httpResponseCode()
    {
        return http_response_code();
    }

    public static function forceResponseCode(int $code)
    {
        if (self::httpResponseCode() !== $code) {
            header_remove(self::httpResponseCode());
            http_response_code($code);
        }
        return false;
    }

    public static function listHeader() : array
    {
        return headers_list();
    }

    public static function searchUrls(string $string) : array
    {
        $regex = '/https?\:\/\/[^\" ]+/i';
        preg_match_all($regex, $string, $matches);
        return ($matches[0]);
    }

    public static function parseCamelCase(string $string) : string
    {
        return preg_replace('/(?<=[a-z])(?=[A-Z])/',' ',$string);
    }

}

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

class Cookies
{
    protected $trunk;
    protected $name;
    protected $expire;
    protected $domain;
    protected $path;
    protected $phpencryption;
    protected $changes = false;
    protected $samesite;
    private $key_1;
    private $key_2;

    public function __construct($name_r = null, $expire_r = null)
    {
        if (is_null($name_r)) {
            $name_r = self::string20();
        }
        $this->key_1 = Configuration::getVal('KEY_SECRET_1');
        $this->key_2 = Configuration::getVal('KEY_SECRET_2');
        $this->trunk = array();
        $this->expire = is_null($expire_r) ? time() + 3600 : (int)$expire_r;
        $this->name = Encryptor::hashHmac('md5', $name_r, $this->key_2);
        $this->path = DS;
        $this->domain = $this->getDomain();
        $this->phpencryption = new Encryptor();
        $this->samesite = 'strict';  /**  'None'; 'strict'; 'Lax';  */
        $this->update();
    }

    public static function openSslEncript($value)
    {
        return Encryptor::encrypts($value);
    }

    public static function openSslDecrypts($value)
    {
        return Encryptor::decrypts($value);
    }

    private static function string20() : string
    {
        return Encryptor::algos20();
    }

    private static function string32() : string
    {
        return Encryptor::random32();
    }

    private static function randomString() : string
    {
        return Encryptor::randomKey();
    }

    protected function getDomain($all_subdomains = true)
    {
        global $request;
        $host = Helper::composerHost();
        if ($all_subdomains) {
            if (substr_count($host, '.') > 1) {
                $host = explode('.', $host);
                unset($host[0]);
                $host = implode('.', $host);
            }
        }
        return $host;
    }

    protected function setExpire($expire) : int
    {
        $this->expire = (int)$expire;
    }

    public function __get($key)
    {
        return isset($this->trunk[$key]) ? $this->trunk[$key] : false;
    }

    public function __isset($key)
    {
        return isset($this->trunk[$key]);
    }

    public function ifIsset($key)
    {
        return self::__isset($key);
    }

    public function get($key)
    {
        if (self::ifIsset($key)){
            return $this->trunk[$key];
        } else {
            return false;
        }
    }

    /**
     * 𐌌
     * uft-8 = %uD800%uDF0C
     */
    public function __set($key, $value)
    {
        if (is_array($value)) {
            die('el valor recibido no es el esperado!');
        }
        if (preg_match('/𐌌|\|/', $key.$value)) {
            throw new Exception('caracteres prohibidos en cookie!');
        }
        if (!$this->changes and
            (!isset($this->trunk[$key]) or
            (isset($this->trunk[$key]) and
            $this->trunk[$key] != $value))) {
            $this->changes = true;
        }
        $this->trunk[$key] = $value;
        $this->recordData();
    }

    public function unsetForKey($key)
    {
        if (isset($this->trunk[$key])) {
            $this->changes = true;
        }
        unset($this->trunk[$key]);
        $this->recordData();
    }

    public function isLoguin($a_visitor = false)
    {
        if (!$a_visitor and $this->is_visitor == 1) {
            return false;
        }

        if ($this->isLoguin == 1 and $this->id_user) {
            return true;
        }
        return false;
    }

    public function isLogout()
    {
        $this->trunk = array();
        $this->cookieSet();
        unset($_COOKIE[$this->name]);
        $this->changes = true;
        $this->recordData();
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @See https://www.php.net/manual/en/function.setcookie.php
     */
    public function update()
    {
        if (isset($_COOKIE[$this->name])) {
            $reader = $this->phpencryption->decrypts(
                $_COOKIE[$this->name]
            );
            $hashing = Encryptor::hasSimple('crc32b', mb_substr($reader, 0, strrpos($reader, '𐌌')), true);
            $boomark = explode('𐌌', $reader);
            foreach ($boomark as $keyAndValue) {
                $boomark2 = explode('|', $keyAndValue);
                if (count($boomark2) == 2) {
                    $this->trunk[$boomark2[0]] = $boomark2[1];
                }
            }
            if (isset($this->trunk['hashing'])) {
                $this->trunk['hashing'] = (int)($this->trunk['hashing']);
            }
            if (!isset($this->trunk['hashing']) OR $this->trunk['hashing'] != $hashing)
                $this->isLogout();
            if (!isset($this->trunk['date_add'])) {
                $this->trunk['date_add'] = date('Y-m-d H:i:s');
            }
        } else {
            $this->trunk['date_add'] = date('Y-m-d H:i:s');
        }
    }

    public function updateDefuseMode()
    {
        if (isset($_COOKIE[$this->name])) {
            $reader = $this->phpencryption->decrypt(
                $_COOKIE[$this->name],
                $this->key_1
            );
            $hashing = Encryptor::hasSimple('crc32b', mb_substr($reader, 0, strrpos($reader, '𐌌')), true);
            $boomark = explode('𐌌', $reader);
            foreach ($boomark as $keyAndValue) {
                $boomark2 = explode('|', $keyAndValue);
                if (count($boomark2) == 2) {
                    $this->trunk[$boomark2[0]] = $boomark2[1];
                }
            }
            if (isset($this->trunk['hashing'])) {
                $this->trunk['hashing'] = (int)($this->trunk['hashing']);
            }
            if (!isset($this->trunk['hashing']) OR $this->trunk['hashing'] != $hashing)
                $this->isLogout();
            if (!isset($this->trunk['date_add'])) {
                $this->trunk['date_add'] = date('Y-m-d H:i:s');
            }
        } else {
            $this->trunk['date_add'] = date('Y-m-d H:i:s');
        }
    }

    /**
     *
     * @SEE : https://www.php.net/manual/en/function.setcookie.php
     * @NOTE : setcookie(string $name, string $value = "", array $options = []): bool
     */
    protected function cookieSetDefuseMode($cookie = null)
    {
        if ($cookie) {
            $record = $this->phpencryption->encrypt($cookie, $this->key_1);
            $time = $this->expire;
        } else {
            $record = 0;
            $time = time() - 1;
        }
        return setcookie($this->name, $record, [
            'expires' => $time,
            'path' => $this->path,
            'domain' => $this->domain,
            'secure' => true,
            'httponly' => true,
            'samesite' => $this->samesite
        ]);
    }

    public function recordDataDefuseMode()
    {
        $cookie = '';
        if (isset($this->trunk['hashing'])) {
            unset($this->trunk['hashing']);
        }
        foreach ($this->trunk as $key => $value) {
            $cookie .= $key.'|'.$value.'𐌌';
        }
        $cookie .= 'hashing|'.Encryptor::hasSimple('crc32b', $cookie, true);
        return $this->cookieSetDefuseMode($cookie);
    }

    /**
     * For PHP >= v7.3
     * febrero de 2020
     * January 12, 2021
     * @See https://www.php.net/manual/en/function.setcookie.php
     * @setcookie(string $name, string $value = "", array $options = []): bool
     * NOTE In options : The value of the samesite element should be either None, Lax or Strict.
     */
    protected function cookieSet($cookie = null)
    {
        if ($cookie) {
            $record = $this->phpencryption->encrypts($cookie);
            $time = $this->expire;
        } else {
            $record = 0;
            $time = time() - 1;
        }
        return setcookie($this->name, $record, [
            'expires' => $time,
            'path' => $this->path,
            'domain' => $this->domain,
            'secure' => true,
            'httponly' => true,
            'samesite' => $this->samesite
        ]);
    }

    public function recordData()
    {
        $cookie = '';
        if (isset($this->trunk['hashing'])) {
            unset($this->trunk['hashing']);
        }
        foreach ($this->trunk as $key => $value) {
            $cookie .= $key.'|'.$value.'𐌌';
        }
        $cookie .= 'hashing|'.Encryptor::hasSimple('crc32b', $cookie, true);
        return $this->cookieSet($cookie);
    }

    public function remove()
    {
        global $cookie;
        if (headers_sent())
            throw new \Exception('Failed to remove cookie. Headers already sent!');
        setcookie($cookie->getName(), '', 1);
        setcookie($cookie->getName(), false);
        unset($_COOKIE[$cookie->getName()]);
        Helper::home();
    }
}

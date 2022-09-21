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

class Configuration extends dbObject
{
    protected $dbFields = array(
        'name' => array('/^[A-Z-_]{3,21}$/s', 'required'),
        'id_lang' => array('^[0-9]{1,2}$', 'required'),
        'value' => array('text', 'required'),
        'date_add' => array('datetime'),
        'date_upd' => array('datetime')
    );

    protected $primaryKey = 'id_configuration';
    protected $timestamps = array('date_add', 'date_upd');

    /**
     * @var $id_lang = int()
     */
    public static function getVal(string $value, $id_lang = false) : string
    {
        if (!Validate::isConfigName($value)) {
            unset($value);
            exit('nombre de configuracion invalido');
        }

        if (!$id_lang) {
            $id_lang = LANG_DEFAULT_FRONT;
        }

        if (!Validate::isIntRange($id_lang, '1', '34')) {
            unset($value, $id_lang);
            exit('id idioma no aceptado!');
        }

        $value = MysqliDb::getInstance()->escape($value);
        MysqliDb::getInstance()->where('id_lang', (int)$id_lang);
        MysqliDb::getInstance()->where('name', $value);
        $name_value = MysqliDb::getInstance()->getOne('configuration');

        if (!$name_value) {
            exit(Filter::filterString($value).' no exite esta configuracion en el sistema');
        }

        return Filter::filterString($name_value['value']);
    }

    public static function defaultLang() : ? int
    {
        $lang_id = Configuration::where('name', 'ID_DEFAULT_LANG')->getOne();
        if (!$lang_id) {
            exit('No hay idioma front por defecto configurado!');
        }
        return $lang_id->value;
    }
}

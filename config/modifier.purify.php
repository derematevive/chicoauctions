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

function smarty_modifier_purify($string) {
    static $purifier;

    if (!isset($purifier)) {
        if (!file_exists(CACHE_DIR.'purifier') && !mkdir(CACHE_DIR.'purifier', 0777, true) &&
            !is_dir(CACHE_DIR.'purifier')) {
            throw new \RuntimeException(sprintf(
                'HTML purifier directory "%s" can not be created', CACHE_DIR
            ));
        }
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.SerializerPath', CACHE_DIR.'purifier');
        $config->set('Core.Encoding', 'UTF-8');
        $config->set('AutoFormat.AutoParagraph', true);
        $allowed = [
            'p',
            'br',
            'b',
            'i[class]',
            'ul[class]',
            'ol',
            'li[class|id]',
            'span',
            'table',
            'thead',
            'tbody[class]',
            'tr',
            'td',
        ];

        $config->set('HTML.Allowed', implode(',', $allowed));

        /** $config->set(
            'HTML.Allowed',
            'ul[class],li[class],img[src|class|lang|alt],p[class],div[class],a[class|href]'
        );
        */
        $config->set('Attr.AllowedFrameTargets', array('_blank', '_self', '_parent', '_top'));
        $config->set('HTML.SafeIframe', true);
        $config->set('HTML.SafeObject', true);
        $config->set('URI.SafeIframeRegexp', '/.*/');
        $config->set('HTML.ForbiddenElements', array('script','applet'));
        $config->set('AutoFormat.RemoveEmpty', true);

        if ($def = $config->getHTMLDefinition(true)) {
            $def->addAttribute('a', 'data-provide', 'Text');
            $def->addAttribute('a', 'role', 'Text');

            $def->addAttribute(
                'a', 'target', new HTMLPurifier_AttrDef_Enum(array('_blank'))
            );
            $def->addAttribute('span', 'class', 'Text');
            $def->addAttribute('ul', 'class', 'Text');
            $def->addAttribute('i', 'class', 'Text');
            $def->addAttribute('table', 'class', 'Text');
        }

        $purifier = new HTMLPurifier($config);
    }

    return $purifier->purify($string);
}

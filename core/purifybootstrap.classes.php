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

class PurifyBootstrap
{
    private static function setHtml5Properties($value)
    {
        /** $purificateur = new HTMLPurifier(); */
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8');
        $config->set('Attr.EnableID', true);
        $config->set('Attr.AllowedRel', array('nofollow'));
        $config->set('HTML.Trusted', true);
        $config->set('AutoFormat.RemoveEmpty', true);
        $config->set('HTML.Forms', true);
        /** $config->set('HTML.Forms', array('form','input','action')); */
        $config->set('Cache.SerializerPath', CACHE_DIR.'purifier');
        /** $config->set('AutoFormat.AutoParagraph', true);  */
        $config->set('Attr.AllowedFrameTargets', array('_blank', '_self', '_parent', '_top'));
        $config->set('HTML.SafeIframe', true);
        $config->set('HTML.SafeObject', true);
        $config->set('URI.SafeIframeRegexp', '/.*/');
        $config->set('HTML.ForbiddenElements', array('script','applet'));
        $config->set('HTML.Allowed', 'form[class],div[class|data|id],a[target|href|class]');
        $config->set(
            'HTML.Allowed',
            'img[src|class|width|height|lang|alt],b,p[align],br,div,a[target|href|class]',
        );
        /** see http://htmlpurifier.org/docs/enduser-customize.html
        see https://github.com/ezyang/htmlpurifier/blob/master/library/HTMLPurifier/AttrTypes.php
        */
        if ($def = $config->getHTMLDefinition(true)) {
            $def->addElement(
                'section',
                'Block',
                'Flow',
                'Common'
            );
            $def->addElement(
                'nav',
                'Block',
                'Flow',
                'Common'
            );
            $def->addElement(
                'article',
                'Block',
                'Flow',
                'Common'
            );
            $def->addElement(
                'aside',
                'Block',
                'Flow',
                'Common'
            );
            $def->addElement(
                'header',
                'Block',
                'Flow',
                'Common'
            );
            $def->addElement(
                'footer',
                'Block',
                'Flow',
                'Common'
            );
            $def->addElement('address', 'Block', 'Flow', 'Common');
            $def->addElement('main', 'Block', 'Flow', 'Common');

            $def->addElement(
                'hgroup',
                'Block',
                'Required: h1 | h2 | h3 | h4 | h5 | h6',
                'Common'
            );
            $def->addElement(
                'figure',
                'Block',
                'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow',
                'Common'
            );
            $def->addElement('figcaption', 'Inline', 'Flow', 'Common');
        $form = $def->addElement(
            'form',
            'Block',
            'Flow',
            'Common',
            array(
                'action*' => 'URI',
                'method' => 'Enum#get|post',
                'name' => 'ID'
            )
        );
            $form->excludes = array('form' => true);
            $def->addAttribute('button', 'data-toggle', 'Text');
            $def->addAttribute('button', 'data-target', 'Text');
            $def->addAttribute('button', 'aria-controls', 'Text');
            $def->addAttribute('button', 'aria-expanded', 'Bool');
            $def->addAttribute('button', 'aria-label', 'Text');
            $def->addAttribute('button', 'class', 'Text');
            /** $def->addAttribute('data-*',*/

            $def->addAttribute('a', 'data-provide', 'Text');
            $def->addAttribute('a', 'role', 'Text');
            $def->addAttribute('a', 'aria-haspopup', 'Bool');
            $def->addAttribute('a', 'aria-expanded', 'Bool');
            $def->addAttribute('a', 'data-lightbox', 'Text');
            $def->addAttribute('a', 'data-click', 'Text');
            $def->addAttribute('a', 'data-color', 'Text');
            $def->addAttribute('a', 'data-hover-color', 'Text');
            $def->addAttribute('a', 'data-background-color', 'Text');
            $def->addAttribute('a', 'data-hover-background-color', 'Text');
            $def->addAttribute('a', 'target', 'Enum#_blank,_self,_target,_top');
            /**
            $def->addAttribute('a', 'target', new HTMLPurifier_AttrDef_Enum(
                array('_blank','_self','_target','_top')
            ));
            */
            $def->addAttribute('input', 'placeholder', 'Text');
            $def->addAttribute('input', 'class', 'Text');
            $def->addAttribute('form', 'class', 'Text');
            $def->addAttribute('main', 'role', 'Text');

            $def->addAttribute('body', 'class', 'Text');
            $def->addAttribute('body', 'id', 'Text');
            $def->addAttribute('div', 'class', 'Text');
            $def->addAttribute('div', 'id', 'Text');
            $def->addAttribute('div', 'aria-labelledby', 'Text');
            /* $def->addAttribute('div', 'tabindex', 'Number');  */
        }
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($value);
    }

    public static function purify($value)
    {
        return self::setHtml5Properties($value);
    }
}

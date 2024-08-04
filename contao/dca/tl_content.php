<?php

declare(strict_types=1);

/**
 * Contao Marquee bundle for Contao Open Source CMS
 * Copyright (c) 2024 jedoCodes
 *
 * @category ContaoBundle
 * @package  jedocodes/contao-css-marquee-bundle
 * @author   jedo.Codes <dev@jedo.codes>
 * @link     https://github.com/jedocodes/contao-marquee-bundle
 */


use Contao\Backend;
use Contao\DataContainer;
use Jedocodes\ContaoMarqueeBundle\Controller\ContentElement\MarqueeController;

/**
 * Content elements
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'marqueeType';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'marqueeSpeed';

$GLOBALS['TL_DCA']['tl_content']['palettes']['marquee'] = '{type_legend},type, marqueeType;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['marqueeText'] = '{type_legend},type,marqueeType;{marqueeSlider_legend},marqueeSpeed, marqueeDirection, marqueeRotate;{marqueeListitems_legend},marqueeListItems;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['marqueeGalerie'] = '{type_legend},type,marqueeType;{marqueeSlider_legend},marqueeSpeed, marqueeDirection, marqueeRotate;{source_legend},multiSRC;{image_legend},size;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['marqueeTextcustom'] = '{type_legend},type,marqueeType;{marqueeSlider_legend},marqueeSpeed, marqueeDirection, marqueeRotate,marqueeCustomSpeed;{marqueeListitems_legend},marqueeListItems;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['marqueeGaleriecustom'] = '{type_legend},type, marqueeType;{marqueeSlider_legend},marqueeSpeed, marqueeDirection, marqueeRotate,marqueeCustomSpeed;{source_legend},multiSRC;{image_legend},size;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';



$GLOBALS['TL_DCA']['tl_content']['fields']['multiSRC']['load_callback'] = array
    (
        array('tl_content_marqueen', 'setMultiSrcFlags')
    );


$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeType'] = [
    'inputType' => 'select',
    'options' => [ 'marqueeGalerie', 'marqueeText'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['marqueeType_options'],
    'eval' => ['helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50 clr','includeBlankOption'=>true],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeSpeed'] = [
    'inputType' => 'select',
    'options' => [ 'slow','fast', 'custom'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['marqueeSpeed_options'],
    'eval' => ['helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'w25','includeBlankOption'=>true],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeCustomSpeed'] = [
    'default'                 => 10,
    'inputType'               => 'text',
    'eval'                    => array('rgxp'=>'natural', 'tl_class'=>'w25 clr'),
    'sql'                     => "smallint(5) unsigned NOT NULL default 0"
];

$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeRotate'] = [
    'inputType'               => 'text',
    'eval'                    => array('rgxp' => 'alnum', 'tl_class'=>'w25'),
    'sql'                     => "varchar(8) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeDirection'] = [
    'inputType' => 'select',
    'options' => [ 'right','left'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['marqueeDirection_options'],
    'eval' => ['helpwizard'=>true, 'chosen'=>true, 'tl_class'=>'w25','includeBlankOption'=>true],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeListItems'] = [
    'inputType'               => 'listWizard',
    'eval'                    => array('tl_class'=>'clr'),
    'sql'                     => "blob NOT NULL DEFAULT ''",
];



/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @internal
 */
class tl_content_marqueen extends Backend
{

    public function setMultiSrcFlags($varValue, DataContainer $dc)
    {
        if ($dc->activeRecord) {

            print_r($dc->activeRecord->type);
            if ($dc->activeRecord->type == 'marquee') {
                $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['isGallery'] = true;
                $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['filesOnly'] = true;
                $GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = '%contao.image.valid_extensions%';
            }
        }
        return $varValue;
    }
}

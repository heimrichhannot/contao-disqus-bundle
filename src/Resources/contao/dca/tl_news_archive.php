<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$arrDca = &$GLOBALS['TL_DCA']['tl_news_archive'];
$translator = System::getContainer()->get('translator');

$palette = \Contao\CoreBundle\DataContainer\PaletteManipulator::create();
$palette->addField('disqus_addDisqus', 'comments_legend', $palette::POSITION_APPEND)
    ->applyToPalette('default', 'tl_news_archive');

$arrDca['subpalettes']['disqus_addDisqus'] = 'disqus_shortname';
$arrDca['palettes']['__selector__'][] = 'disqus_addDisqus';

$fields = [
    'disqus_addDisqus' => [
        'label' => [],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'clr','submitOnChange' => true],
        'sql' => "char(1) NOT NULL default '0'",
    ],
    'disqus_shortname' => [
        'label'                   => &$GLOBALS['TL_LANG']['tl_content']['disqus_shortname'],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ]
];

$arrDca['fields'] = array_merge($arrDca['fields'], $fields);
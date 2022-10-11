<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$arrDca = &$GLOBALS['TL_DCA']['tl_news_archive'];

$palette = PaletteManipulator::create();
$palette->addField('disqus_addDisqus', 'comments_legend', $palette::POSITION_APPEND)
    ->applyToPalette('default', 'tl_news_archive');

$arrDca['subpalettes']['disqus_addDisqus'] = 'disqus_shortname, disqus_identifier';
$arrDca['palettes']['__selector__'][] = 'disqus_addDisqus';

$fields = [
    'disqus_addDisqus' => [
        'label' => &$GLOBALS['TL_LANG']['tl_news_archive']['disqus_addDisqus'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'clr', 'submitOnChange' => true],
        'sql' => "char(1) NOT NULL default '0'",
    ],
    'disqus_shortname' => [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['disqus_shortname'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "varchar(255) NOT NULL default ''",
    ],
    'disqus_identifier' => [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['disqus_identifier'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
        'sql' => "varchar(255) NOT NULL default ''",
    ],
];

$arrDca['fields'] = array_merge($arrDca['fields'], $fields);

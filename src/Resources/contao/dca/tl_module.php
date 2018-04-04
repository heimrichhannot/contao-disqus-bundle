<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$arrDca     = &$GLOBALS['TL_DCA']['tl_module'];

$arrDca['palettes'][HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule::MODULE_NAME] =
    '{title_legend},name,headline,type;'
    .'{disqus_legend},disqus_shortname,disqus_identifier';

$arrFields = [
    'disqus_shortname' => [
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['disqus_shortname'],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ],
    'disqus_identifier' => [
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['disqus_identifier'],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ]
];

$arrDca['fields'] = array_merge($arrDca['fields'], $arrFields);
<?php

$arrLang = &$GLOBALS['TL_LANG']['tl_module'];

/**
 * Fields
 */
$arrLang['disqus_shortname']        = ['Forum Name', 'Der Disqus Forum Shortname.'];
$arrLang['disqus_identifier']        = ['Einzigartiger Identifier', 'Ein einzigartiger Identifier, um das Forum zuordnen zu können.'];

/**
 * Legends
 */

$arrLang['disqus_legend'] = 'Disqus Einstellungen';

/**
 * Module names
 */

$GLOBALS['TL_LANG']['FMD'][\HeimrichHannot\ContaoDisqusBundle\Modules\DisqusNewsReaderModule::MODULE_NAME] = array('Nachrichtenleser mit Disqus', 'News Reader Module mit Disqus Kommentaren');
$GLOBALS['TL_LANG']['FMD'][\HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule::MODULE_NAME] = array('Disqus Modul', 'Module, welches ein Disqus-Form einbindet.');
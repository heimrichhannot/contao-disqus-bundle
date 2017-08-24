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
 * Modules
 */

$GLOBALS['TL_LANG']['FMD'][\HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule::MODULE_NAME] = array('Disqus Modul', 'Modul, welches ein Disqus-Form einbindet.');
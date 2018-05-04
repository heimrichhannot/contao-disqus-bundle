<?php

$arrLang = &$GLOBALS['TL_LANG']['tl_module'];

/**
 * Fields
 */
$arrLang['disqus_shortname']        = ['Forum Name', 'Der Disqus Forum Shortname.'];
$arrLang['disqus_identifier']        = ['Seiten-Identifier', 'Ein einzigartiger Identifier, welcher eine Diskussion eindeutig identifiziert. Ein "{id}" wird durch die aktuelle Seiten-Id ersetzt.'];

/**
 * Legends
 */

$arrLang['disqus_legend'] = 'Disqus Einstellungen';

/**
 * Modules
 */

$GLOBALS['TL_LANG']['FMD'][\HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule::MODULE_NAME] = array('Disqus Modul', 'Modul, welches ein Disqus-Form einbindet.');
<?php

$arrLang = &$GLOBALS['TL_LANG']['tl_module'];

/**
 * Fields
 */
$arrLang['disqus_shortname']        = ['Forum name', 'The disqus forum shortname.'];
$arrLang['disqus_identifier']        = ['Unique identifier', 'A unique identifier, to assign the forum.'];

/**
 * Legends
 */

$arrLang['disqus_legend'] = 'Disqus settings';

/**
 * Modules
 */

$GLOBALS['TL_LANG']['FMD'][\HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule::MODULE_NAME] = array('Disqus module', 'Module to integrate a disqus forum.');
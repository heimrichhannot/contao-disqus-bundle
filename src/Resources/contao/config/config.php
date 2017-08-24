<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$GLOBALS['FE_MOD']['miscellaneous'][HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule::MODULE_NAME] = 'HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule';

/**
 * Hooks
 */

$GLOBALS['TL_HOOKS']['parseArticles']['hhDisqusBundle'] = ['HeimrichHannot\ContaoDisqusBundle\EventListener\ParseArticlesHook', 'addDisqus'];

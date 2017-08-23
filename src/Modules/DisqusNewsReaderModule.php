<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Modules;


use Contao\ModuleNewsReader;

class DisqusNewsReaderModule extends ModuleNewsReader
{
    const MODULE_NAME = 'disqus_newsreader_module';

    protected $strTemplate = 'mod_news_disqus_comments';

    /**
     * Generate the module
     */
    protected function compile()
    {
        $objArchive = \NewsArchiveModel::findById($this->news_archives);
        $this->Template->disqus_shortname = $objArchive->disqus_shortname;
        return parent::compile();
    }

}
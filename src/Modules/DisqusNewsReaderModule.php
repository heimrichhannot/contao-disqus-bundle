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


use Contao\Environment;
use Contao\Input;
use Contao\ModuleNewsReader;
use HeimrichHannot\Haste\Util\Url;

class DisqusNewsReaderModule extends ModuleNewsReader
{
    const MODULE_NAME = 'disqus_newsreader_module';

    protected $strTemplate = 'mod_newsreader';

    /**
     * Generate the module
     */
    protected function compile()
    {
        global $objPage;

        $objArticle = \NewsModel::findPublishedByParentAndIdOrAlias(\Input::get('items'), $this->news_archives);
        $objArchive = \NewsArchiveModel::findById($this->news_archives);
        $this->Template->disqus_shortname = $objArchive->disqus_shortname;
        $this->Template->disqus_identifier = $objArticle->id;
        $this->Template->disqus_addDisqus = $objArchive->disqus_addDisqus;
        $url = Environment::get('url');
        $path = Url::generateFrontendUrl($objPage->id);
        $this->Template->disqus_pageUrl = $url.'/'.$path.'/'.$objArticle->alias;
        return parent::compile();
    }

}
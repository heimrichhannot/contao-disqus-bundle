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


use Contao\BackendTemplate;
use Contao\Module;
use Contao\System;
use Patchwork\Utf8;

class DisqusCommentsModule extends Module
{

    const MODULE_NAME = 'contao-disqus-comments';

    protected $strTemplate = 'mod_disqus_comments';

    /**
     * Parse the template
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            /** @var BackendTemplate|object $objTemplate */
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . Utf8::strtoupper($GLOBALS['TL_LANG']['FMD'][static::MODULE_NAME][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
            return $objTemplate->parse();
        }

        return parent::generate();
    }


    /**
     * Compile the current element
     */
    protected function compile()
    {
        $this->Template->headline     = $this->headline;
        $this->Template->hl           = $this->hl;
        $this->Template->wrapperClass = $this->strWrapperClass;
        $this->Template->wrapperId    = $this->strWrapperId;

        $this->Template->disqus_shortname = $this->disqus_shortname;
        $this->Template->disqus_identifier = $this->disqus_identifier;
        $this->Template->disqus_block = System::getContainer()->get('huh.disqus.renderer')->render($this->disqus_shortname, $this->disqus_identifier);


    }
}
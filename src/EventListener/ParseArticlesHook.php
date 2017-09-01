<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\ContaoDisqusBundle\EventListener;

use Environment;
use HeimrichHannot\Haste\Util\Url;

class ParseArticlesHook
{

    public function addDisqus(\FrontendTemplate $objTemplate, array $arrArticle, \Module $objModule)
    {
        global $objPage;
        $objArchive = \NewsArchiveModel::findById($arrArticle['pid']);
        if (!$objArchive->disqus_addDisqus)
        {
            return;
        }
        $disqus_shortname = $objArchive->disqus_shortname;
        if ($objArchive->disqus_identifier)
        {
            $disqus_identifier = str_replace('{id}', $arrArticle['id'], $objArchive->disqus_identifier);
        } else
        {
            $disqus_identifier = $arrArticle['id'];
        }

        $url                         = Environment::get('url');
        $path                        = Url::generateFrontendUrl($objPage->id);
        $disqus_pageUrl              = $url . '/' . $path . '/' . $arrArticle['alias'];
        $twig                        = \System::getContainer()->get('twig');
        $objTemplate->disqus_section = $twig->render(
            '@HeimrichHannotContaoDisqus/disqus_comment.html.twig',
            [
                'disqus_shortname'  => $disqus_shortname,
                'disqus_identifier' => $disqus_identifier,
                'disqus_pageUrl'    => $disqus_pageUrl
            ]
        );
        return;
    }
}
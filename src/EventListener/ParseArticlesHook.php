<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ContaoDisqusBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Environment;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\NewsArchiveModel;
use HeimrichHannot\ContaoDisqusBundle\Renderer\DisqusRenderer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ParseArticlesHook
{
    /**
     * @var ContaoFramework
     */
    private $framework;
    /**
     * @var DisqusRenderer
     */
    private $renderer;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(ContaoFramework $framework, DisqusRenderer $renderer, UrlGeneratorInterface $urlGenerator)
    {
        $this->framework = $framework;
        $this->renderer = $renderer;
        $this->urlGenerator = $urlGenerator;
    }

    public function addDisqus(FrontendTemplate &$template, array $article, Module $module)
    {
        global $objPage;
        /** @var NewsArchiveModel $newsArchive */
        $newsArchive = $this->framework->getAdapter(NewsArchiveModel::class)->findById($article['pid']);
        if (!$newsArchive->disqus_addDisqus) {
            return;
        }
        $disqus_shortname = $newsArchive->disqus_shortname;
        if ($newsArchive->disqus_identifier) {
            $disqus_identifier = str_replace('{id}', $article['id'], $newsArchive->disqus_identifier);
        } else {
            $disqus_identifier = $article['id'];
        }

        $result = $this->renderer->render($disqus_shortname, $disqus_identifier);

        $url = $this->framework->getAdapter(Environment::class)->get('url');
        $path = $this->urlGenerator->generate($objPage->id);
        $disqus_pageUrl = $url.'/'.$path.'/'.$article['alias'];
        $template->disqus_section = $this->renderer->render($disqus_shortname, $disqus_identifier, $disqus_pageUrl);
    }
}

<?php

/*
 * Copyright (c) 2022 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\ContaoDisqusBundle\Renderer;

use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\Error;

class DisqusRenderer
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(Environment $twig, TranslatorInterface $translator)
    {
        $this->twig = $twig;
        $this->translator = $translator;
    }

    /**
     * @param null $disqus_identifier
     *
     * @return string
     */
    public function render(string $disqus_shortname, $disqus_identifier = null, string $disqus_pageUrl = null)
    {
        try {
            return $this->twig->render(
                '@HeimrichHannotContaoDisqus/disqus_comment.html.twig',
                [
                    'disqus_shortname' => $disqus_shortname,
                    'disqus_identifier' => $disqus_identifier,
                    'disqus_pageUrl' => $disqus_pageUrl,
                ]
            );
        } catch (Error $e) {
            return '<p>'.$this->translator->trans('huh.disqus.renderer.error').'</p>';
        }
    }
}

<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Renderer;


use Symfony\Component\Translation\TranslatorInterface;
use Twig\Environment;
use Twig_Error;

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
     * @param string $disqus_shortname
     * @param null $disqus_identifier
     * @param string|null $disqus_pageUrl
     * @return string
     */
    public function render(string $disqus_shortname, $disqus_identifier = null, string $disqus_pageUrl = null)
    {
        try
        {
            return $this->twig->render(
                '@HeimrichHannotContaoDisqus/disqus_comment.html.twig',
                [
                    'disqus_shortname'  => $disqus_shortname,
                    'disqus_identifier' => $disqus_identifier,
                    'disqus_pageUrl'    => $disqus_pageUrl
                ]
            );
        } catch (Twig_Error $e)
        {
            return '<p>'.$this->translator->trans('huh.disqus.renderer.error').'</p>';
        }
    }

}
<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Test\Renderer;


use Contao\TestCase\ContaoTestCase;
use HeimrichHannot\ContaoDisqusBundle\Renderer\DisqusRenderer;
use Symfony\Component\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\Error;

class DisqusRendererTest extends ContaoTestCase
{
    public function testRender ()
    {
        $twig = $this->createMock(Environment::class);
        $twig->method("render")->willReturnCallback(function ($template, $params) {
            return $params;
        });
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->method("trans")->willReturnArgument(0);

        $renderer = new DisqusRenderer($twig, $translator);

        $result = $renderer->render("forum", "thread", "url");

        $this->assertCount(3, $result);
        $this->assertSame("forum", $result['disqus_shortname']);
        $this->assertSame("thread", $result['disqus_identifier']);
        $this->assertSame("url", $result['disqus_pageUrl']);

        $twig->method("render")->willThrowException(new Error("Test Exception"));
        $renderer = new DisqusRenderer($twig, $translator);

        $result = $renderer->render("forum", "thread", "url");
        $this->assertSame("<p>huh.disqus.renderer.error</p>", $result);

    }
}
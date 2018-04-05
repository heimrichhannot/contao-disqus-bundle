<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Test\EventListener;


use Contao\Environment;
use Contao\FrontendTemplate;
use Contao\Module;
use Contao\NewsArchiveModel;
use Contao\TestCase\ContaoTestCase;
use HeimrichHannot\ContaoDisqusBundle\EventListener\ParseArticlesHook;
use HeimrichHannot\ContaoDisqusBundle\Renderer\DisqusRenderer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ParseArticlesHookTest extends ContaoTestCase
{
    public function testAddDisqus()
    {
        $newsArchiveModelMock = $this->mockAdapter(['findById']);
        $newsArchiveModelMock->method('findById')->willReturnCallback(function($id){
            $model = new \stdClass();
            $model->id = $id;
            switch ($id)
            {
                case 5:
                    $model->disqus_addDisqus = null;
                    $model->disqus_shortname = null;
                    $model->disqus_identifier = null;
                    break;
                case 2:
                    $model->disqus_addDisqus = '1';
                    $model->disqus_shortname = 'test2';
                    $model->disqus_identifier = null;
                    break;
                default:
                    $model->disqus_addDisqus = '1';
                    $model->disqus_shortname = 'test';
                    $model->disqus_identifier = 'forum-{id}';
            }
            return $model;
        });
        $environmentMock = $this->mockAdapter(['get']);
        $environmentMock->method('get')->willReturn('https://example.org');
        $framework = $this->mockContaoFramework([
            NewsArchiveModel::class => $newsArchiveModelMock,
            Environment::class => $environmentMock,
        ]);
        /** @var DisqusRenderer|\PHPUnit_Framework_MockObject_MockObject $renderer */
        $renderer = $this->getMockBuilder(DisqusRenderer::class)->disableOriginalConstructor()->setMethods(['render'])->getMock();
        $renderer->method('render')->willReturnCallback(function ($disqus_shortname, $disqus_identifier, $disqus_pageUrl){
           return [$disqus_shortname, $disqus_identifier, $disqus_pageUrl];
        });
        /** @var UrlGeneratorInterface|\PHPUnit_Framework_MockObject_MockObject $urlGenerator */
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $class = new ParseArticlesHook($framework, $renderer, $urlGenerator);

        $objPage = new \stdClass();
        $objPage->id = 10;
        $GLOBALS['objPage'] = $objPage;
        /** @var FrontendTemplate|\PHPUnit_Framework_MockObject_MockObject $template */
        $template = $this->getMockBuilder(FrontendTemplate::class)->disableOriginalConstructor()->disableOriginalClone()->setMethods(null)->getMock();
        $article = [
            'id' => 1,
            'pid' => 5,
            'alias' => 'test',
        ];
        $module = $this->createMock(Module::class);

        $this->assertNull($class->addDisqus($template, $article, $module));

        $article['pid'] = 1;
        $this->assertNull($class->addDisqus($template, $article, $module));
        $this->assertSame('test', $template->disqus_section[0]);
        $this->assertSame('forum-1', $template->disqus_section[1]);

        $article['pid'] = 2;
        $this->assertNull($class->addDisqus($template, $article, $module));
        $this->assertSame('test2', $template->disqus_section[0]);
        $this->assertSame(1, $template->disqus_section[1]);
    }
}
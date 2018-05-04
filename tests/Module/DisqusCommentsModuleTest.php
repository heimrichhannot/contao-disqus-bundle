<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Test\Module;


use Contao\BackendTemplate;
use Contao\Config;
use Contao\ModuleModel;
use Contao\System;
use Contao\TestCase\ContaoTestCase;
use HeimrichHannot\ContaoDisqusBundle\Modules\DisqusCommentsModule;
use HeimrichHannot\ContaoDisqusBundle\Renderer\DisqusRenderer;

class DisqusCommentsModuleTest extends ContaoTestCase
{
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    protected function setUp()
    {
        parent::setUp();
        $framework = $this->mockContaoFramework();
        $framework->method('createInstance')->willReturnCallback(function ($name){
           switch ($name)
           {
               case BackendTemplate::class:
                   $backendMock = $this->createMock(BackendTemplate::class);
                   $backendMock->expects($this->once())->method('parse');
                   return $backendMock;
               default:
                   return;
           }
        });
        $twigRendererMock = $this->createMock(DisqusRenderer::class);
        $twigRendererMock->method('render')->willReturnCallback(function($disqus_shortname, $disqus_identifier = null, $disqus_pageUrl = null) {
            return [$disqus_shortname, $disqus_identifier, $disqus_pageUrl];
        });
        $container = $this->mockContainer();
        $container->set('contao.framework', $framework);
        $container->set('huh.disqus.renderer', $twigRendererMock);
        System::setContainer($container);
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testGenerateBackend()
    {


        if (!defined('TL_MODE')) {
            define('TL_MODE', 'BE');
        }
        $GLOBALS['TL_LANG']['FMD']['contao-disqus-comments'][0] = 'Disqus';
        $model       = $this->createMock(ModuleModel::class);
        $model->id   = 1;
        $model->type = 'contao-disqus-comments';
        Config::set('debugMode', false);
        $module = $this->getMockBuilder(DisqusCommentsModule::class)->disableOriginalConstructor()->setMethods(null)->getMock();
        $this->assertNull($module->generate());
    }

    public function testFrontend()
    {
        if (!defined('TL_MODE')) {
            \define('TL_MODE', 'FE');
        }
        $module = $this->getMockBuilder(DisqusCommentsModule::class)->disableOriginalConstructor()->disableOriginalClone()->setMethods(["parentGenerate"])->getMock();
        $module->expects($this->once())->method('parentGenerate')->willReturn(null);

        $templateMock = new \stdClass();
        $module->Template = $templateMock;
        $module->disqus_shortname = "disqusShortname";
        $module->disqus_identifier = "disqusIdent-{id}";
        $this->assertNull($module->generate());

        $GLOBALS['objPage'] = (object) ["id" => 5];

    }

}
<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Test\DependencyInjection;


use HeimrichHannot\ContaoDisqusBundle\DependencyInjection\HeimrichHannotContaoDisqusExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class HeimrichHannotContaoDisqusExtensionTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $container = new ContainerBuilder(new ParameterBag(['kernel.debug' => false]));
        $extension = new HeimrichHannotContaoDisqusExtension();
        $extension->load([], $container);
    }
    /**
     * Tests the object instantiation.
     */
    public function testCanBeInstantiated()
    {
        $extension = new HeimrichHannotContaoDisqusExtension();
        $this->assertInstanceOf(HeimrichHannotContaoDisqusExtension::class, $extension);
    }
}
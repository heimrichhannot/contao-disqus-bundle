<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoDisqusBundle\Test;


use HeimrichHannot\ContaoDisqusBundle\HeimrichHannotContaoDisqusBundle;
use PHPUnit\Framework\TestCase;

class HeimrichHannotContaoDisqusBundleTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(HeimrichHannotContaoDisqusBundle::class, new HeimrichHannotContaoDisqusBundle());
    }
}
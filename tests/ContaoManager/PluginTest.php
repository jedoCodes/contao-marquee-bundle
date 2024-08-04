<?php

declare(strict_types=1);

/**
 * Contao Marquee bundle for Contao Open Source CMS
 * Copyright (c) 2024 jedoCodes
 *
 * @category ContaoBundle
 * @package  jedocodes/contao-css-marquee-bundle
 * @author   jedo.Codes <dev@jedo.codes>
 * @link     https://github.com/jedocodes/contao-marquee-bundle
 */

namespace Jedocodes\ContaoMarqueeBundle\Tests\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\DelegatingParser;
use Contao\TestCase\ContaoTestCase;
use Jedocodes\ContaoCssMarqueeBundle\ContaoManager\Plugin;
use Jedocodes\ContaoCssMarqueeBundle\JedoCodesMarqueeBundle;

/**
 * @package Jedocodes\ContaoCssMarqueeBundle\Tests\ContaoManager
 */
class PluginTest extends ContaoTestCase
{
    /**
     * Test Contao manager plugin class instantiation
     */
    public function testInstantiation(): void
    {
        $this->assertInstanceOf(Plugin::class, new Plugin());
    }

    /**
     * Test returns the bundles
     */
    public function testGetBundles(): void
    {
        $plugin = new Plugin();

        /** @var array $bundles */
        $bundles = $plugin->getBundles(new DelegatingParser());

        $this->assertCount(1, $bundles);
        $this->assertInstanceOf(BundleConfig::class, $bundles[0]);
        $this->assertSame(JedoCodesMarqueeBundle::class, $bundles[0]->getName());
        $this->assertSame([ContaoCoreBundle::class], $bundles[0]->getLoadAfter());
    }

}

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

namespace Jedocodes\ContaoMarqueeBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Jedocodes\ContaoMarqueeBundle\JedoCodesMarqueeBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(JedoCodesMarqueeBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class
                ]),
        ];
    }
}

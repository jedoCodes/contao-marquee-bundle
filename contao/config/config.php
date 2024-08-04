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


use Contao\System;
use Symfony\Component\HttpFoundation\Request;

if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('')))
{
    $GLOBALS['TL_CSS']['marquee'] = '/bundles/jedocodesmarquee/css/marquee_backend.css';
}

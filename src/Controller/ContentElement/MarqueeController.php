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

namespace Jedocodes\ContaoMarqueeBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\System;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'media', template: 'content_element/marquee', nestedFragments: false)]
class MarqueeController extends AbstractContentElementController
{
    public const string TYPE = 'marquee';

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {

        $template->set('marquee_customspeed',"");

        if ( $model->marqueeType === "marqueeGalerie") {
            // Process multiSRC
            if ($model->multiSRC) {

                $size = StringUtil::deserialize($model->size,true);

                $figureBuilder = System::getContainer()
                    ->get('contao.image.studio')
                    ->createFigureBuilder()
                    ->setSize([$size[0], $size[1], $size[2]]);

                $images = [];
                $multiSRC = StringUtil::deserialize($model->multiSRC,true);

                if (!empty($multiSRC) && \is_array($multiSRC)) {
                    $files = FilesModel::findMultipleByUuids($multiSRC);
                    $projectDir = System::getContainer()->getParameter('kernel.project_dir');

                    if ($files !== null) {
                        while ($files->next()) {

                            if (file_exists(Path::join($projectDir, $files->path))) {

                                $figure = $figureBuilder
                                    ->fromUuid($files->uuid)
                                    ->build();

                                $images[] = $figure;
                            }
                        }
                    }
                }

                $template->set('images', $images);
            }
        } elseif ($model->marqueeType === "marqueeText") {
            if ($model->marqueeListItems) {

                $marqueeListItems = StringUtil::deserialize($model->marqueeListItems,true);

                $template->set('items', $marqueeListItems);
            }
        }


        $template->set('marquee_id',  ' id=\"marquee_'.$model->id.'\"');
        $template->set('marquee_typ',$model->marqueeType);
        $template->set('marquee_rotate', $model->marqueeRotate);
        $template->set('marquee_direction', $model->marqueeDirection);
        $template->set('marquee_speed',$model->marqueeSpeed);

        if ( $model->marqueeSpeed === "custom") {
            $template->set('marquee_customSpeed', '--_animation-duration: '. $model->marqueeCustomSpeed . 's;');
        } else {
            $template->set('marquee_customSpeed', '');
        }

        return $template->getResponse();
    }

}

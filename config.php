<?php

use EFraneCom\Builder\ProjectItem;
use TightenCo\Jigsaw\Collection\CollectionItem;

return [
    'production'  => false,
    'baseUrl'     => '',
    'collections' => [
        'projects' => [
            'path' => 'projects',
            'sort' => 'name',
            'map'  => static function (CollectionItem $project) {
                return ProjectItem::fromItem($project);
            },
        ],
    ],
];

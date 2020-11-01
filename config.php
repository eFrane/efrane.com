<?php

use EFraneCom\Builder\ProjectItem;
use Illuminate\Support\Str;
use TightenCo\Jigsaw\Collection\CollectionItem;

/**
 * Snake case a string aka cheapy url slugging
 *
 * @param string $str
 * @return string
 */
function snake(string $str): string {
    return Str::snake($str);
}

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

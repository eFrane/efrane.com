<?php

use Illuminate\Support\Str;

return [
    'production' => false,
    'baseUrl' => '',
    'collections' => [
        'projects' =>[
            'path' => 'projects',
            'sort' => 'name',
            'map' => static function ($project) {
                return Project::fromItem($project);
            }
        ]
    ],
];

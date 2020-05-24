<?php

use EFraneCom\Builder\InlineStyles;

/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->afterBuild(InlineStyles::class);

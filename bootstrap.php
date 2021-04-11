<?php

use EFraneCom\Builder\ContributionsGraphUpdater;
use EFraneCom\Builder\InlineStyles;

/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$events->beforeBuild(ContributionsGraphUpdater::class);
$events->afterBuild(InlineStyles::class);

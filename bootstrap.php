<?php

use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

 $events->afterBuild(static function (Jigsaw $jigsaw) {
    $indexHTMLPath = $jigsaw->getDestinationPath() . DIRECTORY_SEPARATOR . 'index.html';
    $indexHTML = simplexml_load_file($indexHTMLPath);

    $cssPath = $jigsaw->getDestinationPath() . (string)$indexHTML->head->style['data-src'];

    $cssContents = file_get_contents($cssPath);

    $indexHTML->head->style = $cssContents;

    file_put_contents($indexHTMLPath, $indexHTML->asXML());
 });

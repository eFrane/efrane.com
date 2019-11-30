<?php

use TightenCo\Jigsaw\Jigsaw;
use Symfony\Component\Finder\Finder;

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

/**
 * Inline style
 *
 * @param Jigsaw $jigsaw
 * @param string $htmlFilePath
 * @return void
 */
function inlineStyle(Jigsaw $jigsaw, string $htmlFilePath) {
  $htmlFile = simplexml_load_file($htmlFilePath);

  $cssPath = $jigsaw->getDestinationPath() . (string)$htmlFile->head->style['data-src'];

  $cssContents = file_get_contents($cssPath);

  $htmlFile->head->style = $cssContents;

  file_put_contents($htmlFilePath, $htmlFile->asXML());
}

$events->afterBuild(static function (Jigsaw $jigsaw) {
  if (true === $jigsaw->getConfig('production')) {
    $htmlFilesFinder = Finder::create()
      ->in($jigsaw->getDestinationPath())
      ->name('*.html')
      ->files();

    foreach ($htmlFilesFinder as $htmlFile) {
      inlineStyle($jigsaw, $htmlFile->getRealPath());
    }
  }
});

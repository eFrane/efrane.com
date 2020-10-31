<?php

namespace EFraneCom\Builder;

use SplFileInfo;
use Symfony\Component\Finder\Finder;
use TightenCo\Jigsaw\Jigsaw;

class InlineStyles implements BuilderInterface {
    public function handle(Jigsaw $jigsaw)
    {
        if (true === $jigsaw->getConfig('production')) {
            $this->inlineStyles($jigsaw);
        }
    }

    /**
     * @param Jigsaw $jigsaw
     */
    private function inlineStyles(Jigsaw $jigsaw): void
    {
        $htmlFilesFinder = Finder::create()
            ->in($jigsaw->getDestinationPath())
            ->name('*.html')
            ->files();

        foreach ($htmlFilesFinder as $htmlFile) {
            /** @var SplFileInfo $htmlFile */
            $this->inlineStyle($jigsaw, $htmlFile->getRealPath());
        }
    }

    /**
     * Inline style
     *
     * @param Jigsaw $jigsaw
     * @param string $htmlFilePath
     * @return void
     */
    private function inlineStyle(Jigsaw $jigsaw, string $htmlFilePath): void
    {
        $htmlFile = simplexml_load_file($htmlFilePath);

        $cssPath = $jigsaw->getDestinationPath() . (string)$htmlFile->head->style['data-src'];

        $cssContents = file_get_contents($cssPath);

        $htmlFile->head->style = $cssContents;

        file_put_contents($htmlFilePath, $htmlFile->asXML());
    }
}

<?php

namespace EFraneCom\Builder;

use TightenCo\Jigsaw\Jigsaw;

interface BuilderInterface {
    public function handle(Jigsaw $jigsaw);
}

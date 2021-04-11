<?php


namespace EFraneCom\Builder;


use Illuminate\Cache\FileStore;
use Illuminate\Cache\Repository;
use Illuminate\Filesystem\Filesystem;

trait UsesCaching
{
    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    private function initCache(): void
    {
        $store = new FileStore(new Filesystem(), '.cache');

        $this->cache = new Repository($store);
    }
}

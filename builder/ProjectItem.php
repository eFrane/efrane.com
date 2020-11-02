<?php
/**
 * @copyright 2020
 * @author Stefan "eFrane" Graupner <stefan.graupner@gmail.com>
 */

namespace EFraneCom\Builder;


use Carbon\Carbon;
use Illuminate\Cache\FileStore;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Filesystem\Filesystem;
use TightenCo\Jigsaw\Collection\CollectionItem;

class ProjectItem extends CollectionItem
{
    const SECONDS_PER_WEEK = 604800;
    /**
     * @var string
     */
    protected $snakeName;

    /**
     * @var int
     */
    protected $downloadCount = 0;

    /**
     * @var Repository
     */
    protected $cache;

    public static function fromItem(CollectionItem $item): CollectionItem
    {
        $project = parent::fromItem($item);

        $project->initCache();
        $project->loadDownlads();

        return $project;
    }

    public function getRoundedDownloadCount(): string
    {
        $suffixes = [
            0 => '',
            1 => 'k',
            2 => 'M',
            3 => 'B',
            4 => 'T',
        ];

        $magnitude = intdiv((int)floor(log10($this->downloadCount)), 3);

        return sprintf(
            '%d%s',
            floor($this->downloadCount / (10 ** (3 * $magnitude))),
            $suffixes[$magnitude]
        );
    }

    public function hasDownloadCount(): bool
    {
        return 0 < $this->downloadCount;
    }

    private function initCache(): void {
        $store = new FileStore(new Filesystem(), '.cache');

        $this->cache = new \Illuminate\Cache\Repository($store);
    }

    private function loadDownlads(): void
    {
        if ($this->has('composer')) {
            $this->fetchComposerDownloadCount();
        }

        if ($this->has('npm')) {
            $this->fetchNpmDownloadCount();
        }
    }

    private function fetchComposerDownloadCount(): void
    {
        $composerPackage = $this->get('composer');

        $this->doFetchComposerDownloadCount($composerPackage);

        $this->downloadCount = $this->cache->remember(
            'downloads.composer.'.$composerPackage,
            self::SECONDS_PER_WEEK,
            function () use ($composerPackage) {
                return $this->doFetchComposerDownloadCount($composerPackage);
            }
        );
    }

    private function fetchNpmDownloadCount(): void
    {
        $npmPackage = $this->get('npm');

        $this->downloadCount = $this->cache->remember(
            'downloads.npm.'.$npmPackage,
            self::SECONDS_PER_WEEK,
            function () use ($npmPackage) {
                return $this->doFetchNpmPackageCount($npmPackage);
            }
        );
    }

    private function getDecodedJson(string $url): array
    {
        $data = file_get_contents($url);

        return json_decode($data, true);
    }

    private function doFetchComposerDownloadCount(string $composerPackage): int
    {
        $composerStats = $this->getDecodedJson("https://packagist.org/packages/{$composerPackage}/stats.json");

        return $composerStats['downloads']['total'];
    }

    private function doFetchNpmPackageCount(string $npmPackage): int
    {
        $packageInfo = $this->getDecodedJson("https://registry.npmjs.org/{$npmPackage}");

        $created = Carbon::parse($packageInfo['time']['created']);

        $start = clone $created;
        $start->day = 1;

        $end = Carbon::now();
        $end->day = $end->daysInMonth;

        $total = 0;

        while ($start->lessThan($end)) {
            $formattedStart = $start->format('Ymd');
            $formattedInterval = $start->addDays($start->daysInMonth)->format('Ymd');

            $downloadsUrl = sprintf(
                'https://api.npmjs.org/downloads/range/%s:%s/%s',
                $formattedStart,
                $formattedInterval,
                $npmPackage
            );

            $monthlyStats = $this->getDecodedJson($downloadsUrl);

            $total += array_reduce(
                $monthlyStats['downloads'],
                static function (int $carry, array $day) {
                    return $carry + $day['downloads'];
                },
                0
            );
        }

        return $total;
    }
}

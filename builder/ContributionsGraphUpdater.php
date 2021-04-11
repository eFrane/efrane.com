<?php


namespace EFraneCom\Builder;


use Symfony\Component\HttpClient\HttpClient;
use TightenCo\Jigsaw\Jigsaw;

class ContributionsGraphUpdater implements BuilderInterface
{
    use UsesCaching;

    /**
     * @const int Cache download counts for a week
     */
    private const DOWNLOAD_CACHE_DURATION = 604800;

    public function handle(Jigsaw $jigsaw)
    {
        $apiToken = getenv('GITHUB_API_TOKEN');
        if (false === $apiToken || !is_string($apiToken)) {
            throw new \RuntimeException('GITHUB_API_TOKEN is not configured, aborting.');
        }

        $this->initCache();

        $contributionsData = $this->cache->remember('contributions.graph.data', self::DOWNLOAD_CACHE_DURATION, function () use ($apiToken) {
            return $this->fetchContributionsFromGitHub($apiToken);
        });

        $weeks = $contributionsData['data']['viewer']['contributionsCollection']['contributionCalendar']['weeks'];
        $firstWeekStart = $weeks[0]['firstDay'];
        $lastWeekStart = $weeks[count($weeks) - 1]['firstDay'];

        $contributionsPerDay = collect($weeks)
            ->flatMap(static function ($week) {
                return $week['contributionDays'];
            })
            ->map(static function ($day) {
                return $day['contributionCount'];
            })
            ->toArray();

        $maxContributions = max($contributionsPerDay);

        $imageHeight = 64;
        $imageWidth = 2048;

        $image = imagecreate($imageWidth, $imageHeight);

        $white = imagecolorallocate($image, 0xff, 0xff, 0xff);
        $lightGreen = imagecolorallocate($image, 0x82, 0x83, 0x5c);
        $darkGreen = imagecolorallocate($image, 0x3b, 0x48, 0x2e);

        imagefill($image, 1, 1, $white);
        imagecolortransparent($image, $white);

        $graphHeight = $imageHeight - 8;

        $previousY = $graphHeight;
        $previousX = 0;

        foreach ($contributionsPerDay as $i => $contributionCount) {

            $nextY = $graphHeight - (int) (($contributionCount / $maxContributions) * $graphHeight);
            $nextX = (int) ((($i + 1) / count($contributionsPerDay)) * $imageWidth);

            imageline($image, $previousX, $previousY, $nextX, $nextY, $darkGreen);

            $previousY = $nextY;
            $previousX = $nextX;
        }

        imagefilltoborder($image, 1, $graphHeight + 1, $darkGreen, $lightGreen);

        imagepng($image, 'source/assets/images/contributionsgraph.png');

        $jigsaw->setConfig('contributionsStart', $firstWeekStart);
        $jigsaw->setConfig('contributionsEnd', $lastWeekStart);
    }

    /**
     * It's intended that this throws all the http exceptions as the website update
     * is supposed to not happen if the contribution graph cannot be updated.
     *
     * @param string $apiToken
     * @return mixed
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    private function fetchContributionsFromGitHub(string $apiToken)
    {
        $client = HttpClient::createForBaseUri('https://api.github.com');
        $query = json_encode(
            [
                'query' => 'query { viewer { contributionsCollection { contributionCalendar { weeks { firstDay, contributionDays { contributionCount } } } } } }'
            ]
        );

        $response = $client->request(
            'POST',
            '/graphql',
            [
                'auth_bearer' => $apiToken,
                'body'        => $query
            ]
        );

        $responseData = json_decode($response->getContent(), true);

        return $responseData;
    }
}

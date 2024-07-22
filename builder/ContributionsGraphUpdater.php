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

        echo "Updating contributions graph data...\n";
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

        echo "Generating contribution graph...\n";
        $maxContributions = max($contributionsPerDay);

        $imageHeight = 64;
        $imageWidth = 2048;

        $graphHeight = $imageHeight - 2;
        $graphStart = 0;
        $graphEnd = $imageWidth;

        $svgLine = "M {$graphStart},{$graphHeight} ";

        foreach ($contributionsPerDay as $day => $contributionCount) {
            $nextY = $graphHeight - (int) (($contributionCount / $maxContributions) * $graphHeight);
            $nextX = (int) ((($day + 1) / count($contributionsPerDay)) * $graphEnd);

            $svgLine .= "{$nextX},{$nextY} ";
        }

        $svgLine .= "M {$graphEnd},{$graphHeight}";

        $svg = <<<SVG
<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" width="{$imageWidth}" height="{$imageHeight}" viewBox="0 0 {$imageWidth} {$imageHeight}">
    <g>
        <path d="{$svgLine}" fill="#3b482e" stroke="#82835c" stroke-width="0.5"/>
    </g>
</svg>
SVG;

        file_put_contents('source/assets/images/contributions-graph.svg', $svg);

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
        echo "Fetching contribution data from GitHub...\n";

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

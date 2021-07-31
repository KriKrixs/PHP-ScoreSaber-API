<?php

namespace KriKrixs;

class ScoreSaberAPI
{
    const OLD_SCORESABER_URL = "https://scoresaber.com/api.php";
    const NEW_SCORESABER_URL = "https://new.scoresaber.com/api";

    private string $userAgent;

    /**
     * ScoreSaberAPI constructor
     * @param string $userAgent User Agent to provide to ScoreSaber API
     */
    public function __construct(string $userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Private calling API function
     * @param string $endpoint
     * @return string|null
     */
    private function callAPI(string $endpoint, bool $useOld): ?string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => ($useOld ? self::OLD_SCORESABER_URL : self::NEW_SCORESABER_URL) . $endpoint,
            CURLOPT_USERAGENT => $this->userAgent,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    /**
     * Private building response functions
     * @param string $endpoint
     * @return array
     */
    private function buildResponse(string $endpoint, bool $useOld): array
    {
        $apiResult = $this->callAPI($endpoint, $useOld);

        return [
            "error" => $apiResult === false,
            "result" => json_decode($apiResult, true)
        ];
    }

    /**
     * [OLD API] Get Maps
     * @param bool $rankedOnly Do you want ranked map only or not
     * @param int $sortBy 0 = Trending (Doesn't seems to work) | 1 = Ranked date | 2 = Numbers of scores set | 3 = Star rating | 4 = Author
     * @param int $limit Limit of map you want
     * @param string $mapName Not required. Map name you want to search
     * @return array
     */
    public function getMaps(bool $rankedOnly, int $sortBy, int $limit, string $mapName = ""): array
    {
        return $this->buildResponse("?function=get-leaderboards&page=1&ranked=" . (int)$rankedOnly . "&cat=" . $sortBy . "&limit=" . $limit . ($mapName !== "" ? "&search=" . $mapName : ""), true);
    }

    /**
     * [NEW API] Get Global Leaderboards
     * @param int $page 50 players per page
     * @return array
     */
    public function getGlobalLeaderboards(int $page): array
    {
        return $this->buildResponse("/players/" . $page, false);
    }

    /**
     * [NEW API] Get basic or full player's infos
     * @param int $playerId Player's ScoreSaber id
     * @param bool $wantFullInfo If you want basic (false) or full (true) player's infos
     * @return array
     */
    public function getPlayerInfos(string $playerId, bool $wantFullInfo): array
    {
        return $this->buildResponse("/player/" . $playerId . "/" . ($wantFullInfo ? "full" : "basic"), false);
    }

    /**
     * [NEW API] Get recent or top player's scores
     * @param int $playerId Player's ScoreSaber id
     * @param bool $wantTopScores If you want recent (false) or top (true) player's scores
     * @param int $page 8 scores per page
     * @return array
     */
    public function getPlayerScores(string $playerId, bool $wantTopScores, int $page): array
    {
        return $this->buildResponse("/player/" . $playerId . "/scores/" . ($wantTopScores ? "top" : "recent") . "/" . $page, false);
    }
}
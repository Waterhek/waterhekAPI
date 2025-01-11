<?php
namespace App\Services\Sports;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SoccerService
{
    protected $base_url;
    protected $api_token;

    public function __construct()
    {
        $this->base_url = "https://api-football-v1.p.rapidapi.com/v3";
        $this->api_token = "cff5e35ca8msh27539694cc504bfp13704fjsn4c0d97d707cd";
    }

    public function getFixtures($date="2024-12-30")
    {
        $url = "/fixtures?date=" . $date;
        return $this->fetchData("fixtures_" . $date, $url);
    }

    private function fetchData($cacheKey, $url)
    {
        return Cache::remember($cacheKey, 3600, function () use ($url) {
            try {
                $response = Http::withHeaders([
                    "x-rapidapi-host" => "api-football-v1.p.rapidapi.com",
		            "x-rapidapi-key" => $api_token
                ])->get($this->base_url . $url);

                if ($response->failed()) {
                    throw new \Exception('Failed to fetch data: ' . $response->body());
                }

                $data = $response->json();

                if (empty($data)) {
                    \Log::error('API returned empty data.');
                    return null;
                }

                return $data;
            } catch (\Exception $e) {
                \Log::error('Error fetching data: ' . $e->getMessage());
                return null;
            }
        });
    }
}
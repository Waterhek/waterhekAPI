<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ClashOfClansService
{
    protected $base_url;
    protected $api_token;

    public function __construct()
    {
        $this->base_url = config('services.clash_of_clans.base_url');
        $this->api_token = config('services.clash_of_clans.api_token');
    }

    public function getPlayer($playerTag)
    {
        $cacheKey = "player_{$playerTag}";
        $url = "/players/" . urlencode($playerTag);

        return $this->fetchData($cacheKey, $url);
    }

    public function getClans($clanTag)
    {
        $cacheKey = "clan_{$clanTag}";
        $url = "/clans/" . urlencode($clanTag);

        return $this->fetchData($cacheKey, $url);
    }

    private function fetchData($cacheKey, $url)
    {
        return Cache::remember($cacheKey, 3600, function () use ($url) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->api_token
                ])->get($this->base_url . $url);

                if ($response->failed()) {
                    throw new \Exception('Failed to fetch data: ' . $response->body());
                }

                return $response->json();
            } catch (\Exception $e) {
                \Log::error('Error fetching data: ' . $e->getMessage());
                return null;
            }
        });
    }
}
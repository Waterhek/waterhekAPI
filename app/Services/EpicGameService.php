<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class EpicGameService
{
    protected $base_url;
    protected $api_key;
    protected $api_host;


    public function __construct()
    {
        $this->base_url = config('services.epic_game.base_url');
        $this->api_key = config('services.epic_game.api_key');
        $this->api_host = config('services.epic_game.api_host');
    }

    public function getFreeGames($country = 'US', $locale = 'en')
    {
        $cacheKey = "epic_free_games_{$country}_{$locale}";
        $url = "/getFreeGames/country/{$country}/locale/{$locale}";

        return Cache::remember($cacheKey, 3600, function () use ($url) {
            try {
                $response = Http::withHeaders([
                    'X-Rapidapi-Key' => $this->api_key,
                    'X-Rapidapi-Host' => $this->api_host
                ])->get($this->base_url . $url);

                if ($response->failed()) {
                    throw new \Exception('Failed to fetch data: ' . $response->body());
                }

                $data = $response->json();
                return $this->processFreeGamesData($data);
            } catch (\Exception $e) {
                \Log::error('Error fetching data: ' . $e->getMessage());
                return null;
            }
        });
    }

    private function processFreeGamesData($data)
    {
        $freeGames = [];

        if (isset($data['Catalog']['searchStore']['elements'])) {
            foreach ($data['Catalog']['searchStore']['elements'] as $game) {
                $freeGames[] = [
                    'title' => $game['title'],
                    'id' => $game['id'],
                    'description' => $game['description'],
                    'seller' => $game['seller']['name'],
                    'price' => $game['price']['totalPrice']['discountPrice'],
                    'currency' => $game['price']['totalPrice']['currencyCode'],
                    'promotions' => $game['promotions']['promotionalOffers'] ?? []
                ];
            }
        }

        return $freeGames;
    }
}
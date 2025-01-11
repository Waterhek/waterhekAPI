<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\GenshinEvent;

class GenshinImpactService
{
    //protected $base_url;
    //protected $api_token;

    public function __construct()
    {
        //$this->base_url = config('services.clash_of_clans.base_url');
        //$this->api_token = config('services.clash_of_clans.api_token');
    }

    public function getCurrentEvents()
    {
        $url = 'https://genshin-impact.fandom.com/wiki/Event';
        $response = Http::get($url);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch event data');
        }

        $crawler = new Crawler($response->body());
        $events = [];

        $crawler->filter('table.wikitable:first-of-type tbody tr')->each(function ($row, $i) use (&$events) {
            if ($i === 0) return; // Skip header row

            $columns = $row->filter('td');

            if ($columns->count() < 3) {
                return;
            }

            $duration = $columns->eq(1)->attr('data-sort-value');

            $startString = substr($duration, 0, 19);
            $endString = substr($duration, 19);

            try {
                $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $startString);
                $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $endString);

            } catch (\Exception $e) {
                \Log::error('Error parsing dates: ' . $e->getMessage());
                return;
            }

                $events[] = [
                    'name' => trim($columns->eq(0)->text()),
                    'type' => trim($columns->eq(2)->text()),
                    'start_date' => $startDate ?? null,
                    'end_date' => $endDate ?? null,
                ];

            return null;
        });

        foreach($events as $event){
            GenshinEvent::updateOrCreate([
                'name' => $event['name'],
                'type' => $event['type'],
                'start_date' => $event['start_date'],
                'end_date' => $event['end_date']
            ]);
        }
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EpicGameService;

class EpicGameController extends Controller
{
    protected $epicGameService;

    public function __construct(EpicGameService $epicGameService)
    {
        $this->epicGameService = $epicGameService;
    }

    public function getFreeGames(Request $request)
    {
        $country = $request->input('country', 'US');
        $locale = $request->input('locale', 'en');

        $freeGames = $this->epicGameService->getFreeGames($country, $locale);

        if (!$freeGames) {
            return response()->json(['error' => 'Unable to fetch free games data'], 503);
        }

        return response()->json($freeGames);
    }
}

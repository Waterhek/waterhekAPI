<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Services\Sports\SoccerService;

class SoccerController extends BaseController
{
    protected $soccerService;

    public function __construct(SoccerService $soccerService)
    {
        $this->soccerService = $soccerService;
    }

    public function fixtures()
    {
        $fixtures = $this->soccerService->getFixtures();

        return $this->sendResponse($fixtures, 'Fixtures retrieved successfully.');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GenshinImpactService;

class FetchGenshinEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genshin:fetch-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch current Genshin Impact events';

    /**
     * Execute the console command.
     */
    public function handle(GenshinImpactService $genshinImpactService)
    {
        try {
            $events = $genshinImpactService->getCurrentEvents();
            $this->info('Successfully fetched Genshin Impact events.');
        } catch (\Exception $e) {
            $this->error('Failed to fetch Genshin Impact events: ' . $e->getMessage());
        }
    }
}

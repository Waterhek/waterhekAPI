<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClashOfClansService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ClashOfClansController extends Controller
{
    protected $clashOfClansService;

    public function __construct(ClashOfClansService $clashOfClansService)
    {
        $this->clashOfClansService = $clashOfClansService;
    }

    public function getPlayer($playerTag)
    {
        // Create a unique cache key based on the player tag
        $cacheKey = "player_{$playerTag}";

        $url = "/players/" . urlencode($playerTag);

        $playerData = Cache::get($cacheKey);

        if (!$playerData) {
            try {
                // Make the API request
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImJhM2E1MjVmLTBhNWUtNDc5Yy1hNGJlLTJkYzc3OTY5N2JhYSIsImlhdCI6MTczNDA3NzIwNCwic3ViIjoiZGV2ZWxvcGVyLzU3ZWM2MGYxLTVkYjgtMjBjNS1mMWM5LTU2MmIxMWM2MWI0YiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjIwMi4xODQuNDMuODEiXSwidHlwZSI6ImNsaWVudCJ9XX0.v_uSL1w2Tc1zYssJBOsns1R58IJe9CUTPOv2pRNKQAUNI46kDXpvABslvBc2n9hPc5OMMKj2sWpHTqDthtV1Tw" // Add Bearer token here
                ])->get($this->base_url . $url);
        
                // Check if the request failed (non-2xx status)
                if ($response->failed()) {
                    // Log the error message and status code for debugging
                    $errorMessage = $response->body(); // Get the raw response body
                    $statusCode = $response->status(); // Get the status code

                    // You can customize the response to return a more user-friendly message
                    abort(503, "Service Unavailable: API request failed.");
                }

                // Return the successful response as a JSON array
                $playerData = $response->json();

                Cache::put($cacheKey, $playerData, 3600);
        
            } catch (\Exception $e) {
                // Catch any unexpected errors (e.g., network issues, timeouts)
                info("API Request Error: " . $e->getMessage());
                
                // Optionally, you can also log the stack trace for debugging
                info($e->getTraceAsString());
                
                // Handle the error gracefully (e.g., show a generic error message)
                abort(503, "Service Unavailable: API request error.");
            }
        }

        return $playerData;
    }
}

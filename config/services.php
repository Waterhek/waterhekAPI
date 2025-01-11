<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'clash_of_clans' => [
        'base_url' => env('CLASH_OF_CLANS_BASE_URL', 'https://api.clashofclans.com/v1'),
        'api_token' => env('CLASH_OF_CLANS_API_TOKEN'),
    ],

    'epic_game' => [
        'base_url' => env('EPIC_GAMES_BASE_URL', 'https://epic-games-store.p.rapidapi.com/getFreeGames/country/US/locale/en'),
        'api_key' => env('EPIC_GAMES_API_KEY'),
        'api_host' => env('EPIC_GAMES_API_HOST', 'epic-games-store.p.rapidapi.com'),
    ],
];

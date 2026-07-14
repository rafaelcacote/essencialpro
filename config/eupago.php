<?php

return [
    'base_url' => env('EUPAGO_BASE_URL', 'https://sandbox.eupago.pt'),
    'api_key' => env('EUPAGO_API_KEY', ''),
    'currency' => 'EUR',
    'webhook_secret' => env('EUPAGO_WEBHOOK_SECRET', ''),
];

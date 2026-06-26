<?php

return [
    'base_url'   => env('EASYPAY_BASE_URL', 'https://api.easypay.pt/2.0'),
    'account_id' => env('EASYPAY_ACCOUNT_ID', ''),
    'api_key'    => env('EASYPAY_API_KEY', ''),

    /*
    | Métodos de pagamento aceites.
    | Opções: cc (cartão), mb (Multibanco), mbw (MB WAY), dd (débito direto),
    |         vi (Visa), uf (transferência), sc (Santander)
    */
    'methods' => explode(',', env('EASYPAY_METHODS', 'cc,mb,mbw')),
];

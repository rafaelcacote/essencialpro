<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Frete — Portugal Continental
    |--------------------------------------------------------------------------
    | O limiar de portes gratuitos compara o subtotal sem IVA.
    | Abaixo do limiar cobra-se a taxa líquida (s/ IVA); o IVA aplica-se depois.
    */
    'free_shipping_threshold' => 80.00,
    'shipping_fee' => 5.90,

    /*
    |--------------------------------------------------------------------------
    | IVA
    |--------------------------------------------------------------------------
    */
    'tax_rate' => 0.23,
];

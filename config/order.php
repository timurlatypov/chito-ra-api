<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cart configs
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'min_amount' => env('ORDER_MIN_AMOUNT', 100000),
    'start_time' => env('ORDER_START_TIME', '11:00'),
    'end_time'   => env('ORDER_END_TIME', '21:30'),
];

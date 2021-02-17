<?php
include __DIR__ . "/../vendor/autoload.php";

use leifermendez\paypal\PaypalSubscription;

/**
 * Example for get all products form paypal
 */

$app_id = 'Abdm_8AxJzGlxTVIUTuDQb9Y_qePB5U_tPFXgjzmJYw8MKVae2x84lxSxJpbhUCTTdKt2S-e27BKFEjg';
$app_sk = 'EKTQSjIz_9NDqs4vOWLFaCUn2gi0KSsMYlHjER3Ky2bCLaylosep7_4A2iQvMFoWVuqKrlzjAVeFM9b5';

$pp = new PaypalSubscription($app_id, $app_sk);


/**
 * For more detail about
 * https://developer.paypal.com/docs/api/catalog-products/v1/#products_create
 */

$subscription = [
    'start_time' => '2022-11-01T00:00:00Z',
    'quantity' => '1',
    'shipping_amount' => [
        'currency_code' => 'USD',
        'value' => '10'
    ],
    'subscriber' => [
        'name' => [
            'given_name' => 'Leifer',
            'surname' => 'Mendez'
        ],
        'email_address' => 'leifer@test.com',
        'shipping_address' => [
            'name' => [
                'full_name' => 'Joe'
            ],
            'address' => [
                'address_line_1' => '2211 N First Street',
                'address_line_2' => 'Building  17',
                'admin_area_2' => 'San Jose',
                'admin_area_1' => 'CA',
                'postal_code' => '95131',
                'country_code' => 'US'
            ]
        ]
    ],
    'application_context' => [
        'brand_name' => 'Racks',
        'locale' => 'es-ES',
        'shipping_preference' => 'SET_PROVIDED_ADDRESS',
        'user_action' => 'SUBSCRIBE_NOW',
        'payment_method' => [
            'payer_selected' => 'PAYPAL',
            'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED',
        ],
        'return_url' => 'https://github.com/leifermendez?status=returnSuccess',
        'cancel_url' => 'https://github.com/leifermendez?status=cancelUrl'

    ]
];

$plan = [
    'plan_id' => 'P-6LP13543ED649531TMAWPBHA'
];


$response = $pp->createSubscription($subscription, $plan);

/**
 * OUTPUT
 */
var_dump($response);


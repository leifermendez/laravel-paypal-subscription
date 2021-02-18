<?php
include __DIR__ . "/../vendor/autoload.php";

use leifermendez\paypal\PaypalSubscription;

/**
 * Example for Request GET Create Plan and Product
 */

$app_id = 'Abdm_8AxJzGlxTVIUTuDQb9Y_qePB5U_tPFXgjzmJYw8MKVae2x84lxSxJpbhUCTTdKt2S-e27BKFEjg';
$app_sk = 'EKTQSjIz_9NDqs4vOWLFaCUn2gi0KSsMYlHjER3Ky2bCLaylosep7_4A2iQvMFoWVuqKrlzjAVeFM9b5';
$mode = 'test';

$pp = new PaypalSubscription($app_id, $app_sk, $mode);

$product = [
    'name' => 'iPhone X',
    'description' => 'Awesome item, phone, etc',
    'type' => 'SERVICE',
    'category' => 'SOFTWARE',
    'image_url' => 'https://avatars.githubusercontent.com/u/15802366?s=460&u=ac6cc646599f2ed6c4699a74b15192a29177f85a&v=4',
    'home_url' => 'https://github.com/leifermendez',
];

$plan = [
    'name' => 'Video Streaming Service Plan',
    'description' => 'Video Streaming Service basic plan',
    'status' => 'ACTIVE',
    'billing_cycles' => [
        [
            'frequency' => [
                'interval_unit' => 'MONTH',
                'interval_count' => '1'
            ],
            'tenure_type' => 'REGULAR',
            'sequence' => '1',
            'total_cycles' => '12',
            'pricing_scheme' => [
                'fixed_price' => [
                    'value' => '3',
                    'currency_code' => 'USD'
                ]
            ]
        ]
    ],
    'payment_preferences' => [
        'auto_bill_outstanding' => 'true',
        'setup_fee' => [
            'value' => '10',
            'currency_code' => 'USD'
        ],
        'setup_fee_failure_action' => 'CONTINUE',
        'payment_failure_threshold' => '3'
    ],
    'taxes' => [
        'percentage' => '10',
        'inclusive' => false
    ]
];


$response = $pp->createPack($product, $plan);


/**
 * OUTPUT
 */
var_dump($response);


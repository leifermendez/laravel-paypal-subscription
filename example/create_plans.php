<?php
include __DIR__ . "/../vendor/autoload.php";

use leifermendez\paypal\PaypalSubscription;

/**
 * Example for get all products form paypal
 */

$helper = new \leifermendez\paypal\Helper();

$app_id = 'Abdm_8AxJzGlxTVIUTuDQb9Y_qePB5U_tPFXgjzmJYw8MKVae2x84lxSxJpbhUCTTdKt2S-e27BKFEjg';
$app_sk = 'EKTQSjIz_9NDqs4vOWLFaCUn2gi0KSsMYlHjER3Ky2bCLaylosep7_4A2iQvMFoWVuqKrlzjAVeFM9b5';

$pp = new PaypalSubscription($app_id, $app_sk);


/**
 * For more detail about
 * https://developer.paypal.com/docs/api/subscriptions/v1/#plans
 */


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

$product = [
    'product_id' => 'PROD-5C186753RC8244822'
];


$response = $pp->createPlan($plan, $product);

/**
 * OUTPUT
 */
var_dump($response);


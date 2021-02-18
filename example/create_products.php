<?php
include __DIR__ . "/../vendor/autoload.php";

use leifermendez\paypal\PaypalSubscription;

/**
 * Example for get all products form paypal
 */

$app_id = 'Abdm_8AxJzGlxTVIUTuDQb9Y_qePB5U_tPFXgjzmJYw8MKVae2x84lxSxJpbhUCTTdKt2S-e27BKFEjg';
$app_sk = 'EKTQSjIz_9NDqs4vOWLFaCUn2gi0KSsMYlHjER3Ky2bCLaylosep7_4A2iQvMFoWVuqKrlzjAVeFM9b5';
$mode = 'test';

$pp = new PaypalSubscription($app_id, $app_sk, $mode);


/**
 * For more detail about
 * https://developer.paypal.com/docs/api/catalog-products/v1/#products_create
 */

$product = [
    'name' => 'iPhone X',
    'description' => 'Awesome item, phone, etc',
    'type' => 'SERVICE',
    'category' => 'SOFTWARE',
    'image_url' => 'https://avatars.githubusercontent.com/u/15802366?s=460&u=ac6cc646599f2ed6c4699a74b15192a29177f85a&v=4',
    'home_url' => 'https://github.com/leifermendez',
];

$response = $pp->createProduct($product);

/**
 * OUTPUT
 */
var_dump($response);


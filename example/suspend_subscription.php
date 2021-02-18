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
 * https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_activate
 */

$id_subscription = 'I-25E9NV7WG2G3';


$response = $pp->suspendSubscription($id_subscription);

/**
 * OUTPUT
 */
var_dump($response);


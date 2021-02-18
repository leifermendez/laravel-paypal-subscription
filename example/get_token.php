<?php
include __DIR__ . "/../vendor/autoload.php";

use leifermendez\paypal\PaypalSubscription;

/**
 * Example for Request GET Bearer Token
 */

$app_id = 'Abdm_8AxJzGlxTVIUTuDQb9Y_qePB5U_tPFXgjzmJYw8MKVae2x84lxSxJpbhUCTTdKt2S-e27BKFEjg';
$app_sk = 'EKTQSjIz_9NDqs4vOWLFaCUn2gi0KSsMYlHjER3Ky2bCLaylosep7_4A2iQvMFoWVuqKrlzjAVeFM9b5';
$mode = 'test';

$pp = new PaypalSubscription($app_id, $app_sk, $mode);

$response = $pp->getToken();


/**
 * OUTPUT
 */
var_dump($response);


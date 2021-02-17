<?php

namespace leifermendez\paypal;

class ServicePaypalSubscription
{
    /**
     * @param $app_id
     * @param $app_sk
     * @param $mode
     * @return PaypalSubscription
     */
    public function to($app_id, $app_sk, $mode)
    {
        return new PaypalSubscription($app_id, $app_sk, $mode);
    }
}
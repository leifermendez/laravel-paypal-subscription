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
    public function to()
    {
        return new PaypalSubscription();
    }
}
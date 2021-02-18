<?php

namespace leifermendez\paypal;

use Illuminate\Support\Facades\Facade;

class PaypalSubscriptionFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PaypalSubscription';
    }
}
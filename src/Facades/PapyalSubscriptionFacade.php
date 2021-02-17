<?php

namespace leifermendez\stripe;

use Illuminate\Support\Facades\Facade;

class PapyalSubscriptionFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PaypalSubscription';
    }
}
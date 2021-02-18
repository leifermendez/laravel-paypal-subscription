<?php

namespace leifermendez\paypal;

use Illuminate\Support\ServiceProvider;

class ProviderPaypalSubscription extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('PaypalSubscription', function () {
            return new PaypalSubscription();
        }
        );
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array('PaypalSubscription');
    }
}
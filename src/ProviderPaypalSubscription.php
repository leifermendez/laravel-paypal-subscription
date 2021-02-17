<?php

namespace leifermendez\paypal;

use Illuminate\Support\ServiceProvider;

class ProviderPaypalSubscription extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('PaypalSubscription', function () {
            $app_id = env('PAYPAL_APP_ID');
            $app_sk = env('PAYPAL_APP_SK');
            $mode = env('PAYPAL_APP_MODE');
            return new PaypalSubscription($app_id, $app_sk, $mode);
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
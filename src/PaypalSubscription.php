<?php

namespace leifermendez\paypal;


use anlutro\cURL\cURL;
use Exception;

/**
 * Clase principal
 * Class PayPalLM
 * @package leifermendez\paypal
 */
class PaypalSubscription
{
    protected static $endpoint;
    protected static $app_id;
    protected static $app_sk;
    protected static $headers;
    protected static $helper;
    protected static $token;
    protected static $curl;

    public function __construct($app_id = null, $app_sk = null, $mode = null)
    {
        try {
            self::$curl = new cURL();
            $mode = $mode ?? env('PAYPAL_APP_MODE');
            self::$helper = new Helper();
            self::$endpoint = ($mode === 'test') ? 'https://api-m.sandbox.paypal.com/v1' : 'https://api-m.paypal.com/v1';
            self::$app_id = $app_id ?? env('PAYPAL_APP_ID');
            self::$app_sk = $app_sk ?? env('PAYPAL_APP_SK');
            self::$headers = [
                'User-Agent: PostmanRuntime/7.16.3',
            ];
            self::$token = $this->getToken();

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method for get Bearer token
     */

    public static function getToken()
    {
        try {
            $headers = [
                'Content-Type: application/x-www-form-urlencoded'
            ];
            $url = self::$endpoint . '/oauth2/token';
            $request = self::$curl->newRequest('post', $url, ['grant_type' => 'client_credentials'])
                ->setHeaders($headers)
                ->setUser(self::$app_id)
                ->setPass(self::$app_sk);

            $response = $request->send();

            return self::$helper->parseJson($response->body)['access_token'];

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For list all products created
     * @param string $token
     * @return string
     */

    public static function getProduct()
    {
        try {

            $url = self::$endpoint . '/catalogs/products?page_size=2&page=1&total_required=true';

            $request = self::$curl->newRequest('get', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For create a new product in Paypal
     * @param array $data
     * @return mixed|string
     */
    public static function createProduct($data = [])
    {
        try {
            if (empty($data)) {
                throw new Exception('PRODUCT_IS_EMPTY');
            }

            $url = self::$endpoint . '/catalogs/products';

            $request = self::$curl->newJsonRequest('post', $url, $data)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For get all plans in database
     * @return mixed|string
     */

    public static function getPlans()
    {
        try {

            $url = self::$endpoint . '/billing/plans';

            $request = self::$curl->newRequest('get', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For create a new plan in Paypal
     * @param array $data
     * @param array $product
     * @return mixed|string
     */

    public static function createPlan($data = [], $product = [])
    {
        try {

            $url = self::$endpoint . '/billing/plans';
            $data = array_merge($data, $product);
            $request = self::$curl->newJsonRequest('post', $url, $data)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For create a new subscription in Paypal
     * @param array $data
     * @param array $plan
     * @return mixed|string
     */

    public static function createSubscription($data = [], $plan = [])
    {
        try {

            $url = self::$endpoint . '/billing/subscriptions';
            $data = array_merge($data, $plan);
            $request = self::$curl->newJsonRequest('post', $url, $data)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For activate subscription in Paypal
     * @param $id
     * @return mixed|string
     */

    public static function activeSubscription($id)
    {
        try {

            $url = self::$endpoint . '/billing/subscriptions/' . $id . '/activate';
            $request = self::$curl->newRequest('post', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For cancel subscription in Paypal
     * @param $id
     * @return mixed|string
     */

    public static function cancelSubscription($id)
    {
        try {

            $url = self::$endpoint . '/billing/subscriptions/' . $id . '/cancel';
            $request = self::$curl->newRequest('post', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For cancel subscription in Paypal
     * @param $id
     * @return mixed|string
     */

    public static function suspendSubscription($id)
    {
        try {

            $url = self::$endpoint . '/billing/subscriptions/' . $id . '/suspend';
            $request = self::$curl->newRequest('post', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For get detail subscription
     * @return mixed|string
     */

    public static function getSubscription($id)
    {
        try {

            $url = self::$endpoint . '/billing/subscriptions/' . $id;

            $request = self::$curl->newRequest('get', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . self::$token);

            $response = $request->send();
            return self::$helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For create product and plan one time
     * @param array $product
     * @param array $plan
     * @return mixed|string
     */

    public static function createPack($product = [], $plan = [])
    {
        try {

            $dataProduct = self::createProduct($product);
            $dataProduct = [
                'product_id' => $dataProduct['id']
            ];
            return self::createPlan($plan, $dataProduct);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
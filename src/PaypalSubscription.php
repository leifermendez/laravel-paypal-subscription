<?php

namespace leifermendez\paypal;


use anlutro\cURL\cURL;
use Exception;

/**
 * Clase principal
 * Class PayPalLM
 * @package leifermendez\paypal
 */
class PaypalSubscription extends cURL
{
    private $endpoint = 'https://api-m.sandbox.paypal.com/v1';
    private $app_id;
    private $app_sk;
    private $headers;
    private $helper;
    private $token;

    public function __construct($app_id, $app_sk)
    {
        try {
            $this->helper = new Helper();
            $this->app_id = $app_id;
            $this->app_sk = $app_sk;
            $this->headers = [
                'User-Agent: PostmanRuntime/7.16.3',
            ];
            $this->token = $this->getToken();

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method for get Bearer token
     */

    public function getToken()
    {
        try {
            $headers = [
                'Content-Type: application/x-www-form-urlencoded'
            ];
            $url = $this->endpoint . '/oauth2/token';

            $request = cURL::newRequest('post', $url, ['grant_type' => 'client_credentials'])
                ->setHeaders($headers)
                ->setUser($this->app_id)
                ->setPass($this->app_sk);

            $response = $request->send();

            return $this->helper->parseJson($response->body)['access_token'];

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

    public function getProduct()
    {
        try {

            $url = $this->endpoint . '/catalogs/products?page_size=2&page=1&total_required=true';

            $request = cURL::newRequest('get', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

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
    public function createProduct($data = [])
    {
        try {
            if (empty($data)) {
                throw new Exception('PRODUCT_IS_EMPTY');
            }

            $url = $this->endpoint . '/catalogs/products';

            $request = cURL::newJsonRequest('post', $url, $data)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For get all plans in database
     * @return mixed|string
     */

    public function getPlans()
    {
        try {

            $url = $this->endpoint . '/billing/plans';

            $request = cURL::newRequest('get', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

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

    public function createPlan($data = [], $product = [])
    {
        try {

            $url = $this->endpoint . '/billing/plans';
            $data = array_merge($data, $product);
            $request = cURL::newJsonRequest('post', $url, $data)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

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

    public function createSubscription($data = [], $plan = [])
    {
        try {

            $url = $this->endpoint . '/billing/subscriptions';
            $data = array_merge($data, $plan);
            $request = cURL::newJsonRequest('post', $url, $data)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

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

    public function activeSubscription($id)
    {
        try {

            $url = $this->endpoint . '/billing/subscriptions/'.$id.'/activate';
            $request = cURL::newRequest('post', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

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

    public function cancelSubscription($id)
    {
        try {

            $url = $this->endpoint . '/billing/subscriptions/'.$id.'/cancel';
            $request = cURL::newRequest('post', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

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

    public function suspendSubscription($id)
    {
        try {

            $url = $this->endpoint . '/billing/subscriptions/'.$id.'/suspend';
            $request = cURL::newRequest('post', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Method
     * For get detail subscription
     * @return mixed|string
     */

    public function getSubscription($id)
    {
        try {

            $url = $this->endpoint . '/billing/subscriptions/'.$id;

            $request = cURL::newRequest('get', $url)
                ->setHeader('Content-Type', 'application/json')
                ->setHeader('Authorization', 'Bearer ' . $this->token);

            $response = $request->send();
            return $this->helper->parseJson($response->body);

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
<?php

namespace leifermendez\paypal;

class Helper
{
    /**
     * Parse JSON
     * @param string $str
     * @return mixed|string
     */

    public function parseJson($str = '')
    {
        try {
            return json_decode($str, true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Generate String ID
     * @param int $length
     * @return false|string
     */

    public function generateID($length = 10)
    {
        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
    }
}
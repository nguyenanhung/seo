<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 15:16
 */

namespace nguyenanhung\SEO;

use Exception;

/**
 * Class Utils
 *
 * @package   nguyenanhung\SEO
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Utils
{
    /**
     * Function jsonItem
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-07 11:51
     *
     * @param string $json
     * @param string $output
     *
     * @return string|null
     */
    public static function jsonItem($json = '', $output = '')
    {
        $result = json_decode(trim($json), false);
        $output = trim($output);
        if (($result !== null) && isset($result->$output)) {
            return trim($result->$output);
        }

        return null;
    }

    /**
     * Function slugify
     *
     * @param $str
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/12/2022 51:05
     */
    public static function slugify($str = '')
    {
        return (new SeoUrl())->slugify($str);
    }

    /**
     * Function sendRequest
     *
     * @param string                   $url
     * @param null|array|object|string $params
     * @param string                   $method
     *
     * @return bool|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 36:05
     */
    public static function sendRequest($url = '', $params = null, $method = 'GET')
    {
        try {
            $method = strtoupper($method);
            $endpoint = ((is_array($params) || is_object($params)) && !empty($params)) ? $url . '?' . http_build_query($params) : $url;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL            => $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => $method,
                CURLOPT_POSTFIELDS     => "",
                CURLOPT_HTTPHEADER     => array(),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                $message = "cURL Error #:" . $err;
                if (function_exists('log_message')) {
                    log_message('error', $message);
                }

                return null;
            }

            return $response;
        } catch (Exception $e) {
            $message = 'Error Code: ' . $e->getCode() . ' - File: ' . $e->getFile() . ' - Line: ' . $e->getLine() . ' - Message: ' . $e->getMessage();
            if (function_exists('log_message')) {
                log_message('error', $message);
            }

            return null;
        }
    }
}

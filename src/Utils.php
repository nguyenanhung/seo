<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 15:16
 */

namespace nguyenanhung\SEO;

use Curl\Curl;

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
     * Function sendRequest
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-31 01:44
     *
     * @param string $url
     * @param null   $params
     *
     * @return bool|null|string
     */
    public static function sendRequest($url = '', $params = NULL)
    {
        try {
            $curl = new Curl();
            if (!empty($params)) {
                $curl->get($url, $params);
            } else {
                $curl->get($url);
            }
            $result = $curl->error ? FALSE : $curl->rawResponse;
            $curl->close();

            return $result;
        }
        catch (\Exception $e) {
            $message = 'Error Code: ' . $e->getCode() . ' - File: ' . $e->getFile() . ' - Line: ' . $e->getLine() . ' - Message: ' . $e->getMessage();
            if (function_exists('log_message')) {
                log_message('error', $message);
            }

            return NULL;
        }
    }
}

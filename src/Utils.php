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
     * Function request
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:19
     *
     * @param string $url
     * @param null   $params
     *
     * @return bool|null|string
     */
    public static function request($url = '', $params = NULL)
    {
        try {
            $curl = new Curl();
            if (!empty($params)) {
                $curl->get($url, $params);
            } else {
                $curl->get($url);
            }
            if ($curl->error) {
                $result = FALSE;
            } else {
                $result = $curl->response;
            }
            $curl->close();

            return $result;
        }
        catch (\Exception $e) {
            return NULL;
        }
    }
}

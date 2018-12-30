<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 16:13
 */

namespace nguyenanhung\SEO\Social;

/**
 * Interface GooglePlusInterface
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface GooglePlusInterface
{
    /**
     * Function createShareLink
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:12
     *
     * @param string $url
     *
     * @return $this
     */
    public function createShareLink($url = '');

    /**
     * Function getLink
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:58
     *
     * @return string
     */
    public function getLink();
}

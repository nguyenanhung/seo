<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 16:09
 */

namespace nguyenanhung\SEO\Social\Interfaces;

/**
 * Interface TwitterInterface
 *
 * @package   nguyenanhung\SEO\Social\Interfaces
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface TwitterInterface
{
    /**
     * Function createShareLink
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:09
     *
     * @param string $url
     * @param string $text
     * @param string $referer
     *
     * @return $this
     */
    public function createShareLink($url = '', $text = '', $referer = '');

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

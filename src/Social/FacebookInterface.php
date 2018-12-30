<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 14:40
 */

namespace nguyenanhung\SEO\Social;

/**
 * Interface FacebookInterface
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface FacebookInterface
{
    /**
     * Function setAppId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:43
     *
     * @param string $appId
     *
     * @return $this
     */
    public function setAppId($appId = '');

    /**
     * Function getAppId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:44
     *
     * @return string
     */
    public function getAppId();

    /**
     * Function setAdminId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:46
     *
     * @param string $adminId
     *
     * @return $this
     */
    public function setAdminId($adminId = '');

    /**
     * Function getAdminId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:46
     *
     * @return string
     */
    public function getAdminId();

    /**
     * Function setRedirectUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:53
     *
     * @param string $redirectUrl
     *
     * @return $this
     */
    public function setRedirectUrl($redirectUrl = '');

    /**
     * Function getRedirectUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:54
     *
     * @return string
     */
    public function getRedirectUrl();

    /**
     * Function createShareLink
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:58
     *
     * @param string $url
     * @param string $caption
     *
     * @return $this
     */
    public function createShareLink($url = '', $caption = '');

    /**
     * Function graphShare
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:23
     *
     * @param string $url
     *
     * @return $this
     */
    public function graphShare($url = '');

    /**
     * Function commentCount
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:27
     *
     * @return int
     */
    public function commentCount();

    /**
     * Function shareCount
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:28
     *
     * @return int
     */
    public function shareCount();
}

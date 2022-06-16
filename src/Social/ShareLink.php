<?php
/**
 * Project seo
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 16/06/2022
 * Time: 23:20
 */

namespace nguyenanhung\SEO\Social;

class ShareLink
{
    /** @var array Mảng dữ liệu cấu hình Data share link */
    public $data;

    /**
     * Function setData
     *
     * @param array $data
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/06/2022 12:42
     */
    public function setData(array $data = array()): ShareLink
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Function getFacebookAppId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:31
     *
     * @return mixed|string
     */
    public function getFacebookAppId()
    {
        return $this->data['facebook']['appId'];
    }

    /**
     * Function getFacebookAdminId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:31
     *
     * @return mixed|string
     */
    public function getFacebookAdminId()
    {
        return $this->data['facebook']['adminId'];
    }

    /**
     * Function facebookShare
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:28
     *
     * @param string $url
     * @param string $text aka Caption
     *
     * @return string
     */
    public function facebookShare(string $url = '', string $text = ''): string
    {
        $facebook = new Facebook();

        return $facebook->setAppId($this->data['facebook']['appId'])->setAdminId($this->data['facebook']['adminId'])->setRedirectUrl($this->data['facebook']['redirectUrl'])->createShareLink($url, $text)->getLink();
    }

    /**
     * Function twitterShare
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:29
     *
     * @param string $url
     * @param string $text
     * @param string $referer
     *
     * @return string
     */
    public function twitterShare(string $url = '', string $text = '', string $referer = ''): string
    {
        $twitter = new Twitter();

        return $twitter->createShareLink($url, $text, $referer)->getLink();
    }

    /**
     * Function googlePlusShare
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:30
     *
     * @param string $url
     *
     * @return string
     */
    public function googlePlusShare(string $url = ''): string
    {
        $googlePlus = new GooglePlus();

        return $googlePlus->createShareLink($url)->getLink();
    }
}

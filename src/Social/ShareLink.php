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
     * @param  array  $data
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
     * @return mixed|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:31
     *
     */
    public function getFacebookAppId()
    {
        return $this->data['facebook']['appId'];
    }

    /**
     * Function getFacebookAdminId
     *
     * @return mixed|string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:31
     *
     */
    public function getFacebookAdminId()
    {
        return $this->data['facebook']['adminId'];
    }

    /**
     * Function facebookShare
     *
     * @param  string  $url
     * @param  string  $text  aka Caption
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:28
     *
     */
    public function facebookShare(string $url = '', string $text = ''): string
    {
        $facebook = new Facebook();

        return $facebook->setAppId($this->data['facebook']['appId'])->setAdminId(
            $this->data['facebook']['adminId']
        )->setRedirectUrl($this->data['facebook']['redirectUrl'])->createShareLink($url, $text)->getLink();
    }

    /**
     * Function twitterShare
     *
     * @param  string  $url
     * @param  string  $text
     * @param  string  $referer
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:29
     *
     */
    public function twitterShare(string $url = '', string $text = '', string $referer = ''): string
    {
        $twitter = new Twitter();

        return $twitter->createShareLink($url, $text, $referer)->getLink();
    }

    /**
     * Function googlePlusShare
     *
     * @param  string  $url
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 16:30
     *
     */
    public function googlePlusShare(string $url = ''): string
    {
        $googlePlus = new GooglePlus();

        return $googlePlus->createShareLink($url)->getLink();
    }
}

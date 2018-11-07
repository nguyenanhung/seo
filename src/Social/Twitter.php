<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 16:03
 */

namespace nguyenanhung\SEO\Social;

use nguyenanhung\SEO\Interfaces\ProjectInterface;
use nguyenanhung\SEO\Social\Interfaces\TwitterInterface;

/**
 * Class Twitter
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Twitter implements ProjectInterface, TwitterInterface
{
    const SHARE_URI = 'https://twitter.com/intent/tweet';
    /** @var string Link dùng để nhúng share trên twitter */
    private $link;

    /**
     * Twitter constructor.
     */
    public function __construct()
    {
    }

    /**
     * Function getVersion
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:39
     *
     * @return mixed|string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

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
    public function createShareLink($url = '', $text = '', $referer = '')
    {
        if (empty($referer)) {
            $referer = $url;
        }
        $params     = array(
            'url'              => $url . '?utm_source=twitter&utm_medium=link_share&utm_campaign=twitter_share',
            'text'             => $text,
            'original_referer' => $referer
        );
        $this->link = self::SHARE_URI . '?' . http_build_query($params);

        return $this;
    }

    /**
     * Function getLink
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:58
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}

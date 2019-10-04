<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 16:03
 */

namespace nguyenanhung\SEO\Social;

use nguyenanhung\SEO\ProjectInterface;
use nguyenanhung\SEO\Version;

/**
 * Class Twitter
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Twitter implements ProjectInterface, TwitterInterface
{
    use Version, SocialTrait;

    const SHARE_URI = 'https://twitter.com/intent/tweet';
    /** @var string Link dùng để nhúng share trên twitter */
    private $link;

    /**
     * Twitter constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * Function createShareLink
     *
     * @param string $url
     * @param string $text
     * @param string $referer
     *
     * @return $this|\nguyenanhung\SEO\Social\TwitterInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 35:40
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
}

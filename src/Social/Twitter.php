<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 16:03
 */

namespace nguyenanhung\SEO\Social;

use nguyenanhung\SEO\Environment;
use nguyenanhung\SEO\Version;

/**
 * Class Twitter
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Twitter implements Environment
{
    use Version, SocialTrait;

    const SHARE_URI = 'https://twitter.com/intent/tweet';
    /** @var string Link dùng để nhúng share trên twitter */
    protected $link;

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
     * @param  string  $url
     * @param  string  $text
     * @param  string  $referer
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 06:14
     */
    public function createShareLink(string $url = '', string $text = '', string $referer = ''): Twitter
    {
        if (empty($referer)) {
            $referer = $url;
        }
        $params = array(
            'url' => $url . '?utm_source=twitter&utm_medium=link_share&utm_campaign=twitter_share',
            'text' => $text,
            'original_referer' => $referer
        );
        $this->link = self::SHARE_URI . '?' . http_build_query($params);

        return $this;
    }
}

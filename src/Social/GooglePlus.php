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
 * Class GooglePlus
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class GooglePlus implements Environment, GooglePlusInterface
{
    use Version, SocialTrait;

    const SHARE_URI = 'https://plus.google.com/share';
    /** @var string Link dùng để nhúng share trên Google+ */
    private $link;

    /**
     * GooglePlus constructor.
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
     *
     * @return $this|\nguyenanhung\SEO\Social\GooglePlusInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 34:52
     */
    public function createShareLink($url = '')
    {
        $params     = array('url' => $url . '?utm_source=google%2B&utm_medium=link_share&utm_campaign=google_plus_share');
        $this->link = self::SHARE_URI . '?' . http_build_query($params);

        return $this;
    }
}

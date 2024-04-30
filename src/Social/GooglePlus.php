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
class GooglePlus implements Environment
{
    use Version, SocialTrait;

    const SHARE_URI = 'https://plus.google.com/share';
    /** @var string Link dùng để nhúng share trên Google+ */
    protected $link;

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
     * @param  string  $url
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 06:36
     */
    public function createShareLink(string $url = ''): GooglePlus
    {
        $params = array('url' => $url . '?utm_source=google%2B&utm_medium=link_share&utm_campaign=google_plus_share');
        $this->link = self::SHARE_URI . '?' . http_build_query($params);

        return $this;
    }
}

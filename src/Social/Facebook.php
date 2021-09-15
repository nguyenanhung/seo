<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 14:38
 */

namespace nguyenanhung\SEO\Social;

use nguyenanhung\SEO\Environment;
use nguyenanhung\SEO\Utils;
use nguyenanhung\SEO\Version;

/**
 * Class Facebook
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Facebook implements Environment, FacebookInterface
{
    use Version, SocialTrait;

    const SHARE_URI = 'https://www.facebook.com/dialog/share';
    const GRAPH_URI = 'https://graph.facebook.com/';
    /** @var string Facebook App ID */
    private $appId;
    /** @var string List Admin ID, mỗi ID cách nhau 1 dấu , */
    private $adminId;
    /** @var string Link chuyển hướng sau khi share link */
    private $redirectUrl;
    /** @var string Link dùng để nhúng share trên facebook */
    private $link;
    /** @var null|object Object chứa thông tin graph content */
    private $graphShare;

    /**
     * Facebook constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * Function setAppId
     *
     * @param string $appId
     *
     * @return $this|\nguyenanhung\SEO\Social\FacebookInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:35
     */
    public function setAppId($appId = '')
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * Function getAppId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:41
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Function setAdminId
     *
     * @param string $adminId
     *
     * @return $this|\nguyenanhung\SEO\Social\FacebookInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:46
     */
    public function setAdminId($adminId = '')
    {
        $this->adminId = $adminId;

        return $this;
    }

    /**
     * Function getAdminId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:52
     */
    public function getAdminId(): string
    {
        return $this->adminId;
    }

    /**
     * Function setRedirectUrl
     *
     * @param string $redirectUrl
     *
     * @return $this|\nguyenanhung\SEO\Social\FacebookInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:57
     */
    public function setRedirectUrl($redirectUrl = '')
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    /**
     * Function getRedirectUrl
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 34:03
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    /**
     * Function createShareLink
     *
     * @param string $url
     * @param string $caption
     *
     * @return $this|\nguyenanhung\SEO\Social\FacebookInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 34:08
     */
    public function createShareLink($url = '', $caption = '')
    {
        if (empty($caption) && !empty($this->redirectUrl)) {
            $parseUrl = parse_url($this->redirectUrl);
            $caption  = $parseUrl['host'];
        }
        $params     = array(
            'app_id'       => $this->appId,
            'caption'      => $caption,
            'href'         => $url . '?utm_source=facebook&utm_medium=link_share&utm_campaign=facebook_share',
            'redirect_uri' => $this->redirectUrl . '?utm_source=facebook&utm_medium=link_call_back&utm_campaign=facebook_share'
        );
        $this->link = self::SHARE_URI . '?' . http_build_query($params);

        return $this;
    }

    /**
     * Function graphShare
     *
     * @param string $url
     *
     * @return $this|\nguyenanhung\SEO\Social\FacebookInterface
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 34:18
     */
    public function graphShare($url = '')
    {
        $params  = array('id' => $url);
        $request = Utils::sendRequest(self::GRAPH_URI, $params);
        if (!empty($request)) {
            $this->graphShare = json_decode(trim($request));
        } else {
            $this->graphShare = NULL;
        }

        return $this;
    }

    /**
     * Function commentCount
     *
     * @return int
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 34:23
     */
    public function commentCount(): int
    {
        if (is_object($this->graphShare) && isset($this->graphShare->share->comment_count)) {
            $result = $this->graphShare->share->comment_count;
        } else {
            $result = 0;
        }

        return $result;
    }

    /**
     * Function shareCount
     *
     * @return int
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 34:28
     */
    public function shareCount(): int
    {
        if (is_object($this->graphShare) && isset($this->graphShare->share->share_count)) {
            $result = $this->graphShare->share->share_count;
        } else {
            $result = 0;
        }

        return $result;
    }
}

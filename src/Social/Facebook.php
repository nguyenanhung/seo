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
class Facebook implements Environment
{
    use Version, SocialTrait;

    const SHARE_URI = 'https://www.facebook.com/dialog/share';
    const GRAPH_URI = 'https://graph.facebook.com/';

    /** @var string Facebook App ID */
    protected $appId;

    /** @var string List Admin ID, mỗi ID cách nhau 1 dấu , */
    protected $adminId;

    /** @var string Link chuyển hướng sau khi share link */
    protected $redirectUrl;

    /** @var string Link dùng để nhúng share trên facebook */
    protected $link;

    /** @var null|object Object chứa thông tin graph content */
    protected $graphShare;

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
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 06:58
     */
    public function setAppId(string $appId = ''): Facebook
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
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 07:05
     */
    public function setAdminId(string $adminId = ''): Facebook
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
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 07:14
     */
    public function setRedirectUrl(string $redirectUrl = ''): Facebook
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
     * @time     : 09/24/2021 07:20
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
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 07:23
     */
    public function createShareLink(string $url = '', string $caption = ''): Facebook
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
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 07:30
     */
    public function graphShare(string $url = ''): Facebook
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
     * @time     : 09/24/2021 07:36
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
     * @time     : 09/24/2021 07:40
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

<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 14:38
 */

namespace nguyenanhung\SEO\Social;

use nguyenanhung\SEO\ProjectInterface;
use nguyenanhung\SEO\Utils;
use nguyenanhung\SEO\Version;

/**
 * Class Facebook
 *
 * @package   nguyenanhung\SEO\Social
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Facebook implements ProjectInterface, FacebookInterface
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
     */
    public function __construct()
    {
    }

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
    public function setAppId($appId = '')
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * Function getAppId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:44
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

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
    public function setAdminId($adminId = '')
    {
        $this->adminId = $adminId;

        return $this;
    }

    /**
     * Function getAdminId
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:46
     *
     * @return string
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

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
    public function setRedirectUrl($redirectUrl = '')
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    /**
     * Function getRedirectUrl
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 14:54
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

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
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:23
     *
     * @param string $url
     *
     * @return $this
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
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:27
     *
     * @return int
     */
    public function commentCount()
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
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 11/6/18 15:28
     *
     * @return int
     */
    public function shareCount()
    {
        if (is_object($this->graphShare) && isset($this->graphShare->share->share_count)) {
            $result = $this->graphShare->share->share_count;
        } else {
            $result = 0;
        }

        return $result;
    }
}

<?php
/**
 * Project seo
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/09/2021
 * Time: 22:33
 */

namespace nguyenanhung\SEO;

use nguyenanhung\Libraries\Slug\SlugUrl;
use nguyenanhung\Libraries\Hashids\HashIds;

/**
 * Class SeoUrl
 *
 * @package   nguyenanhung\SEO
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class SeoUrl implements Environment
{
    use Version;

    const HANDLE_CONFIG_KEY   = 'CONFIG_HANDLE';
    const HASH_IDS_CONFIG_KEY = 'hashIdsConfig';

    /** @var array SDK Config */
    protected $sdkConfig;

    /** @var string $siteUrl */
    protected $siteUrl;

    /** @var string Site Ext */
    protected $siteExt = '.html';

    /** @var array HashIds Config */
    protected $hashids;

    /**
     * Seo constructor.
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct()
    {
    }

    /**
     * Function setSdkConfig
     *
     * @param array $sdkConfig
     *
     * @return $this
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-09 14:04
     *
     */
    public function setSdkConfig($sdkConfig = array())
    {
        $this->sdkConfig = $sdkConfig;

        return $this;
    }

    /**
     * Function getSdkConfig
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/30/2021 02:24
     */
    public function getSdkConfig()
    {
        return $this->sdkConfig;
    }

    /**
     * Function getPageNumber
     *
     * @param string $pageNumber
     *
     * @return array|string|string[]
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/30/2021 02:48
     */
    public function getPageNumber($pageNumber = '')
    {
        return str_replace('trang-', '', trim($pageNumber));
    }

    /**
     * Function setSiteUrl
     *
     * @param string $siteUrl
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 32:24
     */
    public function setSiteUrl($siteUrl = '')
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * Function getSiteUrl
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 32:19
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * Function getSiteExt
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 32:43
     */
    public function getSiteExt()
    {
        return $this->siteExt;
    }

    /**
     * Function baseUrl
     *
     * @param string $uri
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 00:48
     */
    public function baseUrl($uri = '')
    {
        $uri = trim($uri);
        if (empty($uri)) {
            return $this->homeUrl();
        }

        return $this->homeUrl() . trim($uri);
    }

    /**
     * Function siteUrl
     *
     * @param $uri
     * @param $protocol
     *
     * @return false|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/06/2022 13:54
     */
    public function siteUrl($uri = '', $protocol = '')
    {
        $uri = trim($uri);
        if (empty($uri)) {
            return $this->homeUrl();
        }
        $protocol = strtolower($protocol);
        $url      = $this->homeUrl() . trim($uri) . $this->getSiteExt();
        if ($protocol === 'https') {
            $url = str_replace('http://', 'https://', $url);
        }

        return $url;
    }

    /**
     * Function assetsUrl
     *
     * @param string $uri
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 00:54
     */
    public function assetsUrl($uri = '')
    {
        $uri = trim($uri);
        if (empty($uri)) {
            return $this->sdkConfig[self::HANDLE_CONFIG_KEY]['static_url'];
        }

        return $this->sdkConfig[self::HANDLE_CONFIG_KEY]['static_url'] . trim($uri);
    }

    /**
     * Function assetsUrlThemes
     *
     * @param string $themes
     * @param string $uri
     * @param string $assetFolder
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/09/2021 17:17
     */
    public function assetsUrlThemes($themes = '', $uri = '', $assetFolder = 'yes')
    {
        $assetFolder = strtolower($assetFolder);
        $assetsPath  = 'assets/themes/';
        // Pattern
        if ($themes != '') {
            if ($assetFolder == 'no') {
                $uri = ($themes . '/' . $uri);
            } else {
                $uri = ($themes . '/assets/' . $uri);
            }
        } else {
            if ($assetFolder == 'no') {
                $uri = trim($uri);
            } else {
                $uri = ('assets/' . $uri);
            }
        }

        return $this->baseUrl($assetsPath . $uri);
    }

    /**
     * Function faviconUrl
     *
     * @param string $uri
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 01:04
     */
    public function faviconUrl($uri = '')
    {
        return $this->assetsUrl('fav/' . $uri);
    }

    /**
     * Function imageUrl
     *
     * @param string $input
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 01:08
     */
    public function imageUrl($input = '')
    {
        $config    = [
            'no_thumb' => [
                'images/system/no_avatar.jpg',
                'images/system/no_avatar_100x100.jpg',
                'images/system/no_video_available.jpg',
                'images/system/no_video_available_thumb.jpg',
                'images/system/no-image-available.jpg',
                'images/system/no-image-available_60.jpg',
                'images/system/no-image-available_330.jpg'
            ]
        ];
        $assetsUrl = $this->sdkConfig[self::HANDLE_CONFIG_KEY]['assets_url'];
        $staticUrl = $this->sdkConfig[self::HANDLE_CONFIG_KEY]['static_url'];
        $imageUrl  = trim($input);
        if (!empty($imageUrl)) {
            $noThumbnail = $config['no_thumb'];
            if (in_array($imageUrl, $noThumbnail)) {
                return $assetsUrl . trim($imageUrl);
            } else {
                $parse_input = parse_url($imageUrl);
                if (isset($parse_input['host'])) {
                    return $imageUrl;
                } else {
                    if (trim(mb_substr($imageUrl, 0, 12)) == 'crawler-news') {
                        $imageUrl = trim('uploads/' . $imageUrl);
                    }

                    return $staticUrl . $imageUrl;
                }
            }
        }

        return $imageUrl;
    }

    /**
     * Function setHashIds
     *
     * @param array $hashIdsConfig
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 33:15
     */
    public function setHashIds($hashIdsConfig = [])
    {
        $this->hashids = $hashIdsConfig;

        return $this;
    }

    /**
     * Function getHashids
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 33:26
     */
    public function getHashids()
    {
        return $this->hashids;
    }

    /**
     * Function slugify - SEO Slugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/21/18 02:49
     *
     * @param string $str
     *
     * @return string
     */
    public function slugify($str = '')
    {
        return (new SlugUrl())->slugify($str);
    }

    /**
     * Function search_slugify - SEO Search Slugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/21/18 02:50
     *
     * @param string $str
     *
     * @return string
     */
    public function search_slugify($str = '')
    {
        return (new SlugUrl())->searchSlugify($str);
    }

    /**
     * Function strToEn - Str To English
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/21/18 02:50
     *
     * @param string $str
     *
     * @return string
     */
    public function strToEn($str = '')
    {
        return (new SlugUrl())->toEnglish($str);
    }

    /**
     * Function encodeId
     *
     * @param $id
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 28:40
     */
    public function encodeId($id)
    {
        $hash = new Hashids();
        $hash->setConfig($this->hashids);

        return $hash->encodeId($id);
    }

    /**
     * Function decodeId
     *
     * @param $string
     *
     * @return array|mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/25/2021 12:38
     */
    public function decodeId($string)
    {
        $hash = new Hashids();
        $hash->setConfig($this->hashids);

        return $hash->decodeId($string);
    }

    /**
     * Function randomId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 43:30
     */
    public function randomId()
    {
        return uniqid('HungNG_', true);
    }

    /**
     * Function randomNanoId
     *
     * @param int $size
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 45:44
     */
    public function randomNanoId($size = 21)
    {
        if (class_exists('Hidehalo\Nanoid\Client')) {
            /** @var object $client */
            $client = new Hidehalo\Nanoid\Client();

            return $client->generateId($size);
        }

        return uniqid('HungNG_', true);
    }

    /**
     * Function uuidV4
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 44:26
     */
    public function uuidV4()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', // 32 bits for "time_low"
                       mt_rand(0, 0xffff), mt_rand(0, 0xffff), // 16 bits for "time_mid"
                       mt_rand(0, 0xffff), // 16 bits for "time_hi_and_version",

            // four most significant bits holds version number 4
                       mt_rand(0, 0x0fff) | 0x4000, // 16 bits, 8 bits for "clk_seq_hi_res",

            // 8 bits for "clk_seq_low",

            // two most significant bits holds zero and one for variant DCE1.1
                       mt_rand(0, 0x3fff) | 0x8000, // 48 bits for "node"
                       mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }

    /**
     * Function urlPost
     *
     * @param string     $categorySlug
     * @param string     $postSlug
     * @param string|int $postId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 36:40
     */
    public function urlPost($categorySlug = '', $postSlug = '', $postId = '')
    {
        return $this->homeUrl() . trim($categorySlug) . '/' . trim($postSlug) . '-post' . $this->encodeId(trim($postId)) . $this->siteExt;
    }

    /**
     * Function url_post
     *
     * @param string     $categorySlug
     * @param string     $postSlug
     * @param string|int $postId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 36:59
     */
    public function url_post($categorySlug = '', $postSlug = '', $postId = '')
    {
        return $this->urlPost($categorySlug, $postSlug, $postId);
    }

    /**
     * Function urlPostShare
     *
     * @param string $postId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/30/2021 09:20
     */
    public function urlPostShare($postId = '')
    {
        $home = $this->homeUrl();

        return $home . 'post/' . $this->encodeId($postId) . $this->siteExt;
    }

    /**
     * Function urlPage
     *
     * @param string     $pageSlug
     * @param string|int $pageId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 37:38
     */
    public function urlPage($pageSlug = '', $pageId = '')
    {
        return $this->homeUrl() . trim('pages/' . trim($pageSlug) . '-page' . $this->encodeId(trim($pageId))) . $this->siteExt;
    }

    /**
     * Function url_page
     *
     * @param string     $pageSlug
     * @param string|int $pageId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 38:33
     */
    public function url_page($pageSlug = '', $pageId = '')
    {
        return $this->urlPage($pageSlug, $pageId);
    }

    /**
     * Function urlPageShare
     *
     * @param string $pageId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 03:39
     */
    public function urlPageShare($pageId = '')
    {
        $home   = $this->homeUrl();
        $pageId = trim($pageId);
        if (empty($pageId)) {
            return $home;
        }

        return $home . 'p/' . $this->encodeId($pageId) . $this->siteExt;
    }

    /**
     * Function helpPage
     *
     * @param string $slug
     *
     * @return bool|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 03:43
     */
    public function helpPage($slug = '')
    {
        $slug = trim($slug);
        if (empty($slug)) {
            return $this->homeUrl();
        }

        return $this->homeUrl() . 'help/' . trim($slug) . $this->siteExt;
    }

    /**
     * Function urlCategory
     *
     * @param string $categorySlug
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 03:48
     */
    public function urlCategory($categorySlug = '')
    {
        $categorySlug = trim($categorySlug);
        if (empty($categorySlug)) {
            return $this->homeUrl();
        }

        return $this->homeUrl() . trim($categorySlug) . $this->siteExt;
    }

    /**
     * Function urlTopic
     *
     * @param string $topicSlug
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 03:52
     */
    public function urlTopic($topicSlug = '')
    {
        $topicSlug = trim($topicSlug);
        if (empty($topicSlug)) {
            return $this->homeUrl();
        }

        return $this->homeUrl() . 'chu-de/' . trim($topicSlug) . $this->siteExt;
    }

    /**
     * Function urlTags
     *
     * @param string $tagSlug
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 03:56
     */
    public function urlTags($tagSlug = '')
    {
        $tagSlug = trim($tagSlug);
        if (empty($tagSlug)) {
            return $this->homeUrl();
        }

        return $this->homeUrl() . 'tags/' . trim($tagSlug) . $this->siteExt;
    }

    /**
     * Function urlChannels
     *
     * @param string $channelCode
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/26/2020 31:52
     */
    public function urlChannels($channelCode = '')
    {
        $channelCode = trim($channelCode);
        if (empty($channelCode)) {
            return $this->homeUrl();
        }

        return $this->homeUrl() . 'channel/' . trim($channelCode) . $this->siteExt;
    }

    /**
     * Function urlEncode
     *
     * @param string $url
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 48:50
     */
    public function urlEncode($url = '')
    {
        return urlencode($url);
    }

    /**
     * Function urlDecode
     *
     * @param string $url
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 49:16
     */
    public function urlDecode($url)
    {
        return urldecode($url);
    }

    /**
     * Function parseUrl
     *
     * @param string $url
     *
     * @return array|false|int|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 49:53
     */
    public function parseUrl($url = 'https://nguyenanhung.com/')
    {
        return parse_url($url);
    }

    /**
     * Function cleanText
     *
     * @param string $str
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 02:58
     */
    public function cleanText($str = '')
    {
        return html_entity_decode($str);
    }

    /**
     * Function homeUrl
     *
     * @return mixed|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/06/2022 08:13
     */
    public function homeUrl()
    {
        if (isset($this->sdkConfig[self::HANDLE_CONFIG_KEY]['homepage'])) {
            return $this->sdkConfig[self::HANDLE_CONFIG_KEY]['homepage'];
        }

        return $this->siteUrl;
    }
}

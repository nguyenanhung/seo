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

use nguyenanhung\Libraries\Hashids\HashIds;
use nguyenanhung\Libraries\Slug\SlugUrl;

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
    private $sdkConfig;

    /** @var string $siteUrl */
    protected $siteUrl;

    /** @var string Site Ext */
    private $siteExt = '.html';

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
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/06/2022 23:00
     */
    public function setSdkConfig(array $sdkConfig = array()): SeoUrl
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
     * @time     : 16/06/2022 23:02
     */
    public function getSdkConfig(): array
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
    public function getPageNumber(string $pageNumber = '')
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
    public function setSiteUrl(string $siteUrl = ''): SeoUrl
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
    public function getSiteUrl(): string
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
    public function getSiteExt(): string
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
    public function baseUrl(string $uri = ''): string
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
     * @param string $uri
     * @param string $protocol
     *
     * @return false|string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/06/2022 13:54
     */
    public function siteUrl(string $uri = '', string $protocol = '')
    {
        if (!isset($uri)) {
            $base_url = null;
        } elseif (trim($uri) === '') {
            $base_url = '';
        } else {
            $base_url = rtrim($uri, '/') . '/';
        }
        if (isset($protocol)) {
            // For protocol-relative links
            if ($protocol === '') {
                $base_url = substr($base_url, strpos($base_url, '//'));
            } else {
                $base_url = $protocol . substr($base_url, strpos($base_url, '://'));
            }
        }
        if (empty($uri)) {
            return $base_url;
        }
        if (is_array($uri)) {
            $uri = http_build_query($uri);
        }
        $suffix = $this->getSiteExt();
        if ($suffix !== '') {
            if (($offset = strpos($uri, '?')) !== false) {
                $uri = substr($uri, 0, $offset) . $suffix . substr($uri, $offset);
            } else {
                $uri .= $suffix;
            }
        }

        return trim($base_url) . trim($uri);

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
    public function assetsUrl(string $uri = ''): string
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
    public function assetsUrlThemes(string $themes = '', string $uri = '', string $assetFolder = 'yes'): string
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
    public function faviconUrl(string $uri = ''): string
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
    public function imageUrl(string $input = ''): string
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
    public function setHashIds(array $hashIdsConfig = []): SeoUrl
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
    public function getHashids(): array
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
    public function slugify(string $str = ''): string
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
    public function search_slugify(string $str = ''): string
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
    public function strToEn(string $str = ''): string
    {
        return (new SlugUrl())->toEnglish($str);
    }

    /**
     * Function str_to_en
     *
     * @param string $str
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/06/2022 26:41
     */
    public function str_to_en(string $str): string
    {
        return $this->strToEn($str);
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
    public function encodeId($id): string
    {
        $hash   = new Hashids();
        $config = !is_array($this->hashids) ? array() : $this->hashids;
        $hash->setConfig($config);

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
     * @time     : 09/15/2021 28:47
     */
    public function decodeId($string)
    {
        $hash   = new Hashids();
        $config = !is_array($this->hashids) ? array() : $this->hashids;
        $hash->setConfig($config);

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
    public function randomId(): string
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
    public function randomNanoId(int $size = 21): string
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
     * @throws \Exception
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/24/2021 04:30
     */
    public function uuidV4(): string
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', // 32 bits for "time_low"
                       random_int(0, 0xffff), random_int(0, 0xffff), // 16 bits for "time_mid"
                       random_int(0, 0xffff), // 16 bits for "time_hi_and_version",

            // four most significant bits holds version number 4
                       random_int(0, 0x0fff) | 0x4000, // 16 bits, 8 bits for "clk_seq_hi_res",

            // 8 bits for "clk_seq_low",

            // two most significant bits holds zero and one for variant DCE1.1
                       random_int(0, 0x3fff) | 0x8000, // 48 bits for "node"
                       random_int(0, 0xffff), random_int(0, 0xffff), random_int(0, 0xffff));
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
    public function urlPost(string $categorySlug = '', string $postSlug = '', $postId = ''): string
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
    public function url_post(string $categorySlug = '', string $postSlug = '', $postId = ''): string
    {
        return $this->urlPost($categorySlug, $postSlug, $postId);
    }

    /**
     * Function urlPostShare
     *
     * @param string|int $postId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/30/2021 09:20
     */
    public function urlPostShare($postId = ''): string
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
    public function urlPage(string $pageSlug = '', $pageId = ''): string
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
    public function url_page(string $pageSlug = '', $pageId = ''): string
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
    public function urlPageShare(string $pageId = ''): string
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
    public function helpPage(string $slug = '')
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
    public function urlCategory(string $categorySlug = ''): string
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
    public function urlTopic(string $topicSlug = ''): string
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
    public function urlTags(string $tagSlug = ''): string
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
    public function urlChannels(string $channelCode = ''): string
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
    public function urlEncode(string $url = ''): string
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
    public function urlDecode(string $url): string
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
    public function parseUrl(string $url = 'https://nguyenanhung.com/')
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
    public function cleanText(string $str = ''): string
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

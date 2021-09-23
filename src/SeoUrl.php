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

use Exception;
use Cocur\Slugify\Slugify;
use Hashids\Hashids;

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
        try {
            $slugify = new Slugify();

            return $slugify->slugify($str);
        } catch (Exception $e) {
            return trim($str);
        }

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
        try {
            $options = array('separator' => '+');
            $slugify = new Slugify($options);

            return $slugify->slugify($str);
        } catch (Exception $e) {
            return trim($str);
        }
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
        try {
            $options = array('separator' => ' ');
            $slugify = new Slugify($options);

            return $slugify->slugify($str);
        } catch (Exception $e) {
            return trim($str);
        }
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
        try {
            $hash = new Hashids(
                $this->hashids['salt'],
                $this->hashids['minHashLength'],
                $this->hashids['alphabet']
            );

            return $hash->encode($id);
        } catch (Exception $e) {
            return $id;
        }
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
        try {
            $hash   = new Hashids(
                $this->hashids['salt'],
                $this->hashids['minHashLength'],
                $this->hashids['alphabet']
            );
            $decode = $hash->decode($string);
            if (empty($decode)) {
                return $string;
            }
            if (count($decode) > 1) {
                return $decode;
            }

            return $decode[0];
        } catch (Exception $e) {
            return $string;
        }
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
        return $this->siteUrl . trim($categorySlug) . '/' . trim($postSlug) . '-post' . $this->encodeId(trim($postId)) . $this->siteExt;
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
        return $this->siteUrl . trim('pages/' . trim($pageSlug) . '-page' . $this->encodeId(trim($pageId))) . $this->siteExt;
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
}

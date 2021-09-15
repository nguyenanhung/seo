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
 * Class Seo
 *
 * @package   nguyenanhung\SEO
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Seo implements Environment
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
    public function setSiteUrl(string $siteUrl = ''): Seo
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
     * Function setHashIds
     *
     * @param array $hashIdsConfig
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 33:15
     */
    public function setHashIds(array $hashIdsConfig = []): Seo
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
    public function search_slugify(string $str = ''): string
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
    public function strToEn(string $str = ''): string
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
    public function encodeId($id): string
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
    public function urlPost(string $categorySlug = '', string $postSlug = '', string $postId = ''): string
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
    public function url_post(string $categorySlug = '', string $postSlug = '', string $postId = ''): string
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
    public function urlPage(string $pageSlug = '', $pageId = ''): string
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
    public function url_page(string $pageSlug = '', $pageId = ''): string
    {
        return $this->urlPage($pageSlug, $pageId);
    }
}
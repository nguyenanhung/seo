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
     * Function slugify - SEO Slugify
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 9/21/18 02:49
     *
     * @param string $str
     *
     * @return string
     */
    public function slugify($str = ''): string
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
    public function search_slugify($str = ''): string
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
    public function strToEn($str = ''): string
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
     * @return mixed|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 49:49
     */
    public function encodeId($id)
    {
        try {
            $hash = new Hashids($this->hashids['salt'], $this->hashids['minHashLength'], $this->hashids['alphabet']);

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
     * @time     : 09/15/2021 49:57
     */
    public function decodeId($string)
    {
        try {
            $hash   = new Hashids($this->hashids['salt'], $this->hashids['minHashLength'], $this->hashids['alphabet']);
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
     * Function url_post
     *
     * @param string $category_slug
     * @param string $post_slug
     * @param string $post_id
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 50:26
     */
    public function url_post($category_slug = '', $post_slug = '', $post_id = ''): string
    {
        return site_url(trim($category_slug) . '/' . trim($post_slug) . '-post' . $this->encodeId(trim($post_id)));
    }

    /**
     * Function url_page
     *
     * @param string $page_slug
     * @param string $page_id
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/15/2021 50:29
     */
    public function url_page($page_slug = '', $page_id = ''): string
    {
        return site_url('pages/' . trim($page_slug) . '-page' . $this->encodeId(trim($page_id)));
    }
}
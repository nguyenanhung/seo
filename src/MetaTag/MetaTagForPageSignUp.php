<?php
/**
 * Project seo
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/12/2022
 * Time: 23:38
 */

namespace nguyenanhung\SEO\MetaTag;

use nguyenanhung\SEO\Utils;

/**
 * Class MetaTagForPageSignUp
 *
 * @package   nguyenanhung\SEO\MetaTag
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MetaTagForPageSignUp extends MetaTag
{
    protected $exampleData
        = array(
            'homepageUrl',
            'assetsUrl',
            'canonical_url',
            'facebook_profile',
            'locale',
            'language',
            'web_author',
            'site_name',
            'site_slogan',
            'site_title',
            'site_description',
            'site_keywords',
            'site_images',
            'site_email',
            'seo_robots',
            'seo_revisit-after',
            'seo_geo_tagging',
        );

    public function buildMetaContent()
    {
        return [
            [
                'name'    => 'robots',
                'content' => $this->getDataItem('seo_robots')
            ],
            [
                'name'    => 'revisit-after',
                'content' => $this->getDataItem('seo_revisit-after')
            ],
            [
                'name'    => 'copyright',
                'content' => $this->getDataItem('site_name')
            ],
            [
                'name'    => 'generator',
                'content' => self::GENERATOR
            ],
            [
                'name'    => 'author',
                'content' => $this->getDataItem('site_name')
            ],
            [
                'name'    => 'web_author',
                'content' => $this->getDataItem('web_author')
            ],
            [
                'name'    => 'dc.publisher',
                'content' => $this->getDataItem('site_name')
            ],
            [
                'name'    => 'dc.rights.copyright',
                'content' => $this->getDataItem('site_name')
            ],
            [
                'name'    => 'dc.creator.name',
                'content' => $this->getDataItem('site_name')
            ],
            [
                'name'    => 'dc.creator.email',
                'content' => $this->getDataItem('site_email')
            ],
            [
                'name'    => 'dc.identifier',
                'content' => $this->getDataItem('homepageUrl')
            ],
            [
                'name'    => 'dc.language',
                'content' => $this->getDataItem('language')
            ],
            [
                'name'    => 'geo.placename',
                'content' => Utils::jsonItem($this->getDataItem('seo_geo_tagging'), 'placename')
            ],
            [
                'name'    => 'geo.region',
                'content' => Utils::jsonItem($this->getDataItem('seo_geo_tagging'), 'region')
            ],
            [
                'name'    => 'geo.position',
                'content' => Utils::jsonItem($this->getDataItem('seo_geo_tagging'), 'position')
            ],
            [
                'name'    => 'ICBM',
                'content' => Utils::jsonItem($this->getDataItem('seo_geo_tagging'), 'ICBM')
            ]
        ];
    }

    public function buildMetaProperty()
    {
        return [
            [
                'property' => 'fb:app_id',
                'content'  => Utils::jsonItem($this->getDataItem('facebook_profile'), 'app_id')
            ],
            [
                'property' => 'fb:admins',
                'content'  => Utils::jsonItem($this->getDataItem('facebook_profile'), 'admins')
            ],
            [
                'property' => 'og:locale',
                'content'  => Utils::jsonItem($this->getDataItem('facebook_profile'), 'locale')
            ],
            [
                'property' => 'og:type',
                'content'  => 'website'
            ],
            [
                'property' => 'og:title',
                'content'  => 'Đăng ký ' . $this->getDataItem('site_name')
            ],
            [
                'property' => 'og:url',
                'content'  => $this->getDataItem('canonical_url')
            ],
            [
                'property' => 'og:site_name',
                'content'  => $this->getDataItem('site_name')
            ],
            [
                'property' => 'title',
                'content'  => 'Đăng ký ' . $this->getDataItem('site_name'),
                'type'     => 'itemprop'
            ],
            [
                'property' => 'url',
                'content'  => $this->getDataItem('canonical_url'),
                'type'     => 'itemprop'
            ]
        ];
    }

    public function buildGoogleSearchSchema()
    {
        return [
            "@context"      => "https://schema.org",
            "@type"         => "WebSite",
            "name"          => $this->getDataItem('site_name'),
            "alternateName" => $this->getDataItem('site_slogan'),
            "dateModified"  => date('Y-m-d H:i'),
            "url"           => $this->getDataItem('homepageUrl')
        ];
    }
}

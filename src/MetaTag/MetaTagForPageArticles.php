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
 * Class MetaTagForPageArticles
 *
 * @package   nguyenanhung\SEO\MetaTag
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MetaTagForPageArticles extends MetaTag
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
            'brand_name',
            'site_name',
            'site_slogan',
            'site_title',
            'site_description',
            'site_keywords',
            'site_images',
            'site_thumbnail',
            'site_email',
            'seo_robots',
            'seo_revisit-after',
            'seo_geo_tagging',
            'social_profile_json',
            'content_created_at',
            'content_updated_at',
            'content_release_time',
            'content_author',
            'content_name',
            'content_description',
            'content_slugs',
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
                'name'    => 'description',
                'content' => $this->getDataItem('site_description')
            ],
            [
                'name'    => 'keywords',
                'content' => $this->getDataItem('site_keywords') . ', ' . $this->getDataItem('site_name')
            ],
            [
                'name'    => 'news_keywords',
                'content' => $this->getDataItem('site_keywords')
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
                'content' => trim($this->getDataItem('site_name'))
            ],
            [
                'name'    => 'web_author',
                'content' => self::AUTHOR
            ],
            [
                'name'    => 'dc.created',
                'content' => date('Y-m-d', strtotime($this->getDataItem('content_updated_at')))
            ],
            [
                'name'    => 'dc.publisher',
                'content' => trim($this->getDataItem('site_name'))
            ],
            [
                'name'    => 'dc.rights.copyright',
                'content' => trim($this->getDataItem('site_name'))
            ],
            [
                'name'    => 'dc.creator.name',
                'content' => trim($this->getDataItem('site_name'))
            ],
            [
                'name'    => 'dc.creator.email',
                'content' => trim($this->getDataItem('site_email'))
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
            ],
            [
                'name'    => 'twitter:site',
                'content' => Utils::jsonItem($this->getDataItem('social_profile_json'), 'twitter')
            ],
            [
                'name'    => 'twitter:card',
                'content' => 'summary'
            ],
            [
                'name'    => 'twitter:url',
                'content' => $this->getDataItem('canonical_url')
            ],
            [
                'name'    => 'twitter:title',
                'content' => trim($this->getDataItem('site_title'))
            ],
            [
                'name'    => 'twitter:description',
                'content' => trim($this->getDataItem('site_description'))
            ],
            [
                'name'    => 'twitter:image',
                'content' => trim($this->getDataItem('site_images'))
            ]
        ];
    }

    public function buildMetaProperty()
    {
        return array(
            array(
                'property' => 'fb:app_id',
                'content'  => Utils::jsonItem($this->getDataItem('facebook_profile'), 'app_id')
            ),
            array(
                'property' => 'fb:admins',
                'content'  => Utils::jsonItem($this->getDataItem('facebook_profile'), 'admins')
            ),
            array(
                'property' => 'og:locale',
                'content'  => Utils::jsonItem($this->getDataItem('facebook_profile'), 'locale')
            ),
            array(
                'property' => 'og:type',
                'content'  => 'article'
            ),
            array(
                'property' => 'og:title',
                'content'  => trim($this->getDataItem('site_title'))
            ),
            array(
                'property' => 'og:description',
                'content'  => trim($this->getDataItem('site_description'))
            ),
            array(
                'property' => 'og:url',
                'content'  => $this->getDataItem('canonical_url')
            ),
            array(
                'property' => 'og:image',
                'content'  => trim($this->getDataItem('site_images'))
            ),
            array(
                'property' => 'og:image:url',
                'content'  => trim($this->getDataItem('site_images'))
            ),
            array(
                'property' => 'og:image:alt',
                'content'  => trim($this->getDataItem('content_slugs'))
            ),
            array(
                'property' => 'og:site_name',
                'content'  => trim($this->getDataItem('site_name'))
            ),
            array(
                'property' => 'og:updated_time',
                'content'  => date('c', strtotime($this->getDataItem('content_updated_at')))
            ),
            array(
                'property' => 'article:published_time',
                'content'  => date('c', strtotime($this->getDataItem('content_release_time')))
            ),
            array(
                'property' => 'article:modified_time',
                'content'  => date('c', strtotime($this->getDataItem('content_updated_at')))
            ),
            array(
                'property' => 'article:author',
                'content'  => $this->getDataItem('content_author')
            ),
            array(
                'property' => 'article:tag',
                'content'  => trim($this->getDataItem('site_keywords')),
            ),
            array(
                'property' => 'title',
                'content'  => trim($this->getDataItem('site_title')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'headline',
                'content'  => trim($this->getDataItem('site_title')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'description',
                'content'  => trim($this->getDataItem('site_description')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'keywords',
                'content'  => trim($this->getDataItem('site_keywords')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'genre',
                'content'  => 'news',
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'publisher',
                'content'  => trim($this->getDataItem('brand_name')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'author',
                'content'  => trim($this->getDataItem('content_author')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'url',
                'content'  => trim($this->getDataItem('canonical_url')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'image',
                'content'  => trim($this->getDataItem('site_images')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'thumbnailUrl',
                'content'  => trim($this->getDataItem('site_thumbnail')),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'inLanguage',
                'content'  => $this->getDataItem('language'),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'datePublished',
                'content'  => date('c', strtotime($this->getDataItem('content_release_time'))),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'dateCreated',
                'content'  => date('c', strtotime($this->getDataItem('content_release_time'))),
                'type'     => 'itemprop'
            ),
            array(
                'property' => 'dateModified',
                'content'  => date('c', strtotime($this->getDataItem('content_updated_at'))),
                'type'     => 'itemprop'
            )
        );
    }

    public function buildGoogleSearchSchema()
    {
        return [
            "@context"      => "https://schema.org",
            "@type"         => "WebSite",
            "name"          => $this->getDataItem('site_name'),
            "alternateName" => $this->getDataItem('site_slogan'),
            "dateModified"  => "",
            "url"           => $this->getDataItem('homepageUrl')
        ];
    }
}

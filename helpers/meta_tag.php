<?php
/**
 * Project seo
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/12/2022
 * Time: 23:28
 */
if (!function_exists('default_meta_http_equiv')) {
    /**
     * Function default_meta_http_equiv
     *
     * @param int    $refreshContent
     * @param string $contentLanguage
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 07/25/2020 22:33
     */
    function default_meta_http_equiv($refreshContent = 3600, $contentLanguage = 'vi')
    {
        return array(
            array(
                'name'    => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type'    => 'http-equiv'
            ),
            array(
                'name'    => 'refresh',
                'content' => $refreshContent,
                'type'    => 'equiv'
            ),
            array(
                'name'    => 'content-language',
                'content' => $contentLanguage,
                'type'    => 'equiv'
            ),
            array(
                'name'    => 'audience',
                'content' => 'general',
                'type'    => 'equiv'
            )
        );
    }
}
if (!function_exists('default_news_article_html_tag')) {
    function default_news_article_html_tag($firstSegment = '')
    {
        $html = '';
        if (empty($firstSegment)) {
            $html .= "<html lang=\"vi\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:og=\"https://ogp.me/ns#\" xmlns:fb=\"https://www.facebook.com/2008/fbml\">\n";
            $html .= "<head prefix=\"og: https://ogp.me/ns#\">\n";
        } else {
            $html .= "<html lang=\"vi\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:og=\"https://ogp.me/ns#\" xmlns:fb=\"https://www.facebook.com/2008/fbml\" itemscope=\"itemscope\" itemtype=\"https://schema.org/NewsArticle\">\n";
            $html .= "<head prefix=\"og: https://ogp.me/ns# fb: https://ogp.me/ns/fb# article: https://ogp.me/ns/article#\">\n";
        }

        return $html;
    }
}

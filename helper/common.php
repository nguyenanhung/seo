<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2018-12-31
 * Time: 01:53
 */
if (!function_exists('add_this_script')) {
    /**
     * Function add_this_script
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-31 01:55
     *
     * @param string $id
     *
     * @return string
     */
    function add_this_script($id = '')
    {
        $html = '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $id . '"></script>';

        return $html;
    }
}
if (!function_exists('facebook_comments')) {
    /**
     * Function facebook_comments
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-31 01:57
     *
     * @param string $link
     *
     * @return string
     */
    function facebook_comments($link = '')
    {
        $html = '<div class="fb-comments" data-href="' . $link . '" data-width="100%" data-numposts="5"></div>';

        return $html;
    }
}

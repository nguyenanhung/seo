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
     * @param string $id
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:23
     */
    function add_this_script($id = '')
    {
        return '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $id . '"></script>';
    }
}
if (!function_exists('facebook_comments')) {
    /**
     * Function facebook_comments
     *
     * @param string $link
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/4/19 33:16
     */
    function facebook_comments($link = '')
    {
        return '<div class="fb-comments" data-href="' . $link . '" data-width="100%" data-numposts="5"></div>';
    }
}

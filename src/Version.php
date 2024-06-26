<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2018-12-31
 * Time: 01:39
 */

namespace nguyenanhung\SEO;

/**
 * Trait Version
 *
 * @package   nguyenanhung\SEO
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
trait Version
{
    /**
     * Function getVersion
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-31 01:39
     *
     */
    public function getVersion(): string
    {
        return self::VERSION;
    }
}

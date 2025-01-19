<?php
/**
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/4/18
 * Time: 14:55
 */

namespace nguyenanhung\SEO;

/**
 * Interface ProjectInterface
 *
 * @package   nguyenanhung\SEO
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface Environment
{
    const VERSION = '3.2.0';
    const LAST_MODIFIED = '2025-01-19';
    const AUTHOR_NAME = 'Hung Nguyen';
    const AUTHOR_EMAIL = 'dev@nguyenanhung.com';
    const AUTHOR_URL = 'https://nguyenanhung.com';
    const PROJECT_NAME = 'Search Engine Optimization Manager';
    const USE_BENCHMARK = false;
    const USE_DEBUG = false;

    /**
     * Hàm lấy thông tin phiên bản Package
     *
     * @return string Current Project Version, VD: 0.1.0
     * @author  : 713uk13m <dev@nguyenanhung.com>
     * @time    : 10/13/18 15:12
     *
     */
    public function getVersion(): string;
}

<?php
/**
 * Project seo
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/12/2022
 * Time: 23:35
 */

namespace nguyenanhung\SEO\MetaTag;

/**
 * Class MetaTag
 *
 * @package   nguyenanhung\SEO\MetaTag
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MetaTag
{
    const GENERATOR = "BEAR Framework v2.0";
    const AUTHOR = 'Nguyen An Hung';

    protected $data;
    protected $response;

    /**
     * Function setData
     *
     * @param $data
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/12/2022 39:21
     */
    public function setData($data = array())
    {
        $this->data = $data;

        return $this;
    }

    public function getDataItem($item = null)
    {
        if (empty($item)) {
            return null;
        }
        if (is_array($this->data) && isset($this->data[$item])) {
            return $this->data[$item];
        }

        return null;
    }

    /**
     * Function Response
     *
     * @return mixed
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function getResponse()
    {
        return $this->response;
    }
}

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
    const GENERATOR = "BEAR Framework v3.0";
    const AUTHOR = 'Nguyen An Hung';

    protected $data;
    protected $response;

    /**
     * Function generatorInfo
     *
     * @return mixed|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 21/02/2023 23:06
     */
    public function generatorInfo()
    {
        if (function_exists('webBuilderGeneratorService')) {
            return webBuilderGeneratorService();
        }
        if (function_exists('webBuilderSdkDataVersion')) {
            return 'BEAR Framework v' . webBuilderSdkDataVersion()['VERSION'];
        }

        return self::GENERATOR;
    }

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

    public function isJson($json = ''): bool
    {
        $decode = json_decode(trim($json), true);

        return ! ($decode === null);
    }

    public function getDataItem($item = null)
    {
        if (empty($item)) {
            return null;
        }
        if (is_array($this->data) && isset($this->data[$item])) {
            $dataItem = trim($this->data[$item]);
            if ($this->isJson($dataItem)) {
                return $dataItem;
            }

            return escapeHtml($dataItem);
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

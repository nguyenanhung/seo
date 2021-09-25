<?php
/**
 * Project seo
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/24/2021
 * Time: 05:22
 */
require_once __DIR__ . '/../vendor/autoload.php';

use nguyenanhung\SEO\SeoUrl;

$config = array(
    'salt'          => 'w40):pc6cwS{mn9I_O=B$2Cr;=YXA#',
    'minHashLength' => 8,
    'alphabet'      => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
);

$seo = new SeoUrl();
$seo->setHashIds($config)->setSiteUrl('https://nguyenanhung.com');

$id    = 20210925;
$title = 'Nguyễn An Hưng';

echo "title: " . $title . PHP_EOL;
echo "Slugify: " . $seo->slugify($title) . PHP_EOL;
echo "search_slugify: " . $seo->search_slugify($title) . PHP_EOL;
echo "strToEn: " . $seo->strToEn($title) . PHP_EOL;
echo "randomId: " . $seo->randomId() . PHP_EOL;
echo "uuidV4: " . $seo->uuidV4() . PHP_EOL;

echo "fromId: " . $id . PHP_EOL;
echo "encodeId: " . $seo->encodeId($id) . PHP_EOL;
echo "decodeId: " . $seo->decodeId($seo->encodeId($id)) . PHP_EOL;

echo "URL POST: " . $seo->urlPost('test', 'post-name', $id) . PHP_EOL;
echo "URL PAGE: " . $seo->urlPage('post-name', $id) . PHP_EOL;



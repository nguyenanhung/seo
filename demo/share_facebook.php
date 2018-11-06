<?php
/**
 * Project seo.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 11/6/18
 * Time: 14:58
 */
require_once __DIR__ . '/../vendor/autoload.php';

$fb = new \nguyenanhung\SEO\Social\Facebook();

d($fb->setAppId('1234')
   ->setAdminId('456')
   ->setRedirectUrl('https://nguyenanhung.com')
   ->createShareLink('https://blog.nguyenanhung.com/link-can-share.html', 'caption share')
   ->getLink());

d($fb->setAppId('1234')
   ->setAdminId('456')
   ->graphShare('https://nguyenanhung.com')
   ->commentCount());

d($fb->setAppId('1234')
   ->setAdminId('456')
   ->graphShare('http://nguyenanhung.com')
   ->shareCount());
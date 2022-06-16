[![Latest Stable Version](http://poser.pugx.org/nguyenanhung/seo/v)](https://packagist.org/packages/nguyenanhung/seo) [![Total Downloads](http://poser.pugx.org/nguyenanhung/seo/downloads)](https://packagist.org/packages/nguyenanhung/seo) [![Latest Unstable Version](http://poser.pugx.org/nguyenanhung/seo/v/unstable)](https://packagist.org/packages/nguyenanhung/seo) [![License](http://poser.pugx.org/nguyenanhung/seo/license)](https://packagist.org/packages/nguyenanhung/seo) [![PHP Version Require](http://poser.pugx.org/nguyenanhung/seo/require/php)](https://packagist.org/packages/nguyenanhung/seo)

# Search Engine Optimization Package

## Version

- [x] V1.x, V2.x support all PHP version `>=5.6`
- [x] V3.x support all PHP version `>=7.0`

## Usage

Một số hàm tiện ích dùng cho SEO Website

### Get AddThis Script

```php
<?php
echo add_this_script('add_this_id');

```

### Get Facebook Comment Box

```php
<?php
echo facebook_comments('url_comment');

```

### Facebook Social

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
$fb = new \nguyenanhung\SEO\Social\Facebook();
$fb->setAppId('1234')
           ->setAdminId('456')
           ->setRedirectUrl('https://nguyenanhung.com');

// FB Share Link
$data = $fb->createShareLink('link')->getLink();

// FB Share Count
$data = $fb->graphShare('link')->shareCount();

// FB Comment Count
$data = $fb->graphShare('link')->commentCount();

```

### Google Plus

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
$google = new \nguyenanhung\SEO\Social\GooglePlus();

// FB Share Link
$data = $google->createShareLink('link')->getLink();

```

### Twitter

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
$twitter = new \nguyenanhung\SEO\Social\Twitter();

// FB Share Link
$data = $twitter->createShareLink('link')->getLink();
```

## Liên hệ

Nếu có bất cứ thông tin nào cần trao đổi và tìm hiểu, vui lòng liên hệ theo thông tin sau

| Name        | Email                | Skype            | Facebook      |
|-------------|----------------------|------------------|---------------|
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |

From Hanoi with Love <3

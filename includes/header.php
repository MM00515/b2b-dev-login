<?php
require_once('../.env.php');

/**
 * Adds an md5 checksum of the requested file as cache buster for use in link targets.
 *
 * @param  string  $filename
 *
 * @return string
 */
function url(string $filename): string
{
    return sprintf('%s?%s', $filename, md5_file($filename));
}

if ($_GET['headless'] ?? false) {
    return;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="/css/tailwind.min.css" rel="stylesheet"/>
        <script src="/js/polyglot.min.js"></script>
        <script defer src="/js/alpinejs.3.2.2.min.js"></script>
        <script src="/js/app.js"></script>
        <title>Cybex B2B Shop: <?php echo $pageTitle ?></title>
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </head>
    <body x-data="b2bLogin(<?php echo ($redirectIfLoggedIn ?? true) ? 'true' : 'false' ?>)">
        <div id="content">


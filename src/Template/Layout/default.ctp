<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Router; 

?>

<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {ob_start('ob_gzhandler');} ?>

<!DOCTYPE html>
<html>
<head>
    
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>
        <?= isset($meta["title"]) && !empty($meta["title"]) ? $title = $meta["title"] : "" ?>
        <?= isset($title) && !empty($title) ? $title : "Appaloosa Books - Livros Independentes Online" ?>
    </title>
    <!-- Seo -->
    <?= $this->element("metatags") ?>
    <!-- Meta -->
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <!-- Css -->
    <?= $this->Html->css([
            '/bower_components/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css',
            '/bower_components/aos/dist/aos.css',
            '/bower_components/swiper/dist/css/swiper.min.css',
            '/shared/dist/css/main.min.css',
            '/dist/css/main.min.css'
        ]) ?>
    <?= $this->fetch('css') ?>

</head>
<!-- LOADING : Loading style is inline cause css is part of loading process -->
<style>
    body.loading *{
        opacity: 0;
        overflow: hidden !important;
    }
    body.loading *:before,
    body.loading *:after{
        display: none;
    }
    body.loading.wait:before{
        content: "carregando ";
        position: fixed;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #aaaaaa;
        font-size: 18px;
        letter-spacing: 10px;
        border-right: solid 2px;
        animation: blink-caret 1s step-end infinite;
    }
    body.fadeIn *{
        transition: 400ms;
        will-change: opacity;
    }
    /* The typing effect */
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: #008b8b }
    }
</style>
<body class="fadeIn loading">
    <!-- the loading class on body is removed by a loader in shared/js/global.js -->

    <!-- Header -->
    <?= $this->element('Common/navbar') ?>
    <!-- Sidebar -->
    <?= $this->element('Common/sidebar') ?>
    <!-- View -->
    <?= $this->fetch('content') ?>
    <!-- Footer -->
    <?= $this->element('Common/footer') ?>
    <!-- BookNotFound -->
    <?= isset($booknotfound) ? $this->element('booknotfound') : "" ?>

    <!-- Scripts -->
    <?= $this->Html->script([
        '/bower_components/mustache.js/mustache.min.js',
        '/bower_components/jquery/dist/jquery.min.js',
        '/bower_components/jquery-touchswipe/jquery.touchSwipe.min.js',
        '/bower_components/aos/dist/aos.js',
        '/bower_components/swiper/dist/js/swiper.min.js',
        '/shared/dist/js/main.min.js',
        '/dist/js/main.min.js'
    ]) ?>

    <?= $this->fetch('script') ?>
</body>
</html>
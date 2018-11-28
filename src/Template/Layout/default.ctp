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

// SEO & Page Metas Pre Definitions

$default_title = "Appaloosa Books - Livros Independentes Online e Gratuitos";
$default_image = Router::url("/", true) . "img/ap-feature.png";
$default_description = "A Appaloosa é uma casa de publicações digitais com foco na literatura contemporânea e independente. Publicamos desde textos até livros completos nos formatos epub e pdf com edição profissional e alta qualidade gráfica. Basicamente disponibilizamos pequenos e incríveis universos em um formato colaborativo e gratuito";
?>
<!DOCTYPE html>
<html>
<head>
    
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title -->
    <title><?= isset($title) && !empty($title) ? $title : $default_title ?></title>

    <!-- SEO Tags -- Keep the name=image and nam=description cause is used by books.js -->
    <meta name="image" content="<?= isset($image) && !empty($image) ? $image : $default_image ?>">
    <meta name="description" content="<?= isset($description) && !empty($description) ? $description : $default_description ?>" />
    <!--  Essential META Tags -->
    <meta property="og:title" content="<?= isset($title) && !empty($title) ? $title : $default_title ?>">
    <meta property="og:description" content="<?= isset($description) && !empty($description) ? $description : $default_description ?>">
    <meta property="og:image" content="<?= isset($image) && !empty($image) ? $image : $default_image ?>">
    <meta property="og:url" content="<?= Router::url( null, true ) ?>">
    <!--  Non-Essential, But Recommended -->
    <meta name="twitter:card" content="<?= isset($image) && !empty($image) ? $image : $default_image ?>">
    <meta name="twitter:image:alt" content="<?= $default_title ?>">
    <meta property="og:site_name" content="Appaloosa Books - Online Indie Publishing">
    
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
    <!-- -->
</head>
<!-- MATOMO -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//"+window.location.host+"/matomo/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
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
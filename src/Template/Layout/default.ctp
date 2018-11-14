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

?>
<!DOCTYPE html>
<html>
<head>
    
    <?= $this->Html->charset() ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <meta name="description" content="A Appaloosa é uma casa de publicações digitais com foco na literatura contemporânea e independente. Publicamos desde textos até livros completos nos formatos epub e pdf com edição profissional e alta qualidade gráfica. Basicamente disponibilizamos pequenos e incríveis universos em um formato colaborativo e gratuito" />    
    <!--  -->
    <title><?= !empty($title) ? $title : "Appaloosa Books - Livros Independentes Online e Gratuitos" ?></title>    
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
    var u="//appaloosabooks.com/matomo/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
<body>
    
    <!-- Header -->
    <?= $this->element('Common/navbar') ?>
    <!-- Sidebar -->
    <?= $this->element('Common/sidebar') ?>
    <!-- View -->
    <?= $this->fetch('content') ?>
    <!-- Footer -->
    <?= $this->element('Common/footer') ?>
    
    <!-- ========================================== BOOK DETAILS LIGHTBOX  -->
    <?= $this->element('book_details') ?>
    <!-- =========================================== -->
    
    <!-- Scripts -->
    <?= $this->Html->script([
        '/bower_components/mustache.js/mustache.min.js',
        '/bower_components/jquery/dist/jquery.min.js',
        '/bower_components/aos/dist/aos.js',
        '/bower_components/swiper/dist/js/swiper.min.js',
        '/shared/dist/js/main.min.js',
        '/dist/js/main.min.js'
    ]) ?>
    <?= $this->fetch('script') ?>
    
</body>
</html>

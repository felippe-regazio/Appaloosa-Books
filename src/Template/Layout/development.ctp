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
    <title><?= $this->fetch('title') ?></title>    
    <!-- Meta -->
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <!-- Css -->
    <?= $this->Html->css([
            '/bower_components/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css',
            '/bower_components/aos/dist/aos.css',
            '/bower_components/swiper/dist/css/swiper.min.css',
            '/dist/css/main.min.css'
        ]) ?>
    <?= $this->fetch('css') ?>
    <!-- -->

</head>
<body>
    
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
        '/bower_components/jquery/dist/jquery.min.js',
        '/bower_components/aos/dist/aos.js',
        '/bower_components/jquery-touchswipe/jquery.touchSwipe.min.js',
        '/bower_components/swiper/dist/js/swiper.min.js',
        '/dist/js/main.min.js'
    ]) ?>
    <?= $this->fetch('script') ?>
    
</body>
</html>

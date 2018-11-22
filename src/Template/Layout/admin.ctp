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
            // Ap Styles are loaded dynamically from webroot/admin/scss/main
            '/bower_components/jquery-touchswipe/jquery.touchSwipe.min.js',
            '/bower_components/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css',
            '/admin_root/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css',
            '/admin_root/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css',
            '/admin_root/AdminLTE/bower_components/Ionicons/css/ionicons.min.css',
            '/admin_root/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
            '/admin_root/AdminLTE/dist/css/AdminLTE.min.css',
            '/admin_root/AdminLTE/dist/css/skins/skin-blue.min.css',
            '/shared/dist/css/main.min.css',
            '/admin_root/dist/css/main.min.css'
        ]) ?>
    <?= $this->fetch('css') ?>
    <!-- -->

</head>
<body class="hold-transition skin-blue sidebar-mini ap-admin fixed">
    
    <!-- Header -->
    <?= $this->element('Admin/Common/navbar') ?>
    <!-- Sidebar -->
    <?= $this->element('Admin/Common/sidebar') ?>
    <!-- View -->
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content container-fluid">
                <?= $this->fetch('content') ?>
            </section>
        </div>
    </div>
    <!-- Footer -->
    <?= $this->element('Admin/Common/footer') ?>

    <!-- Scripts -->
    <?= $this->Html->script([
        // Admin
        '/admin_root/AdminLTE/bower_components/jquery/dist/jquery.min.js',
        '/admin_root/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js',
        '/admin_root/AdminLTE/plugins/input-mask/jquery.inputmask.js',
        '/admin_root/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js',
        '/admin_root/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js',
        "/admin_root/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js",
        "/admin_root/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js",
        "/admin_root/AdminLTE/bower_components/datatables.net-bs/js/datatables.bootstrap.min.js",
        "/admin_root/AdminLTE/bower_components/fastclick/lib/fastclick.js",
        '/admin_root/AdminLTE/dist/js/adminlte.min.js',
        '/shared/dist/js/main.min.js',
        '/admin_root/dist/js/main.min.js',
        // Ap dist to reuse appaloosa features on admin
        '/bower_components/mustache.js/mustache.min.js',
        '/dist/js/main.min.js',
    ]) ?>
    <?= $this->fetch('script') ?>
    
</body>
</html>

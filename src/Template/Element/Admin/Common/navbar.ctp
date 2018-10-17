<?php use Cake\Routing\Router; ?>
<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>AP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>APPALOOSA</b>BOOKS</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?= Router::url(['controller'=>'admin', 'action'=>'logout']) ?>">
              Sair&nbsp; <i class="fa fa-sign-out"></i>
            </a>
          </li>
        </ul>
      </div>      
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<?php use Cake\Routing\Router; ?>

<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appaloosa Admin</title>    
    <!-- Meta -->
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <!-- Css -->
    <?= $this->Html->css([
            '/admin_root/AdminLTE/dist/css/AdminLTE.min.css',
            '/admin_root/AdminLTE/dist/css/skins/skin-blue.min.css',
            '/admin_root/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css',
            '/admin_root/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css',
            '/admin_root/AdminLTE/bower_components/Ionicons/css/ionicons.min.css',
            '/admin_root/dist/css/main.min.css'
        ]) ?>
    <?= $this->fetch('css') ?>
    <!-- -->
</head>
<body class="ap-login hold-transition skin-blue sidebar-mini">
    <div class="messages" style="padding-top: 25px; max-width: 500px; margin: 0 auto; position: relative">
        <?= $this->Flash->render() ?>
    </div>
    <div class="login-box box box-info">
        <div class="box-header text-center">
            <h3><b>Appaloosa</b>Books</h3>
        </div>
        <div class="login-box-body">
            <form class="login-form" action="<?= Router::url(['controller'=>'Ajax', 'action'=>'login']) ?>" method="post">
                <div class="form-group has-feedback">
                    <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="pass" type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Sign In
                        </button>
                    </div>
                </div>
                <!-- forgot pass -->
                <span class="link invert pull-right" onclick="document.getElementsByClassName('passwordrecover')[0].classList.toggle('hidden')">Esqueci a senha</span>
            </form>
            <form class="passwordrecover hidden" method="post" action="<?= Router::url(['controller'=>'Admin', 'action'=>'passwordrecover']) ?>">
                <br/>
                <div class="form-group has-feedback">
                    <input id="emailtopassrecover" type="email" name="emailtopassrecover" class="form-control" placeholder="E-mail relacionado a conta" required>
                    <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Recuperar
                        </button>
                    </div>
                </div>
            </form>            
        </div>
    </div>
    <!-- Scripts -->
    <?= $this->Html->script([
        '/admin_root/AdminLTE/bower_components/jquery/dist/jquery.min.js',
        '/admin_root/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js',
        '/admin_root/AdminLTE/dist/js/adminlte.min.js',
        '/admin_root/login/login.js'
    ]) ?>
    <?= $this->fetch('script') ?>
</body>
</html>
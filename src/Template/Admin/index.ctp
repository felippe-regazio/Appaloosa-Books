<?php use Cake\Routing\Router; ?>
<div class="admin-dashboard">
	<div class="admin-dashboard__content">
		<div class="user-controls">
	        <!-- CREDENCIAIS -->
			<div class="col-lg-3 col-md-6 col-xs-12">
	          <a href="<?= Router::url(["controller"=>"admin", "action"=>"myaccount"]) ?>">
		          <div class="small-box" style="background-color: #800000; color: white">
		            <div class="inner">
		              <h3>Credenciais</h3>
		              <p>Dados de identificação e login</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-user"></i>
		            </div>
		          </div>
	          </a>
	        </div>
			<!-- PERFIL DE AUTOR -->
	        <div class="col-lg-3 col-md-6 col-xs-12">
	          <a href="<?= Router::url(["controller"=>"admin", "action"=>"author"]) ?>">
		          <div class="small-box bg-teal">
		            <div class="inner">
		              <h3>Autor</h3>
		              <p>Editar meu perfil de autor</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-pencil"></i>
		            </div>
		          </div>
	          </a>          
	        </div>
			<!-- MEUS LIVROS -->
	        <div class="col-lg-3 col-md-6 col-xs-12">
	          <a href="<?= Router::url(["controller"=>"admin", "action"=>"mybooks"]) ?>">
		          <div class="small-box bg-purple">
		            <div class="inner">
		              <h3>Meus Livros</h3>
		              <p>Visualizar minhas publicações</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-book"></i>
		            </div>
		          </div>
	          </a>          
	        </div>
			<!-- DOAÇÕES -->
	        <div class="col-lg-3 col-md-6 col-xs-12">
	          <a href="<?= Router::url(["controller"=>"admin", "action"=>"author"]) ?>">
		          <div class="small-box bg-yellow">
		            <div class="inner">
		              <h3>Doações</h3>
		              <p>Permitir doações</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-money"></i>
		            </div>
		          </div>
	          </a>          
	        </div>
		</div>
	</div>
	<div class="appaloosa-status">
		<div class="col-xs-12">
			<br/>
			<div class="appaloosa-status__content">
				<p>Olá <?= $admin_data["first_name"] . " " . $admin_data["last_name"] . "."  ?></p>
				<p>Já contamos</p>
				<p class="number"><?= $books_count ?></p>
				<p>livros baixados na</p>
				<p>APPALOOSA</p>
			</div>
		</div>
	</div>
</div>
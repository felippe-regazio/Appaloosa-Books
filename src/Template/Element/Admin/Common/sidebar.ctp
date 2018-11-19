<?php use Cake\Routing\Router; ?>
<aside class="main-sidebar">
  <section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree">
		<!-- Profile Image and Name -->
		<?php $profile_image = $admin_data['image'] ? $admin_data['image'] : "default.jpg"; ?>
		<div class="profile-img">
			<?= $this->Html->image("/admin_root/img/ups/avatars/" . $profile_image, ['class'=>'img-responsive']) ?>
		</div>
		<!--  -->
		<li class="header text-center">
			<?= strtoupper( $admin_data['first_name']." ".$admin_data['last_name'] ) ?>
		</li>
		<!-- MENU -->
		<li>
			<a href="<?= Router::url(["controller"=>"admin", "action"=>"index"]) ?>">
				<i class="fa fa-dashboard"></i> <span>Ir para a Dashboard</span>
			</a>
		</li>
		<!-- Minhas informacoes -->
		<li>
			<a href="<?= Router::url(["controller"=>"admin", "action"=>"myaccount"]) ?>">
				<i class="fa fa-user-circle"></i> <span>Minhas Credenciais</span>
			</a>
		</li>
		<!-- Perfil de Autor -->
		<li>
			<a href="<?= Router::url(["controller"=>"admin", "action"=>"author"]) ?>">
				<i class="fa fa-pencil"></i> <span>Perfil de Autor</span>
			</a>
		</li>
		<!-- Meus livros -->
		<!-- <li>
			<a href="<?= Router::url(["controller"=>"admin", "action"=>"mybooks"]) ?>">
				<i class="fa fa-book"></i><span>Meus livros</span>
			</a>
		</li>		 -->
	</ul>

	<!-- THIS AREA BELOW IS SHOWED FOR ADMINS ONLY -->
		
	<?php if( $admin_data['role'] == "admin" ): ?>
		<ul class="sidebar-menu tree" data-widget="tree">
			<li class="header text-center"><i class="fa fa-key"></i> SUPER USER</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-circle-o text-red"></i>
					<span>Ações Especiais</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"newuser"]) ?>">
							<i class="fa fa-user"></i> <span>Novo Usuário & Autor</span>
						</a>
					</li>
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"newbook"]) ?>">
							<i class="fa fa-book"></i> <span><span>Adicionar Livro</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-circle-o text-blue"></i>
					<span>Listar e Editar</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"allusers"]) ?>">
							<i class="fa fa-users"></i> <span>Usuários</span>
						</a>
					</li>
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"allauthors"]) ?>">
							<i class="fa fa-pencil"></i> <span>Autores</span>
						</a>
					</li>
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"allbooks"]) ?>">
							<i class="fa fa-suitcase"></i> <span>Livros</span>
						</a>
					</li>
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"reviewers"]) ?>">
							<i class="fa fa-hand-spock-o"></i> <span>Reviewers</span>
						</a>
					</li>
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"genders"]) ?>">
							<i class="fa fa-bookmark"></i> <span>Gêneros</span>
						</a>
					</li>					
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-circle-o text-yellow"></i>
					<span>Appaloosa Tools</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"subscribers"]) ?>">
							<i class="fa fa-envelope"></i> Subscribers
						</a>
					</li>
					<li>
						<a href="<?= Router::url(["controller"=>"admin", "action"=>"analytics"]) ?>">
							<i class="fa fa-pie-chart"></i> Analytics
						</a>
					</li>
				</ul>
			</li>
		</ul>
	<?php endif; ?>

  </section>
</aside>
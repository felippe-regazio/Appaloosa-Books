<?php use Cake\Routing\Router; ?>

<div class="admin-myaccount">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-user-circle"></i> Editando :: <?= $user_data["first_name"] . " " . $user_data["last_name"]?></h2>
				<br/>
				<!-- left buttons -->
				<a href="<?= Router::url(["controller"=>"admin", "action"=>"editauthor/".$user_data['id']]) ?>">
					<button class="btn btn-info btn-flat">
						<i class="fa fa-user"></i> Perfil de Autor
					</button>
				</a>
				<!-- right buttons -->
				<a href="<?= Router::url(["controller"=>"admin", "action"=>"allbooks"]) ?>">
					<button class="btn btn-warning btn-flat pull-right">
						<i class="fa fa-book"></i> Livros
					</button>
				</a>
				<a href="<?= Router::url(["controller"=>"admin", "action"=>"allauthors"]) ?>">
					<button class="btn btn-success btn-flat pull-right">
						<i class="fa fa-pencil"></i> Autores
					</button>
				</a>				
				<a href="<?= Router::url(["controller"=>"admin", "action"=>"allusers"]) ?>">
					<button class="btn btn-primary btn-flat pull-right">
						<i class="fa fa-users"></i> Usuários
					</button>
				</a>
			</div>	
			<?= $this->Form->create( "User", [
				'type' => 'post',
				'enctype' => "multipart/form-data"
			]) ?>			
				<div class="box-body">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "first_name", [
							'label' => 'Administrador - Primeiro nome',
							'required' => true,
							'placeholder' => 'Digite o primeiro nome',
							'required' => true,
							'class' => 'form-control',
							'value' => $user_data['first_name']
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "last_name", [
							'label' => 'Administrador - Sobrenome',
							'required' => true,
							'placeholder' => 'Digite o sobrenome',
							'required' => true,
							'class' => 'form-control',
							'value' => $user_data['last_name']
						]) ?>
					</div>		
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "birth", [
							'label' => 'Nascimento',
							'required' => true,
							'class' => 'form-control',
							'value' => !empty($user_data['birth']) ? $user_data['birth']->i18nFormat("dd/MM/YYYY") : "",
							'data-inputmask' => "'alias':'dd/mm/yyyy'",
							'data-mask' => ''
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "image", [
							'label' => 'Imagem da Conta - Máx. 400kb',
							'class' => 'form-control',
							'type' => 'file',
							'accept' => 'image/jpeg, image/jpg, image/png'
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "created", [
							'label' => 'Criado em',
							'class' => 'form-control',
							'disabled' => true,
							'value' => !empty($user_data['created']) ? $user_data['created']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
						]) ?>		
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "modified", [
							'label' => 'Modificado em',
							'class' => 'form-control',
							'disabled' => true,
							'value' => !empty($user_data['modified']) ? $user_data['modified']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
						]) ?>
					</div>				
				</div>
				<div class="box-footer">
					<button class="submit btn btn-success">Salvar</button>
				</div>
			<?= $this->Form->end() ?>
		</div>
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
	</div>
<!-- EMAIL AND PASS -->
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h2> <i class="fa fa-asterisk"></i> Login</h2>
			</div>	
			<?= $this->Form->create( "User", [
				'type' => 'post',
				'enctype' => "multipart/form-data"
			]) ?>			
				<div class="box-body">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "email", [
							'label' => 'E-mail',
							'placeholder' => 'Digite um e-mail válido',
							'required' => false,
							'class' => 'form-control',
							'type' => 'email',
							'value' => $user_data['email']
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "pass", [
							'label' => 'Nova senha',
							'placeholder' => 'Digite sua nova senha',
							'required' => false,
							'type' => 'password',
							'class' => 'form-control',
							'value' => ""
						]) ?>
					</div>
				</div>
				<!-- submit -->
				<div class="box-footer">
					<button class="submit btn btn-success">Salvar</button>
				</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
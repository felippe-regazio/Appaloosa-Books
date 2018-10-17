<?php use Cake\Routing\Router; ?>

<div class="admin-newuser">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-user-circle"></i> Novo Usuário / Autor</h2>
			</div>	
			<?= $this->Form->create( "User", [
				'type' => 'post',
				'enctype' => "multipart/form-data",
			]) ?>			
				<div class="box-body">
<!-- ADMIN  -->
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "first_name", [
							'label' => 'Administrador - Primeiro nome',
							'required' => true,
							'placeholder' => 'Digite o primeiro nome',
							'required' => true,
							'class' => 'form-control data-bind',
							'data-bind' => 'bind-author-name',
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "last_name", [
							'label' => 'Administrador - Sobrenome',
							'required' => true,
							'placeholder' => 'Digite o sobrenome',
							'required' => true,
							'class' => 'form-control data-bind',
							'data-bind' => 'bind-author-last-name',
						]) ?>
					</div>		
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "role", [
							'type' => 'select',
							'label' => 'Permissionamento',
							'required' => true,
							'placeholder' => 'Permições do usuário',
							'options' => [
								'author' => 'author',
								'admin' => 'admin',
							],							'required' => true,
							'class' => 'form-control',
						]) ?>
					</div>		
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "birth", [
							'label' => 'Nascimento',
							'required' => true,
							'class' => 'form-control',
							'data-inputmask' => "'alias':'dd/mm/yyyy'",
							'data-mask' => ''
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "email", [
							'label' => 'E-mail',
							'placeholder' => 'Digite um e-mail válido',
							'required' => false,
							'class' => 'form-control data-bind',
							'type' => 'email',
							'data-bind' => 'bind-author-email'
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "pass", [
							'label' => 'Senha',
							'placeholder' => 'Senha',
							'required' => false,
							'type' => 'password',
							'class' => 'form-control',
						]) ?>
					</div>
				</div>
<!-- AUTHOR  -->
				<div class="box-header with-border box-comments">
					<h2><i class="fa fa-pencil"></i> Dados do perfil de Autor</h2>
				</div>
				<div class="box-body">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_first_name", [
							'label' => 'Autor - Primeiro nome',
							'maxlength' => 20,
							'placeholder' => 'Digite o primeiro nome',
							'class' => 'form-control bind-author-name',
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_last_name", [
							'label' => 'Autor - Sobrenome',
							'maxlength' => 20,
							'placeholder' => 'Digite o sobrenome',
							'class' => 'form-control bind-author-last-name',
						]) ?>
					</div>		
					<div class="form-group col-sm-6 col-sm-12">
						<?= $this->Form->control( "author_email", [
							'type' => 'email',
							'label' => 'E-mail do autor',
							'class' => 'form-control bind-author-email',
							'maxlength' => 50,
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_image", [
							'label' => 'Imagem do Autor - Máx. 400kb',
							'class' => 'form-control',
							'type' => 'file',
							'accept' => 'image/jpeg, image/jpg, image/png'
						]) ?>
					</div>							
					<div class="form-group col-sm-12">
						<?= $this->Form->control( "author_about", [
							'type' => 'textarea',
							'label' => 'Sobre - Máx. 800 char',
							'maxlength' => 800,
							'class' => 'form-control',
						]) ?>
					</div>						
				</div>
<!-- AUTHOR LINKS -->
				<div class="box-header no-border">
					<h2> <i class="fa fa-link"></i> Links do Autor</h2>
				</div>	
				<div class="box-body">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[facebook]", [
							'label' => 'Facebook',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[twitter]", [
							'label' => 'Twitter',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[instagram]", [
							'label' => 'Instagram',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[youtube]", [
							'label' => 'Youtube',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[blog]", [
							'label' => 'Blog',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[website]", [
							'label' => 'Website',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
						]); ?>
					</div>												
				</div>
<!-- AUTHOR CONFIG -->
				<div class="box-header with-border box-comments">
					<h2> <i class="fa fa-wrench"></i> Configurações</h2>
				</div>	
				<div class="box-body">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_options[email_PagSeguro]", [
							'label' => "Email da Conta PagSeguro",
							'type' => 'text',
							'class' => 'form-control',
						]); ?>
						<hr>
						<?= $this->Form->control( "author_options[allow_public_emails]", [
							// the cake checkbox value change is made by on change via js
							// se webroot/admin/js/admin.js for how value dynamically changes
							'type' => 'checkbox',
							'checked' => true,
							'label' => "Permitir mensagens de leitores"
						]); ?>
					</div>
				</div>	
<!-- SUBMIT -->
				<div class="box-footer">
					<button class="submit btn btn-success">Salvar</button>
				</div>
			<?= $this->Form->end() ?>
		</div>
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
	</div>
</div>
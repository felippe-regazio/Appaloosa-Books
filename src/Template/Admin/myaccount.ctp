<?php use Cake\Routing\Router; ?>

<div class="admin-myaccount">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-user-circle"></i> Minhas Credenciais</h2>
				<br/>
				<!--  -->
				<a href="<?= Router::url(["controller"=>"admin", "action"=>"author/".$admin_data['author_id']]) ?>">
					<button class="btn btn-info btn-flat">
						<i class="fa fa-user"></i> Perfil de Autor
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
							'value' => $admin_data['first_name']
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "last_name", [
							'label' => 'Administrador - Sobrenome',
							'required' => true,
							'placeholder' => 'Digite o sobrenome',
							'required' => true,
							'class' => 'form-control',
							'value' => $admin_data['last_name']
						]) ?>
					</div>		
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "birth", [
							'label' => 'Nascimento',
							'required' => true,
							'class' => 'form-control',
							'value' => !empty($admin_data['birth']) ? $admin_data['birth']->i18nFormat("dd/MM/YYYY") : "",
							'data-inputmask' => "'alias':'dd/mm/yyyy'",
							'data-mask' => ''
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "image", [
							'label' => 'Imagem da Conta - Máx. 1MB',
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
							'value' => !empty($admin_data['created']) ? $admin_data['created']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
						]) ?>		
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "modified", [
							'label' => 'Modificado em',
							'class' => 'form-control',
							'disabled' => true,
							'value' => !empty($admin_data['modified']) ? $admin_data['modified']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
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
							'value' => $admin_data['email']
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
<!-- HELP -->
	<div class="col-xs-12">
		<div class="box box-default collapsed-box">
			<!-- BOX HEAD -->
			<div class="box-header with-border">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<h4><i class="fa fa-question-circle"></i> Dúvidas? Clique aqui</h4>
				</button>
			</div>
			<!-- BOX BODY -->
			<div class="box-body">
				<div class="timeline-body">
					<h4>Imagem</h4>
					<p>
						Esta é a imagem do seu perfil interno. Ela não é pública e não será exibida no seu
						perfil público. Para alterar sua imagem de autor, clica em "Pefil de Autor" na sidebar, então procure pela opção "Imagem de autor".
					</p>
				</div>
				<br/>				
				<div class="timeline-body">
					<h4>E-mail</h4>
					<p>
						Para modificar o seu e-mail basta digitar o novo e-mail no campo e-mail acima.
						Deixe a senha em branco caso não queira alterá-la. Você será informado a respeito 
						da sua troca no novo e-mail cadastrado e também no anterior. Caso você tenha
						cometido um erro de digitação ou utilizado um e-mail inválido, você não estará 
						impedido de efetuar o login, porem algumas funções estarão indisponíveis.
					</p>
				</div>
				<br/>
				<div>
					<h4>Senha</h4>
					<p>
						Para modificar a sua senha basta digitar a nova senha no campo de referido acima. Se
						você não deseja modificar o seu e-mail, apenas ignore este campo. A senha deve conter
						8 (oito) caracteres no mínimo. Você será informado a respeito da sua troca via e-mail.
						Caso você modifique a senha com o e-mail ainda em branco, o e-mail permanecerá o mesmo.
					</p>
				</div>
				<br/>
			</div>
		</div>
	</div>		
</div>
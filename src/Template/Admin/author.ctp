<?php 

	use Cake\Routing\Router; 

	// get the author data
	$author_data = $admin_data['author'];

?>

<div class="admin-author">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
		<div class="box box-warning">
			<div class="box-header with-border">
				<div class="col-xs-12">
					<h2> <i class="fa fa-user-circle"></i> Perfil de Autor</h2>
				</div>
			</div>	
			<?= $this->Form->create( "Author", [
				'type' => 'post',
				'enctype' => "multipart/form-data"
			]) ?>			
<!-- BASICS -->
				<div class="box-body">
					<!--  -->
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_first_name", [
							'label' => 'Autor - Primeiro nome',
							'maxlength' => 20,
							'required' => true,
							'placeholder' => 'Digite o primeiro nome',
							'class' => 'form-control',
							'value' => $author_data['author_first_name']
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_last_name", [
							'label' => 'Autor - Sobrenome',
							'required' => true,
							'maxlength' => 20,
							'placeholder' => 'Digite o sobrenome',
							'class' => 'form-control',
							'value' => $author_data['author_last_name']
						]) ?>
					</div>		
					<div class="form-group col-sm-6 col-sm-12">
						<?= $this->Form->control( "author_email", [
							'type' => 'email',
							'label' => 'E-mail do autor',
							'class' => 'form-control',
							'maxlength' => 50,
							'value' => $author_data['author_email']
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_image", [
							'label' => 'Imagem do Autor - Máx. 1MB',
							'class' => 'form-control',
							'type' => 'file',
							'accept' => 'image/jpeg, image/jpg, image/png'
						]) ?>
					</div>							
					<div class="form-group col-sm-12">
						<?= $this->Form->control( "author_about", [
							'type' => 'textarea',
							'required' => true,
							'label' => 'Sobre - Máx. 800 char',
							'maxlength' => 800,
							'class' => 'form-control',
							'value' => $author_data['author_about']
						]) ?>
					</div>	
				</div>
<!-- LINKS -->
				<div class="box-header box-comments no-border">
					<h2> <i class="fa fa-link"></i> Links</h2>
				</div>	
				<div class="box-body">
					<!-- retrive links json -->
					<?php $links = json_decode($author_data['author_links'], true); ?> 

					<!-- 
						LINKS OBJECT

						links is a json column on database, to extend it just 
						add a new input (key) here sending as the pattern below,
						dont forget to add the name as author_links[your_new_key].
						This links weill be replicated to front office in the author
						profile view
					 -->

					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[facebook]", [
							'label' => 'Facebook',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
							'value' => $links['facebook']
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[twitter]", [
							'label' => 'Twitter',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
							'value' => $links['twitter']
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[instagram]", [
							'label' => 'Instagram',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
							'value' => $links['instagram']
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[youtube]", [
							'label' => 'Youtube',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
							'value' => $links['youtube']
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[blog]", [
							'label' => 'Blog',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
							'value' => $links['blog']
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_links[website]", [
							'label' => 'Website',
							'maxlength' => 100,
							'type' => 'url',
							'class' => 'form-control',
							'value' => $links['website']
						]); ?>
					</div>												
				</div>
<!-- CONFIGURACOES -->
				<div class="box-header with-border box-comments">
					<h2> <i class="fa fa-wrench"></i> Configurações</h2>
				</div>	
				<div class="box-body">
					
					<!-- retrive options json -->
					<?php $options = json_decode( $author_data['author_options'], true ); ?>
					
					<!-- 
						OPTIONS OBJECT
						options is a json column on database, to extend it just 
						add a new input (key) here sending as the pattern below,
						dont forget to add the name as author_options[your_new_key]
					 -->
					
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_options[email_PagSeguro]", [
							'label' => "Email da Conta PagSeguro",
							'type' => 'text',
							'class' => 'form-control',
							'value' => $options['email_PagSeguro']
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<p class="text-muted"> <i class="fa fa-arrow-left"></i> Ao incluir um e-mail PagSeguro você estará disponível para receber apoio financeiro através da Appaloosa. Leia a sessão de dúvidas no final desse formulário para maiores informações</p>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_options[allow_public_emails]", [
							// the cake checkbox value change is made by on change via js
							// se webroot/admin/js/admin.js for how value dynamically changes
							'type' => 'checkbox',
							'checked' => $options['allow_public_emails'] ? true : false,
							'label' => "Permitir mensagens de leitores em meu e-mail de autor (o email não estará visível)"
						]); ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<p class="text-muted"> <i class="fa fa-arrow-left"></i> Essa opções permite ao leitor enviar feedbacks para seu e-mail de autor através da Appaloosa. Seu e-mail não será divulgado.</p>
					</div>
				</div>	
<!-- DATES -->
				<div class="box-body box-comments">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_created", [
							'label' => 'Criado em',
							'class' => 'form-control',
							'disabled' => true,
							'value' => !empty($author_data['author_created']) ? $author_data['author_created']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
						]) ?>		
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_modified", [
							'label' => 'Modificado em',
							'class' => 'form-control',
							'disabled' => true,
							'value' => !empty($author_data['author_modified']) ? $author_data['author_modified']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
						]) ?>
					</div>				
				</div>
				<div class="box-footer">
					<button class="submit btn btn-success">Salvar</button>
					<button class="btn btn-primary toggle-author-details no-cache" data-author="<?= $admin_data['author']['author_id'] ?>">Visualizar</button>
				</div>
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
				<div>
					<h4>Imagem</h4>
					<p>
						Sua imagem de perfil será a mesma definida em "Imagem da Conta" na sessão Minhas informações". Porém você pode utilizar uma imagem expecífica para o seu perfil de autor. Para isso, basta enviar uma imagem através da opção Imagem de Autor.
					</p>
				</div>	
					<br/>
				<div>
					<h4>Links</h4>
					<p>
						Na sessão de links você pode definir os endereços sociais que automáticamente estarão
						públicos para aqueles que visualizarem seu perfil no front office. Caso você não possua
						algum dos perfis solicitados, basta deixá-lo em branco e ele não será exibido.
					</p>
				</div>
					<br/>
				<div>
					<h4>Email de autor</h4>
					<p>
						Através do e-mail de autor você receberá mensagens enviadas pelos leitores através da Appaloosa. Você pode escolher não receber e-mail dos leitores na sessão Configurações desse form. Seu endereço de e-mail não será divulgado em nenhum momento, apenas as mensagens são definidas pelo leitor enquanto a Apploosa se encarrega de encaminhá-las até você, deixando assim suas informações protegidas.
					</p>
				</div>
					<br/>
				<div>
					<h4>Email Pagseguro</h4>
					<p>
						Este e-mail será utilizado para integração com a Pagseguro. Se você deixá-lo em branco a opção
						de Apoio á sua obra não aparecerá para os seus leitores e você não estará apto a receber apoio
						financeiro através da AP. Este e-mail deve ser uma conta pagseguro válida. Saiba como criar uma
						conta neste link: xxx
					</p>
				</div>	
			</div>
		</div>
	</div>			
</div>
<!-- Author Preview -->
<?= $this->Element('author_details'); ?>
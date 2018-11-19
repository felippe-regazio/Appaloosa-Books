<?php use Cake\Routing\Router; ?>

<div class="admin-editbook">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-book"></i> Editando :: <?= $book_data["title"] ?></h2>
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
			<?= $this->Form->create( "Book", [
				'type' => 'post',
				'enctype' => "multipart/form-data",
			]) ?>			
				<div class="box-body">
<!-- ADMIN  -->
					<div class="form-group col-xs-12">
						<?= $this->Form->control( "title", [
							'label' => 'Título',
							'required' => true,
							'placeholder' => 'Título',
							'required' => true,
							'class' => 'form-control',
							'value' => $book_data["title"]
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "asbn", [
							'label' => 'Asbn',
							'required' => true,
							'placeholder' => 'Asbn',
							'required' => true,
							'class' => 'form-control',
							'value' => $book_data["asbn"]							
						]) ?>
					</div>
					<?php 
						foreach ($genders as $gender){
							$genders_options[ $gender["id"] ] = $gender["name"];
						}
					?>					
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "gender_id", [
							'type' => 'select',
							'label' => 'Gênero',
							'required' => true,
							'placeholder' => 'Gênero',
							'required' => true,
							'class' => 'form-control',
							'options' => $genders_options,
							'value' => $book_data["gender_id"]							
						]) ?>
					</div>
					<?php 
						foreach ($authors as $author){
							$authors_options[ $author["author_id"] ] = $author["author_first_name"] . " " . $author["author_last_name"];
						}
					?>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "author_id", [
							'type' => 'select',
							'label' => 'Autor',
							'required' => true,
							'class' => 'form-control',
							'value' => $book_data["author_id"],
							'options' => $authors_options
						]) ?>
					</div>	
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "cover", [
							'label' => 'Imagem de Capa - Máx. 4MB',
							'class' => 'form-control',
							'type' => 'file',
							'accept' => 'image/jpeg, image/jpg, image/png'
						]) ?>
						<?= isset( $book_data["cover"] ) ? "<span class='badge'>yes</span>" : ""; ?>
					</div>	
				</div>				
<!-- REVIEW -->
				<div class="box-header box-comments no-border">
					<h2> <i class="fa fa-info-circle"></i> Review</h2>
				</div>						
				<div class="box-body">																			
					<div class="form-group col-sm-12 col-xs-12">
						<?= $this->Form->control( "description", [
							'type' => 'textarea',
							'label' => 'Sobre',
							'required' => true,							
							'maxlength' => 5000,
							'value' => $book_data["description"],
							'class' => 'form-control',
						]) ?>
					</div>
					<div class="form-group col-xs-12">
						<?= $this->Form->control( "short_description", [
							'label' => 'Descrição curta',
							'required' => true,
							'placeholder' => 'Descrição curta',
							'required' => true,
							'value' => $book_data["short_description"],
							'class' => 'form-control'
						]) ?>
					</div>	
					<?php 
						foreach ($reviewers as $reviewer){
							$reviewers_options[ $reviewer["id"] ] = $reviewer["name"];
						}
					?>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "reviewer_id", [
							'type' => 'select',
							'label' => 'Reviewer',
							'required' => true,
							'placeholder' => 'Reviewer',
							'class' => 'form-control',
							'options' => $reviewers_options,
							'value' => $book_data["reviewer_id"]
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "views", [
							'label' => 'Views',
							'value' => $book_data["views"] ? $book_data["views"] : 1,
							'placeholder' => 'Views',
							'class' => 'form-control',
						]) ?>
					</div>
				</div>	
<!-- FILES -->
				<div class="box-header box-comments no-border">
					<h2> <i class="fa fa-file"></i> Arquivos</h2>
				</div>	
				<div class="box-body">

					<?php $files = json_decode($book_data["files"], true); ?>
	
					<!-- 
						os campos adicionados aqui terao seus resultados
						enviados para o field "files" no formato json no db.
						os campos aqui devem todos ser de upload de arquivo
						e devem serguir o padrao dos demais
					 -->

					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "files[pdf]", [
							'label' => 'Arquivo PDF',
							'class' => 'form-control',
							'type' => 'file',
							'accept' => 'application/pdf'
						]) ?>
						<?= isset( $files["pdf"] ) ? "<span class='badge'>yes</span>" : ""; ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "files[epub]", [
							'label' => 'Arquivo EPUB',
							'class' => 'form-control',
							'type' => 'file',
							'accept' => 'application/epub+zip'
						]) ?>
						<?= isset( $files["epub"] ) ? "<span class='badge'>yes</span>" : ""; ?>
					</div>
				</div>
<!-- STATUS -->
				<div class="box-header box-comments no-border">
					<h2> <i class="fa fa-eye"></i> Status</h2>
				</div>						
				<div class="box-body">
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "status", [
							'type' => 'select',
							'label' => 'Publicado?',
							'required' => true,
							'value' => $book_data["status"],
							'placeholder' => 'Status do livro',
							'class' => 'form-control',
							'options' => [
								0 => 'Não',
								1 => 'Sim',
							]
						]) ?>
					</div>									
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "publish_date", [
							'label' => 'Data de publicação',
							'required' => true,
							'class' => 'form-control',
							'data-inputmask' => "'alias':'dd/mm/yyyy'",
							'disabled' => true,
							'data-mask' => '',
							'value' => !empty( $book_data['publish_date'] ) ? $book_data['publish_date']->i18nFormat("dd/MM/YYYY - HH:mm") : ""
						]) ?>
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
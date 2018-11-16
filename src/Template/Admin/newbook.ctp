<?php use Cake\Routing\Router; ?>

<div class="admin-newbook">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-book"></i> Novo Livro</h2>
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
							'class' => 'form-control'
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "asbn", [
							'label' => 'Asbn',
							'required' => true,
							'placeholder' => 'Asbn',
							'required' => true,
							'class' => 'form-control'
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
							'options' => $genders_options
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
							'options' => array_filter($authors_options)
							
						]) ?>
					</div>	
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "cover", [
							'label' => 'Imagem de Capa - Máx. 4MB',
							'class' => 'form-control',
							'type' => 'file',
							'required' => true,
							'accept' => 'image/jpeg, image/jpg, image/png'
						]) ?>
					</div>	
				</div>				
<!-- REVIEW -->
				<div class="box-header box-comments no-border">
					<h2> <i class="fa fa-info-circle"></i> Review</h2>
				</div>						
				<div class="box-body">																			
					<div class="form-group col-sm-12">
						<?= $this->Form->control( "description", [
							'type' => 'textarea',
							'label' => 'Sobre',
							'required' => true,							
							'maxlength' => 5000,
							'class' => 'form-control',
						]) ?>
					</div>
					<div class="form-group col-xs-12">
						<?= $this->Form->control( "short_description", [
							'label' => 'Descrição curta',
							'required' => true,
							'placeholder' => 'Descrição curta',
							'required' => true,
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
							'options' => $reviewers_options
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "views", [
							'label' => 'Views',
							'placeholder' => 'Views',
							'class' => 'form-control',
							'value' => 1,
						]) ?>
					</div>
				</div>	
<!-- FILES -->
				<div class="box-header box-comments no-border">
					<h2> <i class="fa fa-file"></i> Arquivos</h2>
				</div>	
				<div class="box-body">
	
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
							'type' => 'file'
						]) ?>
					</div>
					<div class="form-group col-sm-6 col-xs-12">
						<?= $this->Form->control( "files[epub]", [
							'label' => 'Arquivo EPUB',
							'class' => 'form-control',
							'type' => 'file',
						]) ?>
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
							'value' => date('d/m/Y'),
							'data-inputmask' => "'alias':'dd/mm/yyyy'",
							'disabled' => true,
							'data-mask' => ''
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
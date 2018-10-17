<?php use Cake\Routing\Router; ?>

<div class="admin-allbooks">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-bookmark"></i> Usuários</h2>
			</div>	
			<div class="box-body">
				<div class="col-md-12">
					<div class="box no-border no-shadow">
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover no-border datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Asbn</th>
										<th>Status</th>
										<th>Título</th>
										<th>Autor</th>
										<th>Gênero</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($books as $book): ?>
									<tr>
										<?= $this->Form->create("books/edit",[
											"type" => "post",
											"url" => Router::url(["controller"=>"admin", "action"=>"allbooks/edit/"])
										]); ?>
											<td>
												<span class="badge bg-light-blue">
													<?= $book["id"] ?> 
												</span>						
												<?= $this->Form->hidden( "id", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Id',
													'required' => true,
													'value' => $book["id"],
													'class' => 'form-control'
												]) ?>											 	
											</td>
											<td>
												<span class="hidden"><?= $book["asbn"] ?></span>
												<?= $this->Form->control( "asbn", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Asbn',
													'required' => true,
													'value' => $book["asbn"],
													'class' => 'form-control'
												]) ?>
											</td>
											<td>
												<?= $this->Form->control( "status", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Status',
													'required' => true,
													'type' => 'select',
													'options' => [
														1 => 'On',
														0 => 'Off'
													],
													'value' => $book['status'],
													'class' => 'form-control'
												]) ?>
											</td>
											<td>
												<span class="hidden"><?= $book["title"] ?></span>
												<?= $this->Form->control( "title", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Título',
													'required' => true,
													'value' => $book["title"],
													'class' => 'form-control'
												]) ?>
											</td>
											<?php 
												foreach ($authors as $author){
													$authors_options[ $author["author_id"] ] = $author["author_first_name"] . " " . $author["author_last_name"];
												}
											?>
											<td>
												<?= $this->Form->control( "author_id", [
													'type' => 'select',
													'label' => false,
													'required' => true,
													'class' => 'form-control',
													'options' => $authors_options,
													'value' => $book["author_id"]
												]) ?>
											</td>	
											<?php 
												foreach ($genders as $gender){
													$genders_options[ $gender["id"] ] = $gender["name"];
												}
											?>					
											<td>
												<?= $this->Form->control( "gender_id", [
													'type' => 'select',
													'label' => false,
													'required' => true,
													'placeholder' => 'Gênero',
													'required' => true,
													'class' => 'form-control',
													'options' => $genders_options,
													'value' => $book["gender_id"]
												]) ?>
											</td>
											<td>
												<span>
													<!-- FAST EDIT -->
													<button class="btn btn-success btn-flat">
														<i class="fa fa-check"></i>
													</button>
													<!-- ALL EDIT -->
													<a href="<?= Router::url([
														"controller"=>"admin",
														"action"=>"editbook/".$book["id"]
													]) ?>">
														<span class="btn btn-primary btn-flat">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<!-- DELETE -->
													<a href="<?= Router::url([
														"controller" => "admin",
														"action" => "allbooks/del/".$book["id"]])?>">
														<span class="btn btn-danger btn-flat">
															<i class="fa fa-trash"></i>
														</span>
													</a>
													<!--  -->
												</span>
											</td>
										<?= $this->Form->end() ?>
									</tr>
								<?php endforeach; ?>
							</tbody></table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			</div>
		</div>
	</div>
</div>
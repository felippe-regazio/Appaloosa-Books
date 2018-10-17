<?php use Cake\Routing\Router; ?>

<div class="admin-allauthors">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h2> <i class="fa fa-users"></i> Autores</h2>
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
										<th>Nome</th>
										<th>Sobrenome</th>
										<th>Email</th>
										<th>Status</th>
										<th></th>									
									</tr>
								</thead>
								<tbody>
								<?php foreach ($authors as $author): ?>
									<tr>
										<?= $this->Form->create("authors/edit",[
											"type" => "post",
											"url" => Router::url(["controller"=>"admin", "action"=>"allauthors/edit/"])
										]); ?>
											<td>
												<span class="badge bg-light-blue">
													<?= $author["author_id"] ?>
												</span>						
												<?= $this->Form->hidden( "author_id", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Id',
													'required' => true,
													'value' => $author["author_id"],
													'class' => 'form-control'
												]) ?>											 	
											</td>
											<td>
												<span class="hidden"><?= $author["author_first_name"] ?></span>
												<?= $this->Form->control( "author_first_name", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Primeiro Nome',
													'required' => true,
													'value' => $author["author_first_name"],
													'class' => 'form-control'
												]) ?>
											</td>
											<td>
												<span class="hidden"><?= $author["author_last_name"] ?></span>
												<?= $this->Form->control( "author_last_name", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Sobrenome',
													'required' => true,
													'value' => $author["author_last_name"],
													'class' => 'form-control'
												]) ?>
											</td>
											<td>
												<span class="hidden"><?= $author["author_email"] ?></span>
												<?= $this->Form->control( "author_email", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Email',
													'required' => true,
													'value' => $author["author_email"],
													'class' => 'form-control'
												]) ?>
											</td>
											<td>
												<?= $this->Form->control( "author_status", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Status',
													'required' => true,
													'type' => 'select',
													'options' => [
														1 => 'On',
														0 => 'Off'
													],
													'value' => $author['author_status'],
													'class' => 'form-control'
												]) ?>
											</td>
											<td>
												<div class="">
													<!-- FAST EDIT -->
													<button class="btn btn-success btn-flat">
														<i class="fa fa-check"></i>
													</button>
													<!-- ALL EDIT -->
													<a href="<?= Router::url([
														"controller"=>"admin",
														"action"=>"editauthor/".$author["author_id"]
													]) ?>">
														<span class="btn btn-primary btn-flat">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<!-- DELETE -->
													<a href="<?= Router::url([
														"controller" => "admin",
														"action" => "allauthors/del/".$author["author_id"]])?>">
														<span class="btn btn-danger btn-flat">
															<i class="fa fa-trash"></i>
														</span>
													</a>
													<!-- PREVIEW -->
													<button class="btn btn-primary toggle-author-details no-cache btn-flat" data-author="<?= $author['author_id'] ?>"><i class="fa fa-eye"></i></button>
												</div>
											</td>
										<?= $this->Form->end() ?>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?= $this->Element("author_details"); ?>
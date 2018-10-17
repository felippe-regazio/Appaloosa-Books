<?php use Cake\Routing\Router; ?>

<div class="admin-allusers">
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
										<th>ID & Role</th>
										<th>Nome</th>
										<th>Sobrenome</th>
										<th>Email</th>
										<th>Status</th>
										<th>Actions</th>									
									</tr>
								</thead> 
								<tbody>
								<?php foreach ($users as $user): ?>
									<tr>
										<?= $this->Form->create("users/edit",[
											"type" => "post",
											"url" => Router::url(["controller"=>"admin", "action"=>"allusers/edit/"])
										]); ?>
											<td>
												<span class="badge bg-light-blue">
													<?= $user["id"] ?> | 
													<span><?= $user["role"] ?></span>											
												</span>						
												<?= $this->Form->hidden( "id", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Id',
													'required' => true,
													'value' => $user["id"],
													'class' => 'form-control'
												]) ?>											 	
											</td>
											<td>
												<span class="hidden"><?= $user["first_name"] ?></span>
												<?= $this->Form->control( "first_name", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Primeiro Nome',
													'required' => true,
													'value' => $user["first_name"],
													'class' => 'form-control'
												]) ?>
												<h5 class="text-muted label label-info"><?= $user["author"]["author_first_name"] ?></h5>
											</td>
											<td>
												<span class="hidden"><?= $user["last_name"] ?></span>
												<?= $this->Form->control( "last_name", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Sobrenome',
													'required' => true,
													'value' => $user["last_name"],
													'class' => 'form-control'
												]) ?>
												<h5 class="text-muted label label-info"><?= $user["author"]["author_last_name"] ?></h5>
											</td>
											<td>
												<span class="hidden"><?= $user["email"] ?></span>
												<?= $this->Form->control( "email", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Email',
													'required' => true,
													'value' => $user["email"],
													'class' => 'form-control'
												]) ?>
												<h5 class="text-muted label label-info"><?= $user["author"]["author_email"] ?></h5>
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
													'value' => $user['status'],
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
														"action"=>"edituser/".$user["id"]
													]) ?>">
														<span class="btn btn-primary btn-flat">
															<i class="fa fa-edit"></i>
														</span>
													</a>
													<!-- DELETE -->
													<a href="<?= Router::url([
														"controller" => "admin",
														"action" => "allusers/del/".$user["id"]])?>">
														<span class="btn btn-danger btn-flat">
															<i class="fa fa-trash"></i>
														</span>
													</a>
													<!--  -->
												</div>
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
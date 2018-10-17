<?php use Cake\Routing\Router; ?>

<div class="admin-subscriber">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header no-border">
				<h2> <i class="fa fa-bookmark"></i> Subscribers</h2>
			</div>	
			<div class="box-body">
				<div>
					<div class="box no-border no-shadow">
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover no-border datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Status</th>
										<th>Email</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($subscribers as $subscriber): ?>
									<tr>
										<?= $this->Form->create("subscriber/edit",[
											"type" => "post",
											"url" => Router::url(["controller"=>"admin", "action"=>"subscribers/edit/"])
										]); ?>
											<td class="col-sm-1">
												<span class="badge bg-light-blue">
													<b><?= $subscriber["id"] ?></b>
												</span>
												<?= $this->Form->hidden( "id", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Id',
													'required' => true,
													'value' => $subscriber["id"],
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
													'value' => $subscriber['status'],
													'class' => 'form-control'
												]) ?>												
											</td>
											<td>
												<span class="hidden"><?= $subscriber["email"] ?></span>
												<?= $this->Form->control( "email", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Label do gênero',
													'required' => true,
													'value' => $subscriber["email"],
													'class' => 'form-control',
													'style' => 'width: 100%'
												]) ?>
											</td>
											<td class="col-sm-4">
												<div class="">
													<!-- EDIT -->
													<button class="btn btn-success btn-flat">
														<i class="fa fa-check"></i>
													</button>
													<!-- DELETE -->
													<a href="<?= Router::url([
														"controller" => "admin",
														"action" => "subscribers/del/".$subscriber["id"]])?>">
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
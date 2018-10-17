<?php use Cake\Routing\Router; ?>

<div class="admin-genders">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header no-border">
				<h2> <i class="fa fa-bookmark"></i> Gêneros</h2>
			</div>	
			<div class="box-header with-border">
				<?= $this->Form->create("gender", [
					"type" => "post"
				]) ?>
					<div class="row">
						<div class="form-group col-sm-10 col-xs-12">
							<?= $this->Form->control( "name", [
								'label' => false,
								'required' => true,
								'placeholder' => 'Label do gênero',
								'required' => true,
								'class' => 'form-control',
								'value' => "",
								'maxlength' => 100,
							]) ?>
						</div>
						<div class="form-group col-sm-2 col-xs-12">
							<button class="btn btn-primary btn-block btn-flat">
								Add <i class="fa fa-plus-circle"></i>
							</button>
						</div>		
					</div>
				<?= $this->Form->end() ?>
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
										<th>Nome</th>
										<th></th>									
									</tr>
								</thead>
								<tbody>
								<?php foreach ($genders as $gender): ?>
									<tr>
										<?= $this->Form->create("genders/edit",[
											"type" => "post",
											"url" => Router::url(["controller"=>"admin", "action"=>"genders/edit/"])
										]); ?>
											<td class="col-sm-1">
												<span class="badge bg-light-blue">
													<b><?= $gender["id"] ?></b>
												</span>
												<?= $this->Form->hidden( "id", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Id',
													'required' => true,
													'value' => $gender["id"],
													'class' => 'form-control'
												]) ?>												 	
											</td>
											<td>
												<span class="hidden"><?= $gender["name"] ?></span>
												<?= $this->Form->control( "name", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Label do gênero',
													'required' => true,
													'value' => $gender["name"],
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
														"action" => "genders/del/".$gender["id"]])?>">
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
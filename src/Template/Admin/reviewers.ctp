<?php use Cake\Routing\Router; ?>

<div class="admin-reviewers">
	<div class="col-md-12">
		<div class="messages">
			<?= $this->Flash->render() ?>
		</div>
<!-- GENERAL -->
		<div class="box box-warning">
			<div class="box-header no-border">
				<h2> <i class="fa fa-hand-spock-o"></i> Reviewers</h2>
			</div>	
			<div class="box-header with-border">
				<?= $this->Form->create("Reviewer", [
					"type" => "post"
				]) ?>
					<div class="row">
						<div class="form-group col-sm-5 col-xs-12">
							<?= $this->Form->control( "name", [
								'label' => false,
								'required' => true,
								'placeholder' => 'Nome',
								'required' => true,
								'class' => 'form-control',
								'value' => "",
								'maxlength' => 100,
							]) ?>
						</div>	
						<div class="form-group col-sm-5 col-xs-12">
							<?= $this->Form->control( "link", [
								'label' => false,
								'required' => true,
								'placeholder' => 'Link',
								'required' => true,
								'type' => 'url',
								'value' => "",
								'class' => 'form-control'
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
				<div class="">
					<div class="box no-border no-shadow">
						<!-- /.box-header -->
						<div class="box-body table-responsive no-padding no-border">
							<table class="table table-hover no-border datatable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nome</th>
										<th>Link</th>
										<th></th>									
									</tr>
								</thead>
								<tbody>
								<?php foreach ($reviewers as $reviewer): ?>
									<tr>
										<?= $this->Form->create("Reviewers/edit",[
											"type" => "post",
											"url" => Router::url(["controller"=>"admin", "action"=>"reviewers/edit/"])
										]); ?>
											<td>
												<span class="badge bg-light-blue">
													<b><?= $reviewer["id"] ?></b>
												</span>
												<?= $this->Form->hidden( "id", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Id',
													'required' => true,
													'value' => $reviewer["id"],
													'class' => 'form-control'
												]) ?>												 	
											</td>
											<td>
												<span class="hidden"><?= $reviewer["name"] ?></span>
												<?= $this->Form->control( "name", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Nome',
													'required' => true,
													'value' => $reviewer["name"],
													'class' => 'form-control',
													'style' => 'width: 100%'													
												]) ?>
											</td>
											<td>
												<?= $this->Form->control( "link", [
													'label' => false,
													'required' => true,
													'placeholder' => 'Link',
													'required' => true,
													'type' => 'url',
													'value' => $reviewer["link"],
													'class' => 'form-control',
													'style' => 'width: 100%'
												]) ?>													
											</td>
											<td>
												<!-- EDIT -->
												<button class="btn btn-success btn-flat">
													<i class="fa fa-check"></i>
												</button>
												<!-- DELETE -->
												<a href="<?= Router::url([
													"controller" => "admin",
													"action" => "reviewers/del/".$reviewer["id"]])?>">
													<span class="btn btn-danger btn-flat">
														<i class="fa fa-trash"></i>
													</span>
												</a>
												<!--  -->
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
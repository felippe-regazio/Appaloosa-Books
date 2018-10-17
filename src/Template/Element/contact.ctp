<?php use Cake\Routing\Router; ?>
<div class="ap-contact">
	<div class="ap-contact__close toggle-contact">
		<i class="fa fa-times"></i>
	</div>
	<div class="ap-contact__body">
		<?= $this->Form->create("ap-contact-form", [
			"id" => "ap-contact-form",
			"url" => Router::url(["controller"=>"ajax", "action"=>"contactEmail"])
		]); ?>
			<div class="ap-contact__head">
				<h1><span class="fa fa-envelope-open"></span> Fale Conosco</h1>
			</div>
			<?= $this->Form->control( "name", [
				'label' => false,
				'placeholder' => 'Seu nome',
				'required' => true
			]) ?>
			<?= $this->Form->control( "email", [
				'label' => false,
				'type' => 'email',
				'placeholder' => 'Seu e-mail',
				'required' => true
			]) ?>
			<?= $this->Form->control( "subject", [
				'label' => false,
				'placeholder' => 'Assunto',
				'required' => true
			]) ?>
			<?= $this->Form->control( "message", [
				'label' => false,
				'type' => 'textarea',
				'placeholder' => 'Mensagem',
				'required' => true
			]) ?>
			<div class="submit">
				<button class="ap-btn ap-btn--primary"><span class="text">Enviar</span><div class="spinner"></div></button>
				<p class="typo-subfeature response"></p>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
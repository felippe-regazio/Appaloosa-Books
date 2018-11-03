<?php use Cake\Routing\Router; ?>
<div class="ap-mail-to">
	<div class="ap-mail-to__close toggle-mail-to">
		<i class="fa fa-times"></i>
	</div>
	<!-- Body -->
	<div class="ap-mail-to__body">
		<?= $this->Form->create("mail-to-author", [
			"id" => "mail-to-author",
			"url" => Router::url(["controller"=>"ajax", "action"=>"authorEmail"])
		]); ?>
			<div class="ap-contact__head">
				<h1><span class="fa fa-envelope-open"></span> Enviar Uma Mensagem</h1>
			</div>
			<?= $this->Form->hidden( "author_id", [
				'id' => 'author-id',
				'required' => true,
			]) ?>
			<?= $this->Form->hidden( "book_name", [
				'id' => 'book-name',
				'required' => true,
			]) ?>			
			<?= $this->Form->control( "name", [
				'label' => false,
				'placeholder' => 'Seu nome (opcional)',
				'required' => false
			]) ?>
			<?= $this->Form->control( "email", [
				'label' => false,
				'type' => 'email',
				'placeholder' => 'Seu e-mail (opcional)',
				'required' => false
			]) ?>
			<?= $this->Form->control( "message", [
				'label' => false,
				'type' => 'textarea',
				'placeholder' => 'Mensagem',
				'required' => true
			]) ?>
			<p>
			Aqui você pode enviar uma mensagem para o autor ou autora. Você pode omitir o seu Nome e E-mail, assim sua mensagem será enviada de forma anônima. O conteúdo das mensagens trocadas é de total responsabilidade de seus remetentes.
			</p>
			<div class="submit">
				<button class="ap-btn ap-btn--primary"><span class="text">Enviar</span><div class="spinner"></div></button>
				<p class="typo-subfeature response"></p>
			</div>
		<?= $this->Form->end(); ?>
	</div>
</div>
<?php use Cake\Routing\Router; ?>
<section class="join">
    <div id="publish" class="join-hero">
        <div class="join-hero__content">
            <div class="side a clipfollow" data-bg="join-bg.jpg">
                <!-- a side -->
                <h1>QUERO FAZER PARTE</h1>
            </div>
            <div class="side b">
                <!-- b side -->
                <h1>QUERO FAZER PARTE</h1>
            </div>
        </div>
    </div>
	<div class="join-form">
		<?= $this->Form->create("ap-contact-form", [
			"id" => "ap-join-form",
			"url" => "ajax/JoinUs"
		]); ?>
			<div class="ap-join__head">
				<h1>Então você quer fazer parte da Appaloosa, Huhn?</h1>
				<p>Este é um cadastro inicial que o guiará até o seu novo perfil. Preencha os dados abaixo, e cheque o seu e-mail para mais informações.</p>
			</div>
			<?= $this->Form->control( "first_name", [
				'label' => false,
				'placeholder' => 'PRIMEIRO NOME',
				'required' => true
			]) ?>
			<?= $this->Form->control( "last_name", [
				'label' => false,
				'placeholder' => 'SOBRENOME',
				'required' => true
			]) ?>			
			<?= $this->Form->control( "email", [
				'label' => false,
				'type' => 'email',
				'placeholder' => 'E-MAIL',
				'required' => true
			]) ?>
			<?= $this->Form->control( "pass", [
				'type' => 'password',
				'class' => 'pass',
				'label' => false,
				'minlength' => 8,
				'placeholder' => 'CRIE SUA SENHA',
				'required' => true
			]) ?>
			<?= $this->Form->control( "pass_confirm", [
				'type' => 'password',
				'class' => 'pass-confirm',
				'minlength' => 8,
				'label' => false,
				'placeholder' => 'CONFIRME A SENHA',
				'required' => true
			]) ?>
			<!-- TERMS -->
			<?php $terms = Router::url(["controller"=>"appaloosa", "action"=>"terms"]) ?>
			<!--  -->
			<?= $this->Form->control( "pass-confirm", [
			    'type' => 'select',
			    'multiple' => 'checkbox',
			    'options' => [0 => 'Li e aceito os <a class="link invert" href="' . $terms . '" target="_blank">Termos e Condições</a>'],
			    'label' => false,
			    'escape' => false,
			    'required' => true,
			]) ?>			
			<div class="submit">
				<button class="ap-btn ap-btn--primary"><span class="text">Enviar</span><div class="spinner"></div></button>
				<p class="typo-subfeature response"></p>
			</div>
		<?= $this->Form->end(); ?>		
	</div>
</section>
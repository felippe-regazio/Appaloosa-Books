<?php use Cake\Routing\Router; ?>
<!-- ========================================== BOOKS  -->
<?= $this->element('contact') ?>
<!-- =========================================== -->
<footer class="ap-footer">
	<div class="ap-footer__content">
		<div class="a"
			 data-aos="fade-up" 
		 	 data-aos-duration="1000" 
		 	 data-aos-offset="120" 
		 	 data-aos-once="true">
			<h3># APPALOOSA BOOKS</h3>
			<div class="justify-proportional">
				<a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info#friends']); ?>">
					<svg viewBox="0 0 56 18"><text x="0" y="15">Doação</text></svg>
				</a>
				<a href="/" class="toggle-contact">
					<svg viewBox="0 0 100 18"><text x="0" y="15">Fale Conosco</text></svg>
				</a>
				<span class="mail-me"
				  data-aos="fade-right" 
			 	  data-aos-duration="1000" 
			 	  data-aos-offset="10" 
			 	  data-aos-once="true"><?= AP_CONTACT_EMAIL ?></span>
		 	</div>		 	
		</div>
		<div class="b"
			data-aos="fade-up" 
		 	data-aos-duration="1000" 
		 	data-aos-offset="120" 
		 	data-aos-delay="100"
		 	data-aos-once="true">
			<h3># A EDITORA</h3>
	 		<a target="_blank" href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'terms']); ?>">
	 			<svg viewBox="0 0 150 18"><text x="0" y="15">Termos e Condições</text></svg>
	 		</a>
			<a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info']); ?>">
				<svg viewBox="0 0 68 18"><text x="0" y="15">Originais</text></svg>
			</a>
			<a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'index']); ?>">
				<svg viewBox="0 0 84 18"><text x="0" y="15">Homepage</text></svg>
			</a>
		</div>
		<div class="c"
			 data-aos="fade-up" 
		 	 data-aos-duration="1000" 
		 	 data-aos-offset="120"
		 	 data-aos-delay="200" 
		 	 data-aos-once="true">
			<h3># HUBS</h3>
			<a href="http://appaloosabooks.com/magazine">
				<svg viewBox="0 0 72 18"><text x="0" y="15">Magazine</text></svg>
			</li>
			<a href="http://github.com/felippe-regazio" target="_blank">
				<svg viewBox="0 0 140 18"><text x="0" y="15">Appaloosa Sources</text></svg>
			</a>
			<a href="/" class="toggle-contact">
				<svg viewBox="0 0 186 18"><text x="0" y="15">Críticas, Elogios ou Bugs</text></svg>
			</a>
		</div>
		<div class="d"
			 data-aos="fade-left" 
		 	 data-aos-duration="1000" 
		 	 data-aos-offset="120" 
		 	 data-aos-once="true">
			<div class="ap-logo-img"></div>
		</div>
	</div>
	<div class="ap-footer__mini">
		Appaloosa Books © 2017 : <?=date("Y")?> All Rights Reserved
	</div>
</footer>
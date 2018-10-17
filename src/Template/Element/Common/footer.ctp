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
				<ul>
					<li>
						<a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info#friends']); ?>">
							<div>Doação</div>
						</a>
					</li>
					<li><a href="/" class="toggle-contact"><div>Fale Conosco</div></a></li>
					<span class="mail-me"
					  data-aos="fade-right" 
				 	  data-aos-duration="1000" 
				 	  data-aos-offset="10" 
				 	  data-aos-once="true"><?= AP_CONTACT_EMAIL ?></span>
				</ul>
		 	</div>		 	
		</div>
		<div class="b"
			data-aos="fade-up" 
		 	data-aos-duration="1000" 
		 	data-aos-offset="120" 
		 	data-aos-delay="100"
		 	data-aos-once="true">
			<h3># A EDITORA</h3>
		 	<div class="justify-proportional">
				<ul>
					<li><a target="_blank" href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'terms']); ?>"><div>Termos e Condições</div></a></li>
					<li>
						<a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info']); ?>">
							<div>Originais</div>
						</a>
					</li>
					<li>
						<a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'index']); ?>">
							<div>Homepage</div>
						</a>
					</li>
				</ul>
		 	</div>
		</div>
		<div class="c"
			 data-aos="fade-up" 
		 	 data-aos-duration="1000" 
		 	 data-aos-offset="120"
		 	 data-aos-delay="200" 
		 	 data-aos-once="true">
			<h3># HUBS</h3>
			<div class="justify-proportional">
				<ul>
					<li><a href="http://appaloosabooks.com/magazine"><div>Magazine</div></a></li>
					<li><a href="http://github.com/felippe-regazio" target="_blank"><div>Appaloosa Source Code</div></a></li>
					<li><a href="/" class="toggle-contact"><div>Críticas, Elogios ou Bugs</div></a></li>
				</ul>
		 	</div>
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
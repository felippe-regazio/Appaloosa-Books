<?php use Cake\Routing\Router; ?>
<!-- OPENING DIV -->
<section class="ap-opening spotlight scroll-fade-out" data-spotlight="opening.jpg"> 
	<div class="ap-opening__feature"
		 data-aos="fade" 
		 data-aos-duration="3000" 
		 data-aos-offset="50" 
		 data-aos-once="true">
		<!-- opening title -->
		<span class="ap-opening__feature-title a-opening-fade">APPALOOSA BOOKS</span>
		<!-- opening subtitle -->
		<p class="ap-opening__feature-subtitle animate-typewriter">
		<?=__('Exposing The New Writing'); ?></p>
	</div>
	<!-- tiny vertical sidebar -->
	<!-- <div class="ap-opening__ghost-menu">
		<i class="fa fa-chevron-left fa-xs"></i>
		<div class="options">
			<span data-anchor="#about-ap">Sobre</span>
			<span data-anchor="about-#books-ap">Livros</span>
			<span>|</span>
			<span class="about-toggle">Originais</span>
		</div>
	</div> -->
</section>
<!-- ABOUT -->
<section class="ap-about">
	<!-- Swiper -->
	  <div class="swiper-container swiper-about">
    	<div class="swiper-wrapper">
    		<div class="swiper-slide">
				<div class="ap-about__wrapper">
					<!-- title -->
					<div class="title typo-subtitle"
							data-aos="fade-up" 
							data-aos-duration="600" 
							data-aos-offset="100" 
							data-aos-once="true">
					1. Sobre Nós
					</div>
					<!-- text body -->
					<div class="message"
						 data-aos="fade-up" 
						 data-aos-duration="1000" 
						 data-aos-offset="140" 
						 data-aos-once="true">			
						A Appaloosa é uma casa de publicações digitais com foco na literatura contemporânea e independente. Publicamos desde textos até livros completos nos formatos epub e pdf com edição profissional e alta qualidade gráfica. Basicamente disponibilizamos pequenos e incríveis universos em um formato colaborativo e gratuito 						
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="ap-about__wrapper">
					<!-- title -->
					<div class="title typo-subtitle">2. Originais e Contato</div>
					<!-- text body -->
					<div class="message">			
						Se você deseja publicar conosco, envie seu original para 
						<span><b><?= AP_ORIGINALS_EMAIL ?></b></span>. Para assuntos gerais, por favor, utilize o e-mail: <span><b><?= AP_CONTACT_EMAIL ?></b></span>. Pode ser que você também curta a nossa revista online, <a class="link invert" href="magazine/" target="_blank"><b>clique aqui</b></a> para conhecê-la.
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="ap-about__wrapper">
					<!-- title -->
					<div class="title typo-subtitle">3. Apoio e Doação</div>
					<!-- text body -->
					<div class="message">			
						A Appaloosa é uma "Single Developer Application", uma aplicação inteiramente desenvolvida por uma única pessoa, e que hoje já conta com alguns colaboradores. Se você deseja apoiar, colaborar ou doar - ou simplesmente saber mais sobre - <a class="link invert" href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info']); ?>">
							<b>clique aqui</b>
						</a>
 					</div>
				</div>
			</div>
		</div>
		<!-- controls -->
		<div class="ap-about__wrapper ap-about__controls"
			 data-aos="fade-up" 
			 data-aos-delay="600"
			 data-aos-offset="50" 
			 data-aos-once="true">
			<span class="ap-about__controls-prev"><i class="ap-long-arrow arrow-left gray"></i></span>
			<span class="ap-about__controls-next"><i class="ap-long-arrow right"></i></span>
		</div>
	</div>
	<!-- ========================================== BOOKS AND AUTHORS  -->
	<?= $this->element('info-squares') ?>
	<!-- =========================================== -->	
	<div class="ap-line"
		 no-data-aos="line-reveal" 
		 no-data-aos-offset="150" 
		 no-data-aos-once="true">	 	
	</div>
</section>
<!-- ========================================== BOOKS AND AUTHORS  -->
<?= $this->element('books') ?>
<!-- =========================================== -->
<div class="ap-line"
	 no-data-aos="line-reveal" 
	 no-data-aos-once="true">	 	
</div>
<!-- USEFUL INFORMATION -->
<?= $this->element('magcards'); ?>
<!-- PAGE ENDING - NEWSLETTER -->
<section class="ap-newsletter">
	<div class="ap-newsletter__quoting"
		 data-aos="fade-up" 
		 data-aos-duration="1000" 
		 data-aos-offset="140" 
		 data-aos-once="true">
		<span class="newsletter-result-message">Assine a nossa<br/>Newsletter</span>
	</div>
	<div class="newsletter"
		 data-aos="fade" 
		 data-aos-duration="1000" 
		 data-aos-offset="140"
		 data-aos-delay="500" 
		 data-aos-once="true">
		<div class="group-field-and-btn">
			<?= $this->Form->create("newsletter",[
				"class" => "newsletter-subscribe-form",
				"url" => "/"
			]); ?>
				<?= $this->Form->control("email", [
			 		"label" => false,
			 		"type" => "email",
			 		"class" => "newsletter-input",
			 		"placeholder" => "Digite o seu e-mail",
				    "templates" => [
				        'inputContainer' => '{{content}}'
				    ],			 		
			 	]); ?>
				<button class="ap-btn--secondary newsletter-search-button">
					<div class="spinner"></div>
					<i class="fa fa-search"></i>
				</button>
			<?= $this->Form->end() ?>
		</div>
	</div>
</section>
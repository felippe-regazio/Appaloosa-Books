<section class="magcards">
	<div class="magcards__content ap-container">
		<div class="magcards-swiper">
			<!-- TITLE -->
			<div class="magcards__title">
				<p>
					<a href="magazine/" target="_blank">
						Appaloosa Magazine
						<span>Revista de Literatura e Arte, Etc</span>
					</a>
				</p>
			</div>
			<!-- SLIDE -->
			<div class="swiper-wrapper loading">
				<!-- template will be appended here -->
				<div class="ap-loading-circle"></div>
				<p>
					Não foi possível exibir os posts recentes
					<br/>
					<small style="font-size: 16px">
						Você pode visitar a revista cliando <a href="magazine/" target="_blank">aqui</a>
					</small>
				</p>
			</div>
			<!-- CONTROLS -->
			<div class="magcards__controls"
				 data-aos="fade-up" 
				 data-aos-delay="600"
				 data-aos-offset="50" 
				 data-aos-once="true">
				<span class="arrow-prev magcards__controls-prev"><i class="ap-long-arrow arrow-left gray"></i></span>
				<span class="arrow-next magcards__controls-next"><i class="ap-long-arrow right"></i></span>
			</div>	
		</div>	
	</div>
	<template id="magCardTemplate">
		<a href="{{link}}" target="_blank" class="swiper-slide mg-card mag-post ">
			<div class="mg-card__content" style="background-image:url({{featured_image}})">
				<div class="mg-card__content-info">
					{{{title.rendered}}}
				</div>
			</div>
		</a>
	</template>
</section>
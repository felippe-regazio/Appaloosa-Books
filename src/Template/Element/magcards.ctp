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
		</div>	
	</div>
	<template id="magCardTemplate">
		<div class="swiper-slide mg-card mag-post ">
			<div class="mg-card__content">
				{{title.rendered}}
			</div>
		</div>
	</template>
</section>
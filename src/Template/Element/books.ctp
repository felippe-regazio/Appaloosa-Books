<section class="ap-books" data-gender="" data-search="" data-page="1">
	<div class="ap-books__head">
		<!-- 
			search field basic structure 
			add the ap-search-field-toggle class at .ap-search-field to
			enable toggle mode on search
		-->
		<div class="ap-search-field active"
			 data-aos="fade-left" 
			 data-aos-duration="400" 
			 data-aos-offset="150" 
			 data-aos-once="true">
			<div class="group-field-and-btn">
			<?= $this->Form->create("form-search-books", [
			 	"class" => "ap-form books-search",
			 	"url" => "/",
			 	"id" => "form-search-books"
			 ]) ?>
			 	<?= $this->Form->control("search-book", [
			 		"label" => false,
			 		"class" => "search-input",
			 		"id" => "search-books-input",
			 		"placeholder" => "Título ou autor",
				    "templates" => [
				        'inputContainer' => '{{content}}'
				    ],			 		
			 	]); ?>
				<button class="ap-btn--secondary">
					<i class="fa fa-search"></i>
				</button>
			<?= $this->Form->end(); ?>
			</div>
		</div>
		<!--  -->
	</div>
	<div class="ap-books__wrapper">
		<div class="book menu justify-onmax">
			<div class="justify-onmax__list">
				<ul class="ap-books-controls">
					<li data-aos="fade-right" 
						data-aos-duration="400" 
						data-aos-offset="50" 
						data-aos-once="true"><a href="/" class="gender"><div>Poesia</div></a></li>
					<li data-aos="fade-right" 
						data-aos-duration="600" 
						data-aos-offset="-10" 
						data-aos-once="true"><a href="/" class="gender"><div>Conto</div></a></li>
					<li data-aos="fade-right" 
						data-aos-duration="800" 
						data-aos-offset="-10" 
						data-aos-once="true"><a href="/" class="gender"><div>Crônica</div></a></li>
					<li data-aos="fade-right" 
						data-aos-duration="1000" 
						data-aos-offset="-10" 
						data-aos-once="true"><a href="/" class="gender"><div>Romance</div></a></li>
					<li data-aos="fade-right" 
						data-aos-duration="1400" 
						data-aos-offset="-10" 
						data-aos-once="true"><a href="/" class="gender"><div>Antologias</div></a></li>
					<li data-aos="fade-right" 
						data-aos-duration="1200" 
						data-aos-offset="-10" 
						data-aos-once="true"><a class="ap-hover toggle-authors-list" href="/"><div>Autores\as</div></a></li>
				</ul>
			</div>
		</div>
		<!-- 
			EMPTY WARNING
			here is the empty message, showed when
			no book is returned
		 -->
		<div class="ap-books-empty-warning hidden">
			<p>Nenhum resultado encontrado<b class="search-term"></b><b class="gender-term"></b></p>
			<span class="ap-books-clear-search">Limpar a Busca</span>
		</div>
		<!-- 
			BOOKS
			the div books-results-container is not styled, is used
			as a container to mustache render the template
		-->
		<div id="books-results-container"></div>
		<template id="book-template">
			<!-- The Book -->
			<div class="book"		
				 data-book="{{stringfyed}}"
				 ontouchstart="this.classList.toggle('hover');">
				 <!-- // -->
				 <div class="book__content">
				 	<!-- front -->
				 	<div class="front"
				 	style="background-image:url(<?= $this->Url->image('/freestore/covers/'); ?>{{cover}})">
				 		<div class="wrapper cover-flip">
				 			<div class="wrapper__controls">
								<button class="ap-btn--secondary ap-book-see">
				 					<i class="fa fa-eye"></i>
								</button>
				 				<button class="ap-btn--secondary book-flip">
				 					<i class="fa fa-exchange-alt"></i>
				 				</button>
				 			</div>
				 		</div>
				 	</div>
				 	<!-- back -->
				 	<div class="back">
				 		<div class="wrapper cover-flip">
				 			<div class="wrapper__synopsis">
				 				<div class="typo-paragraph">
				 					<a href="/" class="ap-book-see">
					 					<span><i class="fa fa-bookmark"></i></span>
					 					<b>{{title}}</b>
					 					<hr>
					 				</a>
				 				</div>
				 				<div class="read-more">
				 					<p>
					 					<span class="book-author">
					 						<b>
					 							<a class="ap-book-see" href="">
					 								{{author.author_first_name}} {{author.author_last_name}}
					 							</a>
					 						</b>
					 					</span>
					 					<br/><br/>
						 				{{truncDescription}}
				 					</p>
				 				</div>
				 			</div>
				 			<div class="wrapper__controls">
								<button class="ap-btn--secondary ap-book-see">
				 					<i class="fa fa-eye"></i>
								</button>
				 				<button class="ap-btn--secondary book-flip">
				 					<i class="fa fa-exchange-alt"></i>
				 				</button>
				 			</div>
				 		</div>
				 	</div>
				 </div>
			</div>
		</template>
	</div>
</section>
<!-- books footer -->
<section class="ap-books__footer">
	<div class="ap-books__footer-loadmore"
		 data-aos="zoom-out-up" 
		 data-aos-offset="150" 
		 data-aos-once="true">
		 <?= $this->Form->create("form-load-more-books", [
		 	"class" => "ap-form books-load-more loading",
		 	"url" => "/",
		 	"id" => "form-load-more-books"
		 ]) ?>
			<button class="ap-btn">
				<span class="text">Carregar Mais</span>
				<div class="spinner"></div>
			</button>
		<?= $this->Form->end(); ?>
	</div>
</section>
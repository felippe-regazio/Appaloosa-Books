<?php use Cake\Routing\Router; ?>
<aside class="ap-sidebar">
	<div class="ap-sidebar__content">
		<div class="ap-sidebar__col">
			<div class="ap-logo-img"></div>
			<ul class="menu">
				<li><a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'index']); ?>"><?=__('Home');?></a></li>
				<li><a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info']); ?>"><?=__('Originais');?></a></li>
				<li><a class="link invert" data-tile="#best-sellers" href=""><?=__('Best Seven');?></a></li>
				<li><a href="<?= Router::url(['controller'=>'appaloosa', 'action' => 'info']); ?>"><?=__('Informações Úteis');?></a></li>
			</ul>
			<hr>
			<ul>
				<li>
					<a href="magazine/" target="_blank">
						<?=__('Appaloosa Magazine<br/>Revista de literatura, etc');?>
					</a>
				</li>
			</ul>
		</div>
		<!-- BEST SELLERS TILE -->
		<div id="best-sellers" class="tile loading">
			<div class="ap-loading-circle"></div>
			<div class="tile__content">		
				<div class="controls">
					<a href="/" data-tile="#best-sellers">
						<span><i class="fa fa-arrow-left"></i></span>
					</a>
				</div>
				<h2>Appaloosa BestSeven</h2>
				<div class="bests-list"></div>
				<template>
					<div class="book" data-book="{{stringfyed}}">
						<a href="" class="ap-book-see">
							{{number}}. {{title}} <span>{{author.author_first_name}} {{author.author_last_name}}</span>
						</a>
					</div>
				</template>
			</div>
		</div>
		<!-- / -->
	</div>
</aside>
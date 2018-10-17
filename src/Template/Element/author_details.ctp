<!-- Author View -->
<div class="ap-author-details">
	<div class="ap-author-details__close toggle-author-details">
		<i class="fa fa-times"></i>
	</div>
	<div class="ap-loading-circle"></div>
	<div id="about-author-holder" class="about-author">
		<!-- TEMPLATE WILL BE RENDERED HERE -->
	</div>
</div>

<!-- Mustache Author View Content Template -->
<template id="about-author-template">
	<div class="about-author__avatar">
		<div class="wrapper">
			<div class="author-image" style="background-image: url(<?= FREESTORE . '/avatars/{{author_image}}'?> )"></div>
		</div>
	</div>
	<div class="about-author__name">
		<p>{{author_first_name}} {{author_last_name}}</p>
	</div>
	<div class="about-author__socials">
		<!-- facebook -->
		{{#author_links.facebook}}
			<a href="{{author_links.facebook}}" target="_blank"><i class="fab fa-facebook"></i></a>
		{{/author_links.facebook}}
		<!-- twitter -->
		{{#author_links.twitter}}
			<a href="{{author_links.twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>
		{{/author_links.twitter}}
		<!-- instagram -->
		{{#author_links.instagram}}
			<a href="{{author_links.instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
		{{/author_links.instagram}}
		<!-- youtube -->
		{{#author_links.youtube}}
			<a href="{{author_links.youtube}}" target="_blank"><i class="fab fa-youtube"></i></a>
		{{/author_links.youtube}}
		<!-- blog -->
		{{#author_links.blog}}
			<a href="{{author_links.blog}}" target="_blank"><i class="fa fa-pen-square"></i></a>
		{{/author_links.blog}}
		<!-- website -->
		{{#author_links.website}}
			<a href="{{author_links.website}}" target="_blank"><i class="fa fa-globe"></i></a>
		{{/author_links.website}}
	</div>
	<div class="about-author__bio">
		<div class="biography">
			<b>Sobre: </b>{{author_about}}
		</div>
	</div>
</template>
<!-- 
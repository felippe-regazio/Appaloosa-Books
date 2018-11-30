<?php use Cake\Routing\Router; ?>
<div class="ap-authors-list loading">
	<div class="ap-loading-circle"></div>
	<div class="ap-authors-list__close toggle-authors-list">
		<i class="fa fa-times"></i>
	</div>
	<div class="ap-authors-list__head">
		<h1><i class="fa fa-pen-square"></i> Lista de Autores</h1>
	</div>
	<div class="ap-authors-list__body">
		<div id="authors-list-content">
			<!-- mustache template -->
		</div>
		<template>
			<a href="/" class="toggle-author-details" data-author="{{author_id}}">
				{{author_first_name}}&nbsp;{{author_last_name}}
			</a>
		</template>
	</div>
	<div class="ap-authors-list__footer"></div>
</div>
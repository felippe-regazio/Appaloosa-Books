<div class="ap-book-details">
	<!--  -->
	<div id="ap-book-details-template-wrapper" class="ap-book-details__wrapper">
		<!-- BOOK DETAILS TEMPLATE GOES HERE -->
	</div>
</div>
<template id="ap-book-details-template">
	<div class="side cover-side">
		<img class="expand-book-cover" src="<?= $this->Url->image( '/freestore/covers/' ); ?>{{cover}}">
		<div class="cover-side__footer">
			<button class="ap-btn--primary expand-book-cover">
				<i class="fa fa-expand"></i>
			</button>
		</div>
	</div>
	<div class="side info-side">
		<span class="ap-book-close link"><i class="fa fa-times"></i></span>
		<!-- book info -->
		<div class="info-side__head">
			<h1 class="typo-title">
				<a href="/" class="ap-hover">
					<span class="author-name toggle-author-details" data-author="{{author.author_id}}">
						{{author.author_first_name}} {{author.author_last_name}}
					</span>
				</a>: 
				{{title}}
			</h1>
		</div>
		<!-- REVIEW -->
		<div class="info-side__review">
			<h3>Reviewer: <a href="{{Reviewers.link}}" target="_blank">{{reviewer.name}}</h3></a>
			<div class="info-side__review-roll">
				{{description}}
			</div>
			<div class="info-side__review-foot">
				<span class="info-side__review-more">
					<i class="fa fa-arrow-down"></i>
				</span>
				<span class="info-side__click-review">
					click
				</span>
			</div>
		</div>
		<!-- ACTIONS -->
		<div class="info-side__actions">
			{{#files.epub}}
				<a href="<?= $this->Url->image( '/freestore/binaries/' ); ?>{{files.epub}}">
					<button class="ap-btn--secondary">
						<i class="fa fa-book-open"></i> EPUB
					</button>
				</a>
			{{/files.epub}}
			{{#files.pdf}}
				<a href="<?= $this->Url->image( '/freestore/binaries/' ); ?>{{files.pdf}}" target="_blank">
					<button class="ap-btn--secondary">
						<i class="fa fa-book-open"></i> PDF
					</button>
				</a>
			{{/files.pdf}}
			{{#author.author_email}}
				<button class="ap-btn--secondary toggle-mail-to" data-author-id="{{author.author_id}}" data-book-name="{{title}}">
						<i class="fa fa-envelope"></i> E-MAIL
				</button>
			{{/author.author_email}}
			{{#author.author_options.email_PagSeguro}}
			<button class="ap-btn--secondary ap-btn--ap-a toggle-support" data-author-pg="{{author.author_options.email_PagSeguro}}" data-author-name="{{author.author_first_name}} {{author.author_last_name}}">
				<i class="fa fa-heart"></i> APOIAR
			</button>
			{{/author.author_options.email_PagSeguro}}
		</div>
		<!-- INFORMATION -->
		<div class="info-side__information">
			<hr>
			<table>
				<tr>
					<td><i class="fa fa-user-circle"></i> Autor</td>
					<td>
						<a class="author-name toggle-author-details" href="/" data-author="{{author.author_id}}">
							{{author.author_first_name}} {{author.author_last_name}}
						</a>
					</td>
					<td></td>
					<td>
						{{#author.author_links.facebook}}
							<a href="{{author.author_links.facebook}}" target="_blank"><i class="fab fa-facebook"></i></a>
						{{/author.author_links.facebook}}
					</td>
				</tr>
				<tr>
					<td><i class="fa fa-eye"></i> Views</td>
					<td class="td-fire">
						<i class="fa fa-fire"></i>
						<i class="fa fa-fire"></i>
						<i class="fa fa-fire"></i>
					</td>
					<td></td>
					<td>{{views}}</td>
				</tr>
				<tr>
					<td><i class="fa fa-bookmark"></i> Gênero</td>
					<td></td>
					<td></td>
					<td>{{gender.name}}</td>
				</tr>
				<tr>
					<td><i class="fa fa-calendar"></i> Desde</td>
					<td></td>
					<td></td>
					<td>2018</td>
				</tr>
			</table>
		</div>
	</div>	
</template>
<!-- Author Details -->
<?= $this->element('author_details'); ?>
<!-- Support -->
<?= $this->element('support'); ?>
<!-- Mail -->
<?= $this->element('mail_to'); ?>
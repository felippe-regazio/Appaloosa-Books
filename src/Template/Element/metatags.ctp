<?php use Cake\Routing\Router; ?>
<!-- SEO & Page Metas Pre Definitions -->
<?php
$default_title       = __("Appaloosa Books - Livros Independentes Online e Gratuitos");
$default_image       = Router::url("/", true) . "img/ap-feature.png";
$default_description = __("A Appaloosa é uma casa de publicações digitais com foco na literatura contemporânea e independente. Publicamos desde textos até livros completos nos formatos epub e pdf com edição profissional e alta qualidade gráfica. Basicamente disponibilizamos pequenos e incríveis universos em um formato colaborativo e gratuito");
?>
<!-- SEO METAS PRINT -->
<meta name="description" content="<?= $metas['description'] ?>" />
<!-- Open Graph -->
<meta property="og:title" content="<?= $metas['title'] ?>" />
<meta property="og:url" content="<?= $metas['url'] ?>" />
<meta property="og:image" content="<?= $metas['image'] ?>" />
<meta property="og:description" content="<?= $metas['description'] ?>" />
<meta property="og:site_name" content="<?= $metas['name'] ?>" />
<!-- Twitter Card -->
<meta name="twitter:card" content="<?= $metas['image'] ?>">
<meta name="twitter:title" content="<?= $metas['title'] ?>">
<meta name="twitter:description" content="<?= $metas['description'] ?>">
<meta name="twitter:image" content="<?= $metas['image'] ?>">
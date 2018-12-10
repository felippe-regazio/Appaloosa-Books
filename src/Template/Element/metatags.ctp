<?php use Cake\Routing\Router; ?>
<!-- SEO & Page meta Pre Definitions -->
<?php
$meta['name']  = isset($meta['name']) ? $meta['name'] : "Appaloosa Books - Livros Independentes Online";
$meta['url']   = isset($meta['url']) ? $meta['url'] : Router::url("/", true);
$meta['title'] = isset($meta['title']) ? $meta['title'] : __("Appaloosa Books - Livros Independentes Online");
$meta['image'] = isset($meta['image']) ? $meta['image'] : Router::url("/", true) . "img/ap-feature.png";
$meta['description'] = isset($meta['description']) ? $meta['description'] : __("A Appaloosa é uma casa de publicações digitais com foco na literatura contemporânea e independente. Publicamos nos formatos pdf e epub. Basicamente disponibilizamos pequenos e incríveis universos em um formato colaborativo e gratuito");
?>
<!-- SEO meta PRINT -->
<meta name="description" content="<?= $meta['description'] ?>" />
<!-- Open Graph -->
<meta property="og:title" content="<?= $meta['title'] ?>" />
<meta property="og:url" content="<?= $meta['url'] ?>" />
<meta property="og:image" content="<?= $meta['image'] ?>" />
<meta property="og:description" content="<?= $meta['description'] ?>" />
<meta property="og:site_name" content="<?= $meta['name'] ?>" />
<!-- Twitter Card -->
<meta name="twitter:card" content="<?= $meta['image'] ?>">
<meta name="twitter:title" content="<?= $meta['title'] ?>">
<meta name="twitter:description" content="<?= $meta['description'] ?>">
<meta name="twitter:image" content="<?= $meta['image'] ?>">
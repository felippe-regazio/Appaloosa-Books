<?php use Cake\Routing\Router; ?>
<div class="info-squares">
  <div class="info-squares__container">
      
      <?php
        
        $squares = array(
          0 => [
            "icon" => "fa-pen-square",
            "link" => "info/#publish",
            "text" => "Publique Seu Livro na Appaloosa Books"
          ],
          1 => [
            "icon" => "fa-life-ring",
            "link" => "info/#support",
            "text" => "Apoie Autores Independentes"
          ],
          2 => [
            "icon" => "fa-hand-spock",
            "link" => "info/#itsfree",
            "text" => "Escolha o livro, baixe e leia. É grátis"
          ],          
          3 => [
            "icon" => "fa-hand-holding-usd",
            "link" => "info/#noncomercial",
            "text" => "Editora Não Comercial. Publicamos os/as fodas"
          ],
          4 => [
            "icon" => "fa-smile",
            "link" => "info/#adfree",
            "text" => "Sem propagandas e banners no site"
          ],
          5 => [
            "icon" => "fa-cloud",
            "link" => "info/#allonline",
            "text" => "Uma Editora 100% Online"
          ],          
        );

        foreach( $squares as $square ):
      ?>

      <a href="<?= $square["link"] ?>" class="square">
        <div class="square__content">
          <div class="square__content-block">
            <i class="fa <?= $square["icon"] ?>"></i>
          </div>
          <div class="square__content-block">
            <p><?= $square["text"] ?></p>
          </div>
        </div>
      </a>
      
      <?php endforeach; ?>
  </div>
</div>
<?php use Cake\Routing\Router; ?>
<div class="info-squares">
  <div class="info-squares__container">
    <?php for($i=0;$i<6;$i++): ?>
      <a href="/" class="square">
        <div class="square__content">
          <div class="square__content-block">
            <i><?= $i ?></i>
          </div>
          <div class="square__content-block">
            <p>Nisi id elit ad adipisicing velit elit eiusmod.</p>
          </div>
        </div>
      </a>
    <?php endfor; ?>
  </div>
</div>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="flash-success callout callout-success alert-dismissible" onclick="this.classList.add('hidden');">
		<script>
			(function(){ 
				setTimeout(function(){
					$(".flash-success").fadeOut("slow");
				}, 4000 );
			})()
		</script>
			<p>
				<i class="fa fa-star"></i> <?= $message ?>
			</p>
		</div>
	</div>
</div>

<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="row">
	<div class="col-sm-12">
		<div class="flash-error callout callout-danger alert-dismissible" onclick="this.classList.add('hidden');">
		<script>
			(function(){ 
				setTimeout(function(){
					$(".flash-error").fadeOut("slow");
				}, 4000 );
			})()
		</script>
			<p>
				<i class="fa fa-ban"></i> <?= $message ?>
			</p>
		</div>
	</div>
</div>

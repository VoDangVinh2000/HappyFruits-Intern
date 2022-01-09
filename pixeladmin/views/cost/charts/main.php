<div id="content-wrapper">
	<div class="row">
		<?php
		if ($active_chart_ids):
			foreach($active_chart_ids as $chart_id):?>
				<div class="charts" id="<?=$chart_id?>"></div>
		<?php
			endforeach;
		endif;
		?>
	</div><!-- / .row -->
</div><!-- / #content-wrapper -->
    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
	        <?php
	        foreach($chart_ids as $chart_id => $options):
		        ?>
		        <div class="<?=$chart_id?>-container chart-container">
			        <div class="<?=!empty($options['class'])?$options['class']:''?>">
				        <div class="row">
                            <?php if(!empty($options['has_filter'])):?>
					        <div class="col-lg-12">
						        <ul id="<?=$chart_id?>-filter" class="for_chart_filter" style="display: none;">
							        <li>Từ:
								        <input class="form-control start_date" style="width: 120px;" size="16" id="<?=$chart_id?>-filter_start_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y', strtotime('-1 month'))?>" readonly=""/>
							        </li>
							        <li>đến:
								        <input class="form-control end_date" style="width: 120px;" size="16" id="<?=$chart_id?>-filter_end_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
							        </li>
							        <li>
								        <a id="<?=$chart_id?>-filter_search" class="btn btn-success filter_search"><i class="fa fa-search"></i>&nbsp;Lọc</a>
							        </li>
						        </ul>
					        </div>
                            <?php endif; ?>
					        <iframe class="report_chart" src ="<?php echo BASE_URL.'chi-phi/bieu-do/'. $chart_id?>" id="<?=$chart_id?>-iframe" frameborder="0" width="100%">
						        <p>Your browser does not support iframes.</p>
					        </iframe>
				        </div>
			        </div>
		        </div>
	        <?php endforeach; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->
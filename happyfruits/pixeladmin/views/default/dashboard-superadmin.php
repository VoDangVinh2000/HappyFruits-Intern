	<div id="content-wrapper">
		<?php $controlerObj->load_view('elements/pageheader');?>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Tổng quan</a></li>
            <?php foreach($chart_ids as $group_code => $options): ?>
            <li><a data-toggle="tab" href="#tab_<?=$group_code?>"><?=$options['name']?></a></li>
            <?php endforeach;?>
        </ul>

        <div class="tab-content">
            <div id="general" class="tab-pane fade in active">
                <div class="col-lg-12 charts" id="total_per_months_column_chart"></div>
                <div class="col-lg-12 charts" id="total_orders_by_distance_column_chart"></div>
            </div>
            <?php foreach($chart_ids as $group_code => $options): ?>
            <div id="tab_<?=$group_code?>" class="tab-pane fade">
                <?php foreach($options['charts'] as $chart_id => $class):?>
                    <div class="<?=$chart_id?>-container chart-container">
                        <div class="<?=$class?>">
                            <div class="row">
                                <div class="col-lg-12 chart-filter-container">
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
                                <iframe class="report_chart" src ="<?php echo BASE_URL.'bieu-do/'. $chart_id?>" id="<?=$chart_id?>-iframe" frameborder="0" width="100%">
                                    <p>Your browser does not support iframes.</p>
                                </iframe>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach;?>
        </div>
    </div><!-- / #content-wrapper -->

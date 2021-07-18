	<div id="content-wrapper">
		<?php $controlerObj->load_view('elements/pageheader');?>
		<div class="row">
            <?php if(Users::do_shipping()):?>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-info panel-dark">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?=$number_of_shipping_records?></div>
                                <div>Đơn hàng đã giao trong tháng.</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=BASE_URL. $URIs['shipping_details']?>/them">
                        <div class="panel-footer">
                            <span class="pull-left">Thêm</span>
                            <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endif;?>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success panel-dark">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?=$number_of_assessment_records?></div>
                                <div>Lần đánh giá trong tháng.</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=BASE_URL. $URIs['assessment']?>/them">
                        <div class="panel-footer">
                            <span class="pull-left">Thêm</span>
                            <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning panel-dark">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?=$kpi_score?></div>
                                <div>Điểm KPI trong tháng!</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?=BASE_URL. $URIs['assessment']?>">
                        <div class="panel-footer">
                            <span class="pull-left">Xem danh sách đánh giá</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="kpi_area_chart"></div>
        </div>
    </div><!-- / #content-wrapper -->

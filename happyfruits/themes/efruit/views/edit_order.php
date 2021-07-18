<?php if(can_edit_order($order)):?>
<script>
    var IS_SIMPLE_VIEW = <?=$is_simple_view?1:0?>;
    var ORDER_CODE = '<?=!empty($order)?$order['code']:''?>';
</script>
<?php endif; ?>
<?php if(empty($is_simple_view)):?>
<?php $this->load_theme_file('page-header.php') ?>
<?php endif; ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
            <?php $this->load_partial('category-list') ?>
            <div class="content-container">
                <div class="content-body" style="background: #fff;<?=!can_edit_order($order)?'max-width: 980px;':''?>margin: 20px auto; padding: 20px;">
                    <?php if(!empty($order)):?>
                    <div class="row">
                        <div class="col-md-8 col-xs-12 col-md-offset-2">
                            <h1 class="text-center">
                                <span class="efruit-vi">Sửa đơn hàng #<?=$order['code']?></span>
                                <span class="efruit-en efruitjs">Edit order #<?=$order['code']?></span>
                            </h1>
                        </div>
                    </div>
                    <?php $this->load_partial('order_details', array('class' => 'col-md-8 col-xs-12 col-md-offset-2')); ?>
                        <?php if(!can_edit_order($order)):?>
                            <div class="row">
                                <div class="col-md-8 col-xs-12 col-md-offset-2">
                                    <h3 class="text-center">
                                        <span bind-translate="Đơn hàng có tình trạng">Đơn hàng có tình trạng</span>&nbsp;<span class="bold" bind-translate="<?=get_status_string(getvalue($order, 'status'))?>"><?=get_status_string(getvalue($order, 'status'))?></span><br/>
                                        <span bind-translate="Bạn không thể sửa đơn hàng này.">Bạn không thể sửa đơn hàng này.</span>
                                    </h3>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php else:?>
                    <div class="row">
                        <div class="col-md-8 col-xs-12 col-md-offset-2">
                            <p style="text-align:center">
                                <img alt="" src="http://www.efruit.vn/uploads/fresh-fruit-l-800gr.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/meeting-fruit-l.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/mixed-fruit.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/phan-trai-cay-m-freshfruit-2.jpg" style="height:120px; margin:10px;" />​
                            </p>
                            <h3 class="text-center"><span bind-translate="Mã đơn hàng không chính xác.">Mã đơn hàng không chính xác.</span></h3>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(can_edit_order($order)):?>
                <div id="menu-container" class="container-fluid efruitjs" style="margin-top: 20px;">
                    <div class="col-sm-9 nopadding">
                        <div class="row">
                            <?php foreach($all_products as $item):?>
                                <div class="col-sm-3">
                                    <?php $this->load_partial('product-item-box', array('item' => $item)); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-sm-3 nopadding hidden-xs">
                        <?php $this->load_partial('cart') ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(empty($is_simple_view)):?>
            <div class="clearfix"></div>
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_partial('cooperators') ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if(empty($is_simple_view)):?>
    <?php $this->load_theme_file('page-footer.php') ?>
<?php endif; ?>
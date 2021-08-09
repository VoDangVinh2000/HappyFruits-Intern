<?php $this->load_theme_file('page-header.php') ?>
<div class="application-body">
    <div class="y-grid">
        <div class="y-results" id="y-results">
            <?php $this->load_partial('hero-image') ?>
<<<<<<< HEAD
            <!-- <?//php $this->load_partial('category-list') ?> -->
=======
            <!-- </?php $this->load_partial('category-list') ?> -->
>>>>>>> 6db262671c647aacd52816be66f381eccdaa39d8
            <div class="content-container">
                <div class="content-body" style="background: #fff;max-width: 980px;margin: 20px auto; padding: 20px;">
                    <?php if(!empty($order)):?>
                    <form id="rateFrm" method="post">
                        <input type="hidden" id="order_id" value="<?=$order['id']?>" />
                        <input type="hidden" id="assessment_id" value="<?=getvalue($order_assessment, 'id')?>" />
                        <div class="row">
                            <div class="col-md-10 col-xs-12 col-md-offset-1">
                                <p style="text-align:center">
                                    <img alt="" src="http://www.efruit.vn/uploads/fresh-fruit-l-800gr.jpg" style="height:120px; margin:10px;" />
                                    <img alt="" src="http://www.efruit.vn/uploads/meeting-fruit-l.jpg" style="height:120px; margin:10px;" />
                                    <img alt="" src="http://www.efruit.vn/uploads/mixed-fruit.jpg" style="height:120px; margin:10px;" />
                                    <img alt="" src="http://www.efruit.vn/uploads/phan-trai-cay-m-freshfruit-2.jpg" style="height:120px; margin:10px;" />​
                                </p>
                                <h1 class="text-center">
                                    <span class="efruit-vi">Đánh giá đơn hàng<br/>#<?=$order['code']?></span>
                                    <span class="efruit-en efruitjs">Assessment of order quality<br/>#<?=$order['code']?></span>
                                </h1>
                            </div>
                            <?php $this->load_partial('order_details'); ?>
                            <div class="col-md-10 col-xs-12 col-md-offset-1">
                                <p class="assessment_content text-center efruitjs">{{__('Chưa đánh giá')}}</p>
                                <div class="assessment_star text-center">
                                    <div class="star-box">
                                        <div id="star0-container">
                                            <input id="star0" type="radio" name="score" class="input-hidden" value="0" <?=getvalue($order_assessment, 'score')===0?'checked':''?>>
                                            <label for="star0" title="{{__('Rất tệ')}}"><img class="star-rate <?=getvalue($order_assessment, 'score', -1)>=0?'':'gray-star'?>" src="<?=get_theme_assets_url()?>img/star.png"></label>
                                        </div>
                                        <div id="star1-container">
                                            <input id="star1" type="radio" name="score" class="input-hidden" value="1" <?=getvalue($order_assessment, 'score')==1?'checked':''?>>
                                            <label for="star1" title="{{__('Tệ')}}"><img class="star-rate <?=getvalue($order_assessment, 'score', -1)>=1?'':'gray-star'?>" src="<?=get_theme_assets_url()?>img/star.png"></label>
                                        </div>
                                        <div id="star2-container">
                                            <input id="star2" type="radio" name="score" class="input-hidden" value="2" <?=getvalue($order_assessment, 'score')==2?'checked':''?>>
                                            <label for="star2" title="{{__('Bình thường')}}"><img class="star-rate <?=getvalue($order_assessment, 'score', -1)>=2?'':'gray-star'?>" src="<?=get_theme_assets_url()?>img/star.png"></label>
                                        </div>
                                        <div id="star3-container">
                                            <input id="star3" type="radio" name="score" class="input-hidden" value="3" <?=getvalue($order_assessment, 'score')==3?'checked':''?>>
                                            <label for="star3" title="{{__('Tốt')}}"><img class="star-rate <?=getvalue($order_assessment, 'score', -1)>=3?'':'gray-star'?>" src="<?=get_theme_assets_url()?>img/star.png"></label>
                                        </div>
                                        <div id="star4-container">
                                            <input id="star4" type="radio" name="score" class="input-hidden" value="4" <?=getvalue($order_assessment, 'score')==4?'checked':''?>>
                                            <label for="star4" title="{{__('Rất tốt')}}"><img class="star-rate <?=getvalue($order_assessment, 'score', -1)>=4?'':'gray-star'?>" src="<?=get_theme_assets_url()?>img/star.png"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row criteria-list">
                                    <a class="btn btn-default <?=strstr(getvalue($order_assessment, 'criteria'), 'Dịch vụ tốt')?'active':''?>" href="#" data-value="Dịch vụ tốt" bind-translate="Dịch vụ tốt">Good service</a>
                                    <a class="btn btn-default <?=strstr(getvalue($order_assessment, 'criteria'), 'Thức uống ngon')?'active':''?>" href="#" data-value="Thức uống ngon" bind-translate="Thức uống ngon">Thức uống ngon</a>
                                </div>

                                <p class="modal-choose" bind-translate="Nhận xét">Nhận xét</p>
                                <textarea class="form-control" name="comment" rows="5" placeholder="{{__('Hãy cho chúng tôi biết nhận xét của bạn để phục vụ tốt hơn')}}."><?=getvalue($order_assessment, 'feedback')?></textarea>
                                <p class="text-center submit">
                                    <button type="button" class="btn btn-success btn-submit efruit-vi">Đánh giá</button>
                                    <button type="button" class="btn btn-success btn-submit efruit-en efruitjs">Submit</button>
                                </p>
                            </div>
                        </div>
                    </form>
                    <?php else:?>
                    <div class="row">
                        <div class="col-md-8 col-xs-12 col-md-offset-2">
                            <p style="text-align:center">
                                <img alt="" src="http://www.efruit.vn/uploads/fresh-fruit-l-800gr.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/meeting-fruit-l.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/mixed-fruit.jpg" style="height:120px; margin:10px;" />
                                <img alt="" src="http://www.efruit.vn/uploads/phan-trai-cay-m-freshfruit-2.jpg" style="height:120px; margin:10px;" />​
                            </p>
                            <h3>
                                <span class="efruit-vi">Khách hàng có thể đánh giá đơn hàng của mình thông qua đường dẫn gửi qua email hoặc qua URL theo định dạng sau <?=ROOT_URL.'vi/danh-gia/[MA_DON_HANG]'?>.</span>
                                <span class="efruit-en efruitjs">Customer can assess our service by accessing the URL which is sent via email or entering the URL in following format <?=ROOT_URL.'vi/danh-gia/[ORDER_CODE]'?>.</span>
                            </h3>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php $this->load_partial('about-us') ?>
            <?php $this->load_partial('cooperators') ?>
        </div>
    </div>
</div>
<?php $this->load_theme_file('page-footer.php') ?>
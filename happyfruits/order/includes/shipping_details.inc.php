    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="text-align: center;">
            <?php
                $shipping_fee_des = get_setting('general_shiping_fee_description');
                $is_image = filter_var($shipping_fee_des, FILTER_VALIDATE_URL) && in_array(pathinfo($shipping_fee_des, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'));
            ?>
            <?php if($is_image): ?>
                <img style="max-width: 100%;" src="<?=$shipping_fee_des. '?t='. date('Ymd')?>">
            <?php else: ?>
                <div><?=$shipping_fee_des?></div>
            <?php endif; ?>
        </div>
      </div>
    </div>

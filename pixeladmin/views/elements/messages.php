                    <?php
                        $msg = get_last_message();
                        if ($msg):
                    ?>
                    <div class="note note-success">
    					<p><?=$msg?></p>
    				</div>
                    <?php endif;?>
                    <?php
                        $error = get_last_error($data_return);
                        if ($error):
                    ?>
                    <div class="note note-danger">
    					<p><?=$error?></p>
    				</div>
                    <?php endif;?>
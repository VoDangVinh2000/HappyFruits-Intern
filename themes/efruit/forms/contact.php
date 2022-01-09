        <div class="row">
            <div class="form-group col-lg-6 col-md-6" id="contact_form">
                <form id="contactFrm" method="post" name="contact" action="">
                    <label for="name"><span bind-translate="Họ tên">Họ tên</span>:</label> <input id="name" name="name" type="text" class="form-control required" id="author" maxlength="40" />
                    <label for="email">Email:</label> <input id="email" name="email" type="text" class="form-control required email" id="email" maxlength="40" />
                    <label for="message"><span bind-translate="Thông điệp">Thông điệp</span>:</label> <textarea id="message" class="form-control required" name="message" rows="10" cols="0"></textarea>
                    <br />
                    <input type="hidden" value="send_contact" name="action"/>
                    <input type="text" class="honey" value="" name="<?php echo md5("smcf-info@". DOMAIN_NAME . date("WY"));?>"/>
                    <input type="hidden" name="token" value="<?php echo md5("smcf-info@". DOMAIN_NAME . date("WY"));?>"/>
                    <button type="button" class="btn btn-success btn-submit"><i class="fa fa-envelope"></i> <span bind-translate="Gửi">Gửi</span></button>
                </form>
            </div>
            <div class="col-lg-6 col-md-6">
            
            </div>
        </div>
        <p></p>
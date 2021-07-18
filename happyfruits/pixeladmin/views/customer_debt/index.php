    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
		<div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
                        <?php $controlerObj->load_view("customer_debt/list");?>
                    </div>
                    <div class="for_datatable_filter">
                        <ul>
                            <li>Ngày thanh toán từ:
                                <input class="form-control" style="width: 120px;" size="16" id="filter_start_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('01/m/Y')?>" readonly=""/>
                            </li>
                            <li>Đến:
                                <input class="form-control" style="width: 120px;" size="16" id="filter_end_date" type="text" data-date-format="dd/mm/yyyy" value="<?=date('d/m/Y')?>" readonly=""/>
                            </li>
                            <li>
                                <a id="filter_search" class="btn btn-success"><i class="fa fa-search"></i> Tìm</a>&nbsp;
	                            <a href="<?=BASE_URL. $URIs['customer_debts'] . '/them'?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm</a>
                            </li>
	                        <?php if (Users::can('view_summary', 'customer_debt')):?>
		                        <li><div class="summary"><span>Tổng: </span><span class="total_money"></span>đ</div></li>
	                        <?php endif;?>
                        </ul>
                        <input type="hidden" id="current_date" value="<?=date('d/m/Y')?>" />
                        <input type="hidden" id="filterString" value="" />
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
	    <div class="modal fade" id="frmPaymentContainaer" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" style="overflow: hidden;">
		    <div class="modal-dialog modal-md">
			    <div class="modal-content" style="text-align: center;">
				    <div class="modal-header" style="background: #5cb85c; color: #fff;">
					    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
					    <h2 class="modal-title">Tất toán công nợ</h2>
				    </div>
				    <div class="modal-body">
					    <form name="frmPayment" id="frmPayment" method="post" action="" class="one-line">
						    <div class="form-group">
							    <label for="user_id" class="control-label">Nhân viên *</label>
							    <?php echo html_select($members, 'user_id', 'fullname', 'name="user_id" class="form-control" id="user_id"');?>
							    <div class="help-block with-errors"></div>
						    </div>
						    <div class="form-group">
							    <label for="paid_amount" class="control-label">Tiền thanh toán *</label>
							    <input type="text" class="form-control number normal inline" id="paid_amount" name="paid_amount" placeholder="Tiền thanh toán " required="" data-error="Vui lòng nhập số tiền" maxlength="8" value="" />
							    <div class="help-block with-errors"></div>
						    </div>
						    <div class="form-group">
							    <label for="payment_type" class="control-label">Loại thanh toán *</label>
							    <select name="payment_type" class="form-control" id="payment_type">
								    <option value="cash" selected="selected">Tiền mặt</option>
								    <option value="bank_balance">Chuyển khoản</option>
							    </select>
							    <div class="help-block with-errors"></div>
						    </div>
						    <input type="hidden" value="0" name="debt_id" />
						    <input type="hidden" value="admin_finish_customer_debt" name="action" />
						    <a href="" class="btn btn-success" id="savePayment"><i class="fa fa-save"></i> <span>Lưu</span></a>
						    <button data-dismiss="modal" class="btn btn-default" type="button">Đóng</button>
					    </form>
				    </div>
			    </div>
		    </div>
	    </div>
    </div><!-- /#content-wrapper -->

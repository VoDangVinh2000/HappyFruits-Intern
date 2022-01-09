    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
		<div class="page-wrapper">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-userlist">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Username</th>
                                <th style="width: 90px;">Tên</th>
                                <th style="width: 100px;">Email</th>
                                <th style="width: 60px;">Loại</th>
                                <th style="width: 60px;">Lương/giờ</th>
                                <th class="not_filter" style="width: 60px;">Giao hàng</th>
                                <th class="not_filter" style="width: 70px;">Hoạt động</th>
                                <th style="width:70px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($users): ?>
                                <?php foreach($users as $item):?>
                            <tr id="<?=$item['user_id']?>">
                                <td><a href="<?=BASE_URL. $URIs['users']?>/<?=$item['user_id']?>" class="username"><?=$item['username']?></a></td>
                                <td class="fullwidth"><input type="text" value="<?=$item['fullname']?>" class="fullname" /></td>
                                <td class="fullwidth"><input type="text" value="<?=$item['email']?>" class="email" /></td>
                                <td class="not_filter">
                                    <?=$item['type_name']?>
                                    <input type="hidden" value="<?=$item['type_id']?>" class="type_id" />
                                </td>
                                <td class="center"><input type="text" style="width: 30px;text-align: right;" maxlength="2" value="<?=$item['rate_per_hour']?>" class="rate_per_hour" /> 000</td>
                                <td class="center not_filter">
                                    <div class="custom-checkbox-with-tick small">
                                        <input id="do_shipping_<?=$item['user_id']?>" type="checkbox" value="1" class="do_shipping" <?=getvalue($item, 'do_shipping')?'checked="checked"':''?> autocomplete="off"/>
                                        <label for="do_shipping_<?=$item['user_id']?>">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="center not_filter">
                                    <div class="custom-checkbox-with-tick small">
                                        <input id="enabled_<?=$item['user_id']?>" type="checkbox" value="1" <?=(getvalue($logged_user, 'user_id') == $item['user_id'])?'disabled="disabled"':''?> class="enabled" <?=getvalue($item, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                        <label for="enabled_<?=$item['user_id']?>">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="center not_filter">
                                    <a target="_blank" href="<?=BASE_URL. $URIs['users']?>/<?=$item['user_id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
                                    <?php if (getvalue($logged_user, 'user_id') != $item['user_id']):?>
                                        <?php if(Users::is_super_admin() || Users::is_admin_logged_as_member()):?>
                                        <a href="#" class="login_as_user btn btn-sm btn-info" title="Đăng nhập bằng tài khoản thành viên"><i class="fa fa-sign-in"></i></a>
                                        <?php endif;?>
                                        <?php if ($item['type_id'] != SUPER_ADMIN_TYPE_ID):?>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash-o"></i></a>
                                        <?php endif;?>
                                    <?php endif;?>
                                </td>
                            </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /#page-wrapper -->
    </div><!-- /#content-wrapper -->

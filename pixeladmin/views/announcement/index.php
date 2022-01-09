    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter_section">
                        <ul>
                            <li><a href="<?=BASE_URL. $URIs['announcements']?>/them" id="add_announcement" class="btn btn-success"><i class="fa fa-add"></i> Thêm thông báo</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-announcementlist">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th class="not_filter">TG bắt đầu</th>
                                    <th class="not_filter">TG kết thúc</th>
                                    <th class="not_filter" style="width: 70px;">Hoạt động</th>
                                    <th style="width: 90px;" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($announcements): ?>
                                    <?php foreach($announcements as $item):?>
                                <tr id="<?=$item['id']?>"> 
                                    <td class="fullwidth"><input type="text" value="<?=$item['name']?>" class="name" /></td>
                                    <td data-value="<?=strtotime($item['start_dtm'])?>"><?=date('d/m/Y H:i', strtotime($item['start_dtm']))?></td>
                                    <td data-value="<?=strtotime($item['end_dtm'])?>"><?=date('d/m/Y H:i', strtotime($item['end_dtm']))?></td>
                                    <td class="center not_filter">
                                        <div class="custom-checkbox-with-tick small">
                                            <input id="enabled_<?=$item['id']?>" type="checkbox" value="1" class="enabled" <?=getvalue($item, 'enabled')?'checked="checked"':''?> autocomplete="off"/>
                                            <label for="enabled_<?=$item['id']?>">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="<?=BASE_URL. $URIs['announcements']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
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
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->
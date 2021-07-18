    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter_section">
                        <ul>
                            <li><a href="<?=BASE_URL. $URIs['pages']?>/them" id="add_page" class="btn btn-success"><i class="fa fa-add"></i> Thêm trang</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-pagelist">
                            <thead>
                                <tr>
                                    <th style="width: 150px;">Mã</th>
                                    <th>Tên</th>
                                    <th class="not_filter">Template</th>
                                    <th style="width: 80px;" class="not_filter">Cập nhật</th>
                                    <th style="width: 90px;" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($pages): ?>
                                    <?php foreach($pages as $item):
                                        $template = str_replace('.php','', $item['page_template']);
                                        $template = ucwords(str_replace(array('_','-'),' ', $template));
                                    ?>
                                <tr id="<?=$item['page_id']?>"> 
                                    <td class="fullwidth"><input type="text" value="<?=$item['page_code']?>" class="page_code" /></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['page_title']?>" class="page_title" /></td>
                                    <td class="has_tooltip"><?=$template?></td>
                                    <td data-value="<?=strtotime($item['modified_dtm'])?>"><?=date('H:i d/m/Y', strtotime($item['modified_dtm']))?></td>
                                    <td class="center">
                                        <a target="_blank" title="Xem" class="view_item btn btn-sm btn-info" href="<?=frontend_url($item['page_code'])?>"><i class="fa fa-newspaper-o"></i></a>
                                        <a href="<?=BASE_URL. $URIs['pages']?>/<?=$item['page_id']?>" class="btn btn-sm btn-warning" title="Sửa"><i class="fa fa-edit"></i></a>
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
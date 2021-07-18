    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-documentlist">
                            <thead>
                                <tr>
                                    <th style="width: 150px;">Mã</th>
                                    <th>Tên</th>
                                    <th class="not_filter">Mô tả</th>
                                    <th style="width: 80px;" class="not_filter">Cập nhật</th>
                                    <th style="width: 90px;" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($documents): ?>
                                    <?php foreach($documents as $item):?>
                                <tr id="<?=$item['id']?>">
                                    <?php if(Users::can_access('document', 'modify')):?>   
                                    <td class="fullwidth"><input type="text" value="<?=$item['code']?>" class="code" /></td>
                                    <td class="fullwidth"><input type="text" value="<?=$item['name']?>" class="name" /></td>
                                    <?php else:?>
                                    <td><?=$item['code']?></td>
                                    <td><?=$item['name']?></td>
                                    <?php endif;?>
                                    <td class="has_tooltip">
                                        <span><?php echo word_limiter($item['description'], 5);?></span>
                                        <div class="hidden tooltip_content">
                                            <p><?php echo $item['description'];?></p>
                                        </div>
                                    </td>
                                    <td data-value="<?=strtotime($item['modified_dtm'])?>"><?=date('H:i d/m/Y', strtotime($item['modified_dtm']))?></td>
                                    <td class="center">
                                        <a href="<?=ROOT_URL. 'tai-lieu/'. $item['code']?>" class="view_item btn btn-sm btn-info" title="Xem" target="_blank"><i class="fa fa-newspaper-o"></i></a>
                                        <?php if(Users::can_access('document', 'modify')):?>   
                                        <a href="<?=BASE_URL. $URIs['documents']?>/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash"></i></a>
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
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->
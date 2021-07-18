    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
		<div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div id="list_container" class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-mainlist">
		                    <thead>
		                    <tr>
			                    <th style="width: 50px;">ID</th>
			                    <th>Loại</th>
			                    <th>Ghi chú</th>
			                    <th style="width:120px" class="not_filter"><span class="hidden-lg hidden-md">Thao tác</span></th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    <?php if($types): ?>
			                    <?php foreach($types as $item): ?>
				                    <tr id="<?=$item['id']?>">
					                    <td>
						                    <?php if (Users::can_access('cost', 'type')):?>
						                    <a href="<?=BASE_URL. $URIs['costs']?>/loai/<?=$item['id']?>"><?=$item['id']?></a>
					                        <?php else:?>
						                    <?=$item['id']?>
						                    <?php endif;?>
					                    </td>
					                    <td>
						                    <?php if (Users::can_access('cost', 'type')):?>
						                    <input type="text" style="width: 100%;" value="<?=$item['name']?>" class="name" />
						                    <?php else:?>
						                    <?=$item['name']?>
						                    <?php endif;?>
					                    </td>
					                    <td class="has_tooltip">
						                    <span><?php echo word_limiter($item['description'], 20);?></span>
						                    <div class="hidden tooltip_content">
							                    <p style="margin-bottom: 0;"><?=str_replace("\n",'<br/>', $item['description'])?></p>
						                    </div>
					                    </td>
					                    <td class="center not_filter">
						                    <?php if (Users::can_access('cost', 'type')):?>
							                    <a target="_blank" href="<?=BASE_URL. $URIs['costs']?>/loai/<?=$item['id']?>" class="btn btn-sm btn-warning" title="Sửa thông tin"><i class="fa fa-edit"></i></a>
							                    <a href="#" class="delete_item btn btn-sm btn-danger" title="Xóa"><i class="fa fa-trash-o"></i></a>
						                    <?php endif;?>
					                    </td>
				                    </tr>
			                    <?php endforeach;?>
		                    <?php endif;?>
		                    </tbody>
	                    </table>
                    </div>
	                <div class="for_datatable_filter">
		                <ul>
			                <li>
				                <a href="<?=BASE_URL. $URIs['costs'] . '/loai/them'?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm</a>
			                </li>
		                </ul>
		                <input type="hidden" id="filterString" value="" />
	                </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div><!-- /#content-wrapper -->

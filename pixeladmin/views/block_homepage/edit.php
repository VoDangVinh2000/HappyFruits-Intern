<div id="content-wrapper">

  <div id="page-wrapper">
    <div class="row">
      <form id="frmBlockHomePage" role="form" method="post" action="<?= BASE_URL ?>xu-ly">

        <!-- remember comment create the form !-->
        <?php $itemBlock = $blockID[0][0]; ?>

        <div class="col-md-4">
          <div class="row">
            <div class="col-12">
              <h4 class="text-bold">Mẫu đang chỉnh sửa:</h4>
              <select class="form-control" name="type_block" id="chooseAvailableThemes">
                <option selected value="<?= $itemBlock['type_block'] ?>">Mẫu <?= $itemBlock['type_block'] ?></option>
              </select>
            </div>

            <div class="col-12">
              <h4 class="text-bold">Sản phẩm được chọn:</h4>
              <?php
              // $products = explode(',', str_replace(array('"', '[', ']'), '', $itemBlock['products_id']));
              $productsofblockshomepageendcode = json_encode($blockID[1]);
              echo "<script>localStorage.setItem('productsofblockshomepage',  JSON.stringify($productsofblockshomepageendcode));</script>";
              ?>
              <ol class="products-selected" data-count="<?= count($blockID[1]); ?>" style="display: flex; flex-direction: column;">
              </ol>
            </div>

            <div class="for_datatable_filter">
              <ul>
                <li>
                  <select name="category_id" class="form-control" id="filter_category">
                    <?php foreach ($menus['items'] as $itemMenus) {
                      if ($itemBlock['category_id'] == (int)$itemMenus['cat']) {
                    ?>
                        <option selected value="<?= $itemMenus['cat'] ?>"><?= $itemMenus['short_text'] ?></option>
                      <?php } else { ?>
                        <option value="<?= $itemMenus['cat'] ?>"><?= $itemMenus['short_text'] ?></option>
                    <?php }
                    } ?>
                  </select>

                </li>
              </ul>
              <div class="clear"></div>
              <input type="hidden" id="filterString" value="" />
            </div>

            <div style="margin: 10px 0">
              <input type="hidden" name="action" value="admin_save_blockhome" />
              <input type="submit" id="submit" value="Lưu" class="btn btn-submit btn-primary" style="width: 100%; font-weight: bold;">
            </div>
          </div>
        </div>


        <div class="col-md-8">
          <h4>Chọn sản phẩm hiển thị (tối đa 4 sản phẩm)</h4>
          <div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive" id="list_container">
                  <?php $controlerObj->load_view("block_homepage/tabledata_search/list_product"); ?>
                </div>
              </div>
            </div>
          </div>
          <!-- page-wrapper !-->
        </div>

        <!-- col-md-9 !-->
      </form>
    </div>
  </div>

  <form id="data-cate_pro" action="">
    <!-- categories tu database. chỉ hiện dữ liệu để lựa chọn khi, ta chọn mẫu phù hợp. -->
    <div id="categories"></div>
    <!-- products tu database. -->
    <div id="products"></div>
  </form>


  <div id="mau"></div>


</div>
<!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->
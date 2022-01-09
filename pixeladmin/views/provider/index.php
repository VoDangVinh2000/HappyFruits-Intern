    <div id="content-wrapper">
        <?php $controlerObj->load_view('elements/breadcrumb');?>
        <?php $controlerObj->load_view('elements/pageheader');?>
        <div id="page-wrapper">
            <div class="col-lg-12">
                <div class="table-responsive" id="list_container">
                    <?php $controlerObj->load_view("provider/list");?>
                </div>
                <div class="for_datatable_filter">
                    <input type="hidden" id="filterString" value="" />
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#content-wrapper -->

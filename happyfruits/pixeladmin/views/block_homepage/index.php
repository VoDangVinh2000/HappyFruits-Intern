<?php
echo json_encode($categories);
?>
<div id="content-wrapper">
    <div id="page-wrapper">

        <select>
            <option value="1">1</option>
            <option value="3">2</option>
        </select>

        <div id="mau"></div>

        <form id="data-cate_pro" action="">
            <!-- categories tu database. chỉ hiện dữ liệu để lựa chọn khi, ta chọn mẫu phù hợp. -->
            <div id="categories"></div>
            <!-- products tu database. -->
            <div id="products"></div>
        </form>

    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#content-wrapper -->
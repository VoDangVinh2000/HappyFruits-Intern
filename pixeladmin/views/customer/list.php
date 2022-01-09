                        <table class="table table-striped table-bordered table-hover dt-responsive hide-when-loading" id="dataTables-customerlist">
                            <thead>
                                <tr>
                                    <th class="abc" style="width: 160px;min-width: 160px;">Tên</th>
                                    <th style="max-width: 400px;">Địa chỉ</th>
                                    <th style="width: 60px;">Cách</th>
                                    <th style="width: 80px;">Điện thoại</th>
                                    <th class="not_filter" style="width: 30px;">Km</th>
                                    <th class="not_filter" style="width: 30px;">Order</th>
                                    <th class="not_filter" style="width: 60px;">Tổng mua</th>
                                    <th class="not_filter" style="width: 65px;">Free Ship</th>
                                    <th class="not_filter" style="width: <?=Users::is_member()?'80px':'90px'?>;"><span class="hidden-lg hidden-md">Thao tác</span></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
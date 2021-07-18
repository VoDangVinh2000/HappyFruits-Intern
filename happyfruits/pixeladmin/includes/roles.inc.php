<?php
    $request_uri = $_SERVER['REQUEST_URI'];
    $URIs = array(
        'users' => 'nguoi-dung',
        'customers' => 'khach-hang',
	    'customer_debts' => 'cong-no-khach-hang',
        'assessment' => 'danh-gia',
        'shipping_details' => 'giao-hang',
        'profile' => 'tai-khoan',
        'categories' => 'nhom-hang',
        'products' => 'hang-hoa',
        'prices' => 'quan-ly-gia',
        'orders' => 'don-hang',
        'statistics' => 'thong-ke',
        'inventory' => 'quan-ly-kho',
        'inventory_item' => 'quan-ly-kho/hang-hoa',
        'inventory_import' => 'quan-ly-kho/phieu-nhap',
        'inventory_export' => 'quan-ly-kho/phieu-xuat',
	    'inventory_check' => 'quan-ly-kho/phieu-kiem-ke',
        'vouchers' => 'phieu-thu-chi',
        'documents' => 'quan-ly-tai-lieu',
        'pages' => 'quan-ly-trang',
        'tags' => 'quan-ly-nhom',
        'announcements' => 'quan-ly-thong-bao',
        'gallery' => 'thu-vien-anh',
        'salary_advances' => 'tam-ung',
        'settings' => 'cau-hinh',
        'promotion_codes' => 'ma-khuyen-mai',
        'branches' => 'chi-nhanh',
	    'inventoryfruits' => 'quan-ly-trai-cay',
	    'inventory_item_fruits' => 'quan-ly-trai-cay/hang-hoa',
	    'inventory_import_fruits' => 'quan-ly-trai-cay/phieu-nhap',
	    'inventory_check_fruits' => 'quan-ly-trai-cay/phieu-kiem-ke',
	    'providers' => 'nha-cung-cap',
	    'costs' => 'chi-phi',
	    'debts' => 'cong-no',
        'menu' => 'menu'
    );
    
    $other_menu_items = array(
        'profile' => array(
            'label' => 'Thông tin tài khoản',
            'url' => BASE_URL. $URIs['profile'],
            'icon_class' => 'fa-fa-cog'
        ),
        'gallery'  => array(
            'label' => 'Thư viện ảnh',
            'url' => BASE_URL. $URIs['gallery'],
            'icon_class' => 'fa-desktop'
        )
    );
    
    $menu_items = array(
        'default' => array(
            'label' => 'Trang chủ',
            'url' => BASE_URL,
            'icon_class' => 'fa-dashboard',
            'menu_type' => 'general'
        ),
        'order' => array(
            'label' => 'Đơn hàng',
            'url' => BASE_URL. $URIs['orders'],
            'icon_class' => 'fa-shopping-cart',
            'menu_type' => 'general'
        ),
	    'product' => array(
		    'label' => 'Hàng hóa',
		    'url' => '#',
		    'icon_class' => 'fa-glass',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['products'],
				    'icon_class' => 'fa-list',
			    ),
                'manage' => array(
                    'label' => 'Bật tắt nhanh',
                    'url' => BASE_URL. $URIs['products'] . '/quan-ly-nhanh',
                    'icon_class' => 'fa-glass',
                ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['products'] . '/them',
				    'icon_class' => 'fa-plus',
			    )
		    ),
            'menu_type' => 'selling'
	    ),
	    'price' => array(
		    'label' => 'Quản lý giá',
		    'url' => BASE_URL. $URIs['prices'],
		    'icon_class' => 'fa-th',
            'menu_type' => 'selling'
	    ),
	    'promotioncode' => array(
		    'label' => 'Mã khuyến mãi',
		    'url' => '#',
		    'icon_class' => 'fa-qrcode',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['promotion_codes'],
				    'icon_class' => 'fa-list',
			    ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['promotion_codes'] . '/them',
				    'icon_class' => 'fa-plus',
			    )
		    ),
            'menu_type' => 'customer'
	    ),
	    'voucher' => array(
		    'label' => 'Quản lý thu chi',
		    'url' => '#',
		    'icon_class' => 'fa-exchange',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['vouchers'],
				    'icon_class' => 'fa-list',
			    ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['vouchers'] . '/them',
				    'icon_class' => 'fa-plus',
			    )
		    ),
            'menu_type' => 'selling'
	    ),
	    'provider' => array(
		    'label' => 'Quản lý nhà cung cấp',
		    'url' => '#',
		    'icon_class' => 'fa-truck',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['providers'],
				    'icon_class' => 'fa-list',
			    ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['providers'] . '/them',
				    'icon_class' => 'fa-plus',
			    )
		    ),
            'menu_type' => 'inventory'
	    ),
        'inventory' => array(
            'label' => 'Quản lý kho',
            'url' => '#',
            'icon_class' => 'fa-codepen',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Tồn kho',
                    'url' => BASE_URL. $URIs['inventory'],
                    'icon_class' => 'fa-list',
                ),
                'item_list' => array(
                    'label' => 'Hàng hóa kho',
                    'url' => BASE_URL. $URIs['inventory_item'],
                    'icon_class' => 'fa-barcode',
                ),
                'import_list' => array(
                    'label' => 'Nhập kho',
                    'url' => BASE_URL. $URIs['inventory_import'],
                    'icon_class' => 'fa-download',
                ),
                'export_list' => array(
                    'label' => 'Xuất kho',
                    'url' => BASE_URL. $URIs['inventory_export'],
                    'icon_class' => 'fa-upload',
                ),
	            'check_list' => array(
		            'label' => 'Kiểm kê hàng hóa',
		            'url' => BASE_URL. $URIs['inventory_check'],
		            'icon_class' => 'fa-upload',
	            )
            ),
            'menu_type' => 'inventory'
        ),
	    'inventoryfruits' => array(
		    'label' => 'Quản lý trái cây',
		    'url' => '#',
		    'icon_class' => 'fa-foursquare',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Tồn kho',
				    'url' => BASE_URL. $URIs['inventoryfruits'],
				    'icon_class' => 'fa-list',
			    ),
			    'item_list' => array(
				    'label' => 'Danh mục trái cây',
				    'url' => BASE_URL. $URIs['inventory_item_fruits'],
				    'icon_class' => 'fa-barcode',
			    ),
			    'import_list' => array(
				    'label' => 'Nhập trái cây',
				    'url' => BASE_URL. $URIs['inventory_import_fruits'],
				    'icon_class' => 'fa-download',
			    ),
			    'check_list' => array(
				    'label' => 'Kiểm kê trái cây',
				    'url' => BASE_URL. $URIs['inventory_check_fruits'],
				    'icon_class' => 'fa-upload',
			    )
		    ),
            'menu_type' => 'inventory'
	    ),
	    'cost' => array(
		    'label' => 'Quản lý chi phí',
		    'url' => '#',
		    'icon_class' => 'fa-exchange',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['costs'],
				    'icon_class' => 'fa-list',
			    ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['costs'] . '/them',
				    'icon_class' => 'fa-plus',
			    ),
			    'type' => array(
				    'label' => 'Loại',
				    'url' => BASE_URL. $URIs['costs'] . '/loai',
				    'icon_class' => 'fa-th-list',
			    ),
			    'view_report' => array(
				    'label' => 'Thống kê',
				    'url' => BASE_URL. $URIs['costs'] . '/thong-ke',
				    'icon_class' => 'fa-bar-chart',
			    ),
		    ),
            'menu_type' => 'selling'
	    ),
	    'debt' => array(
		    'label' => 'Quản lý công nợ',
		    'url' => '#',
		    'icon_class' => 'fa-exchange',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['debts'],
				    'icon_class' => 'fa-list',
			    ),
			    'done' => array(
				    'label' => 'Đã thanh toán',
				    'url' => BASE_URL. $URIs['debts']. '/da-thanh-toan',
				    'icon_class' => 'fa-list',
			    ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['debts'] . '/them',
				    'icon_class' => 'fa-plus',
			    ),
		    ),
            'menu_type' => 'selling'
	    ),
	    'statistics' => array(
		    'label' => 'Thống kê',
		    'url' => BASE_URL. $URIs['statistics'],
		    'icon_class' => 'fa-bar-chart',
            'menu_type' => 'general'
	    ),
        'salaryadvance' => array(
            'label' => 'Quản lý tạm ứng',
            'url' => '#',
            'icon_class' => 'fa-money',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['salary_advances'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['salary_advances'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'staff'
        ),
        'user' => array(
            'label' => 'Người dùng',
            'url' => '#',
            'icon_class' => 'fa-user',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['users'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['users'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'staff'

        ),
        'customer' => array(
            'label' => 'Khách hàng',
            'url' => '#',
            'icon_class' => 'fa-tasks',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['customers'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['customers'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'customer'
        ),
	    'customerdebt' => array(
		    'label' => 'Công nợ khách hàng',
		    'url' => '#',
		    'icon_class' => 'fa-exchange',
		    'sub_menu_items' => array(
			    'index' => array(
				    'label' => 'Danh sách',
				    'url' => BASE_URL. $URIs['customer_debts'],
				    'icon_class' => 'fa-list',
			    ),
			    'done' => array(
				    'label' => 'Đã thanh toán',
				    'url' => BASE_URL. $URIs['customer_debts']. '/da-thanh-toan',
				    'icon_class' => 'fa-list',
			    ),
			    'add' => array(
				    'label' => 'Thêm',
				    'url' => BASE_URL. $URIs['customer_debts'] . '/them',
				    'icon_class' => 'fa-plus',
			    ),
		    ),
            'menu_type' => 'customer'
	    ),
        'assessment' => array(
            'label' => 'Đánh giá',
            'url' => '#',
            'icon_class' => 'fa-line-chart',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['assessment'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['assessment'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'staff'
        ),
        'shipping' => array(
            'label' => 'Giao hàng',
            'url' => '#',
            'icon_class' => 'fa-bicycle',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['shipping_details'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['shipping_details'] . '/them',
                    'icon_class' => 'fa-plus',
                ),
                'fees' => array(
                    'label' => 'Phí giao hàng',
                    'url' => BASE_URL. $URIs['shipping_details']. '/phi',
                    'icon_class' => 'fa-th-list',
                ),
                'statistics' => array(
                    'label' => 'Thống kê giao hàng',
                    'url' => BASE_URL. $URIs['shipping_details']. '/thong-ke',
                    'icon_class' => 'fa fa-bar-chart',
                ),
            ),
            'menu_type' => 'staff'
        ),
        'category' => array(
            'label' => 'Nhóm hàng',
            'url' => '#',
            'icon_class' => 'fa-cubes',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['categories'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['categories'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'selling'
        ),
        'document' => array(
            'label' => 'Tài liệu',
            'url' => '#',
            'icon_class' => 'fa-file-text-o',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['documents'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['documents'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'general'
        ),
        'image' => array(
            'label' => 'Hình ảnh',
            'url' => BASE_URL. 'quan-ly-anh',
            'icon_class' => 'fa-image',
            'target' => '_blank',
            'menu_type' => 'general'
        ),
        'branch' => array(
            'label' => 'Chi nhánh',
            'url' => '#',
            'icon_class' => 'fa-home',
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['branches'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['branches'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'general'
        ),
        'setting' => array(
            'label' => 'Cấu hình',
            'url' => BASE_URL. $URIs['settings'],
            'icon_class' => 'fa-cogs',
            'menu_type' => 'general'
        ),
        'tag'  => array(
            'label' => 'Nhóm',
            'url' => BASE_URL. $URIs['tags'],
            'icon_class' => 'fa-tags',
            'frontend' => 1,
            'menu_type' => 'frontend'
        ),
        'menu'  => array(
            'label' => 'Menu',
            'url' => BASE_URL. $URIs['menu'],
            'icon_class' => 'fa-bars',
            'frontend' => 1,
            'menu_type' => 'frontend'
        ),
        'page' => array(
            'label' => 'Trang',
            'url' => '#',
            'icon_class' => 'fa-file-powerpoint-o',
            'frontend' => 1,
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['pages'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['pages'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'frontend'
        ),
        'announcement' => array(
            'label' => 'Thông báo',
            'url' => '#',
            'icon_class' => 'fa-bullhorn',
            'target' => '_blank',
            'frontend' => 1,
            'sub_menu_items' => array(
                'index' => array(
                    'label' => 'Danh sách',
                    'url' => BASE_URL. $URIs['announcements'],
                    'icon_class' => 'fa-list',
                ),
                'add' => array(
                    'label' => 'Thêm',
                    'url' => BASE_URL. $URIs['announcements'] . '/them',
                    'icon_class' => 'fa-plus',
                )
            ),
            'menu_type' => 'frontend'
        ),
        'gallery'  => array(
            'label' => 'Thư viện ảnh',
            'url' => BASE_URL. $URIs['gallery'],
            'icon_class' => 'fa-desktop',
            'frontend' => 1,
            'menu_type' => 'frontend'
        )
    );
    /*
    if (empty($not_destroy_session)){
        $uri = explode('/', $request_uri);
        if (sizeof($uri) < 3)
            die('Bạn không được phép truy cập trang này.');
        
        $view = $uri[2];
        if (!is_allowed_to_access($view))
            if(is_logged())
                redirect('trang-chu');
            else
                redirect('dang-nhap');
    }
    */
    
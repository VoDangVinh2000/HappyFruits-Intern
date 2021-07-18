    <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">Ẩn</span></button>
		
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">

				<!-- Logo -->
				<a href="<?=BASE_URL?>" class="navbar-brand">
					<div style="background: none;"><img alt="Admin" src="<?=get_admin_theme_assets_url()?>images/main-navbar-logo.png" height="40"/></div>
				</a>

				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
					<ul class="nav navbar-nav">
                        <?php if(Users::is_super_admin()):?>
                            <li><a href="<?=BASE_URL?>quan-ly/chung">Quản lý chung</a></li>
                            <li><a href="<?=BASE_URL?>quan-ly/hang-ban">Quản lý hàng bán</a></li>
                            <li><a href="<?=BASE_URL?>quan-ly/kho">Quản lý kho</a></li>
                            <li><a href="<?=BASE_URL?>quan-ly/khach-hang">Quản lý khách hàng</a></li>
                            <li><a href="<?=BASE_URL?>quan-ly/nhan-su">Quản lý nhân sự</a></li>
                            <li><a href="<?=BASE_URL?>quan-ly/giao-dien">Quản lý giao diện</a></li>
                    <?php else:
                            if (Users::can_access('frontend-mangement')):
                                $is_frontend = get_session_val('is_frontend');
                                if ($is_frontend):
                    ?>
						<li><a href="<?=BASE_URL?>quan-ly">Quản lý</a></li>
                        <li><a>Giao diện</a></li>
                            <?php else:?>
                        <li><a>Quản lý</a></li>
                        <li><a href="<?=BASE_URL?>giao-dien">Giao diện</a>
                            <?php
                                endif;
                            endif;
                        endif;
                    ?>
                    <?php if(Users::can('add_note', 'order')):?>
	                    <li><a target="_blank" href="<?=ROOT_URL?>quan-ly-don-hang">Đơn hàng đang xử lý</a>
					<?php endif; ?>
                        <?php /*
                            global $user;
		                    <?php if(empty($user) || $user->data['user_id'] == ANONYMOUS):?>
	                    <li><a target="_blank" href="<?=BASE_URL?>phpBB/dang-nhap">Đăng nhập Forum</a>
		                    <?php else:?>
	                    <li><a target="_blank" href="<?=ROOT_URL?>forum">Vào Forum</a>
		                    <?php endif;?>
                        */ ?>
                        <?php /*
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown</a>
							<ul class="dropdown-menu">
								<li><a href="#">First item</a></li>
								<li><a href="#">Second item</a></li>
								<li class="divider"></li>
								<li><a href="#">Third item</a></li>
							</ul>
						</li>
                        */ ?>
					</ul>
                    
					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">
                        <!-- $NAVBAR_ICON_BUTTONS =======================================================================

							Navbar Icon Buttons
							NOTE: .nav-icon-btn triggers a dropdown menu on desktop screens only. On small screens .nav-icon-btn acts like a hyperlink.
							Classes:
							* 'nav-icon-btn-info'
							* 'nav-icon-btn-success'
							* 'nav-icon-btn-warning'
							* 'nav-icon-btn-danger' 
                        -->
                            <?php /*
							<li class="nav-icon-btn nav-icon-btn-danger dropdown">
								<a href="#notifications" class="dropdown-toggle" data-toggle="dropdown">
									<span class="label">5</span>
									<i class="nav-icon fa fa-bullhorn"></i>
									<span class="small-screen-text">Notifications</span>
								</a>
								<!-- NOTIFICATIONS -->
								<div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
									<div class="notifications-list" id="main-navbar-notifications">

										<div class="notification">
											<div class="notification-title text-danger">SYSTEM</div>
											<div class="notification-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
											<div class="notification-ago">12h ago</div>
											<div class="notification-icon fa fa-hdd-o bg-danger"></div>
										</div> <!-- / .notification -->

										<div class="notification">
											<div class="notification-title text-info">STORE</div>
											<div class="notification-description">You have <strong>9</strong> new orders.</div>
											<div class="notification-ago">12h ago</div>
											<div class="notification-icon fa fa-truck bg-info"></div>
										</div> <!-- / .notification -->

										<div class="notification">
											<div class="notification-title text-default">CRON DAEMON</div>
											<div class="notification-description">Job <strong>"Clean DB"</strong> has been completed.</div>
											<div class="notification-ago">12h ago</div>
											<div class="notification-icon fa fa-clock-o bg-default"></div>
										</div> <!-- / .notification -->

										<div class="notification">
											<div class="notification-title text-success">SYSTEM</div>
											<div class="notification-description">Server <strong>up</strong>.</div>
											<div class="notification-ago">12h ago</div>
											<div class="notification-icon fa fa-hdd-o bg-success"></div>
										</div> <!-- / .notification -->

										<div class="notification">
											<div class="notification-title text-warning">SYSTEM</div>
											<div class="notification-description"><strong>Warning</strong>: Processor load <strong>92%</strong>.</div>
											<div class="notification-ago">12h ago</div>
											<div class="notification-icon fa fa-hdd-o bg-warning"></div>
										</div> <!-- / .notification -->

									</div> <!-- / .notifications-list -->
									<a href="#" class="notifications-link">MORE NOTIFICATIONS</a>
								</div> <!-- / .dropdown-menu -->
							</li>
							<li class="nav-icon-btn nav-icon-btn-success dropdown">
								<a href="#messages" class="dropdown-toggle" data-toggle="dropdown">
									<span class="label">10</span>
									<i class="nav-icon fa fa-envelope"></i>
									<span class="small-screen-text">Income messages</span>
								</a>
								<!-- MESSAGES -->
								<div class="dropdown-menu widget-messages-alt no-padding" style="width: 300px;">
									<div class="messages-list" id="main-navbar-messages">

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/2.jpg" alt="" class="message-avatar" />
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
											<div class="message-description">
												from <a href="#">Robert Jang</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/3.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
											<div class="message-description">
												from <a href="#">Michelle Bortz</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/4.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
											<div class="message-description">
												from <a href="#">Timothy Owens</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/5.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
											<div class="message-description">
												from <a href="#">Denise Steiner</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/2.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
											<div class="message-description">
												from <a href="#">Robert Jang</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/2.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
											<div class="message-description">
												from <a href="#">Robert Jang</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/3.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
											<div class="message-description">
												from <a href="#">Michelle Bortz</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/4.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
											<div class="message-description">
												from <a href="#">Timothy Owens</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/5.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
											<div class="message-description">
												from <a href="#">Denise Steiner</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

										<div class="message">
											<img src="<?=BASE_URL?>assets/demo/avatars/2.jpg" alt="" class="message-avatar">
											<a href="#" class="message-subject">Lorem ipsum dolor sit amet.</a>
											<div class="message-description">
												from <a href="#">Robert Jang</a>
												&nbsp;&nbsp;·&nbsp;&nbsp;
												2h ago
											</div>
										</div> <!-- / .message -->

									</div> <!-- / .messages-list -->
									<a href="#" class="messages-link">MORE MESSAGES</a>
								</div> <!-- / .dropdown-menu -->
							</li>
                            <!-- $END_NAVBAR_ICON_BUTTONS -->
                            */ ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
									<img src="<?=BASE_URL?>assets/images/profile.jpg" alt="" />
									<span><?=$logged_user['username']?></span>
								</a>
								<ul class="dropdown-menu">
                                    <?php if (Users::can_access('user', 'profile')):?>
									<li><a href="<?=BASE_URL. $URIs['profile']?>"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Tài khoản</a></li>
									<li class="divider"></li>
                                    <?php endif;?>
                                    <?php if (Users::can('add', 'IP')):?>
                                    <li><a href="<?=BASE_URL. 'them-ip'?>" target="_blank"><i class="dropdown-icon fa fa-plus"></i>&nbsp;&nbsp;Thêm IP</a></li>
									<li class="divider"></li>
            						<?php endif;?>
									<li><a href="<?=BASE_URL?>dang-xuat"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Đăng xuất</a></li>
								</ul>
							</li>
						</ul> <!-- / .navbar-nav -->
					</div> <!-- / .right -->
				</div>
			</div> <!-- / #main-navbar-collapse -->
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
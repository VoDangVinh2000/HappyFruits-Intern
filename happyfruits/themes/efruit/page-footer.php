<?php
$settings = get_setting_options();
$start_year = env('START_YEAR', 2013);
$current_year = date('Y');
$copy_right_year = $start_year != $current_year ? $start_year . '-' . $current_year : $start_year;
?>

<!-- FOOTER -->
<footer class="footer">
	<div class="container">
		<div class="footer--wrapper">
			<a href="/vi" class="footer-img--link">
				<img src="http://www.localhost/themes/efruit/child/happy/assets/img/main_logo.png" alt="" class="footer-img">
			</a>
		</div>
		<div class="footer--group-icon">
			<div class="footer--group-icon__wrapper">
				<a href="https://www.facebook.com/happyfruitsvietnam/" target="_blank"> <i class="fab fa-facebook-f"></i><span class="icon-name">facebook</span></a>
				<a href="https://twitter.com/?lang=vi" target="_blank"><i class="fab fa-twitter"></i><span class="icon-name">twitter</span></a>
				<a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i><span class="icon-name">instagram</span></a>
				<a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i><span class="icon-name">youtube</span></a>
			</div>
		</div>
		<div class="footer--info">
			<ul class="footer--info-list">
				<li class="footer--info-item">
					<a href="#" bind-translate="Về chúng tôi" class="footer--info-title">Về chúng tôi</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/gioi-thieu" target="_blank" class="footer--info-link" bind-translate="Giới thiệu">Giới thiệu</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/thu-vien-hinh-anh" target="_blank" class="footer--info-link" bind-translate="Thư viện hình ảnh">Thư viện hình ảnh</a>
				</li>
				<li class="footer--info-item">
					<a href="/tuyen-dung" target="_blank" class="footer--info-link" target="_blank" bind-translate="Tuyển dụng">Tuyển dụng</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/chinh-sach-quy-dinh-chung" target="_blank" class="footer--info-link" bind-translate="Chính sách, quy định chung">Chính sách, quy định chung</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/chinh-sach-doi-tra" target="_blank" class="footer--info-link" bind-translate="Chính sách đổi trả">Chính sách đổi trả</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/chinh-sach-bao-mat-thong-tin" target="_blank" class="footer--info-link" bind-translate="Chính sách bảo mật thông tin">Chính sách bảo mật thông tin</a>
				</li>
			</ul>
			<!-- Col 2 -->
			<ul class="footer--info-list">
				<li class="footer--info-item">
					<a href="#" bind-translate="Có thể bạn thắc mắc" class="footer--info-title">Có thể bạn thắc mắc</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/san-pham" target="_blank" class="footer--info-link" bind-translate="Sản phẩm">Sản phẩm</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/giao-hang" target="_blank" class="footer--info-link" bind-translate="Phương thức giao hàng">Phương thức giao hàng</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/dat-hang" target="_blank" class="footer--info-link" bind-translate="Phương thức đặt hàng">Phương thức đặt hàng</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/cam-ket-san-pham" target="_blank" class="footer--info-link" bind-translate="Cam kết sản phẩm">Cam kết sản phẩm</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/uu-dai-thanh-vien" target="_blank" class="footer--info-link" bind-translate="Ưu đãi thành viên">Ưu đãi thành viên</a>
				</li>
				<li class="footer--info-item">
					<a href="/vi/cau-hoi-khac" target="_blank" class="footer--info-link" bind-translate="Câu hỏi khác">Câu hỏi khác</a>
				</li>
			</ul>
			<!-- Col 3 -->
			<ul class="footer--info-list">
				<li class="footer--info-item">
					<a href="#" bind-translate="Liên hệ" class="footer--info-title">Liên hệ</a>
				</li>
				<li class="footer--info-item">
					<div class="footer--info-link">
						<div class="footer--info-address">
							<i class="fa fa-home"></i>
							<span bind-translate="Cửa hàng">Cửa hàng</span>: <span class="efruit-vi footer--info-address footer--info-address__title">
								<?= getvalue($main_branch, 'short_address') ?>
							</span><span class="efruit-en efruitjs"><?= getvalue($main_branch, 'en_address')
																	?></span>
						</div>
					</div>
				</li>
				<li class="footer--info-item">
					<div class="footer--info-link">
						<div class="footer--info-address">

							<?php if (!empty($settings['company_address'])) : ?>
								<dd><i class="fa fa-home"></i><span bind-translate="Công ty">Công ty</span>: <span class="footer--info-address footer--info-address__des">
										<?= $settings['company_address']
										?></span></dd>
							<?php endif; ?>
						</div>
					</div>
				</li>
				<li class="footer--info-item">
					<a href="/vi/lien-he/" target="_blank" class="footer--info-link">
						<div class="footer--info-address footer--info-address-envolope">
							<i class="fa fa-phone"></i>
							<span class="footer--info-address footer--info-address__des">
								<?= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15')
								?>
							</span>
						</div>
					</a>
				</li>
				<li class="footer--info-item">
					<div href="#" class="footer--info-link">
						<div class="footer--info-address footer--info-address-envolope">
							<i class="fas fa-envelope"></i>
							<a id="info-email">Info email</a>&nbsp;&nbsp;<i class="fa fa-envelope-o"></i> <a id="cskh-email">CSKH</a>
							<!-- <a href="#" class="contact--link">info@localhost</a> -->
							<i class="far fa-envelope"></i>
							<a href="#" class="contact--link">cskh@localhost</a>
						</div>
					</div>
				</li>
				<li class="footer--info-item">
					<a href="https://www.facebook.com/happyfruitsvietnam/" target="_blank" class="footer--info-link">
						<div class="footer--info-address footer--info-address-envolope">
							<i class="fab fa-facebook-f"></i>
							<span class="footer--info-address footer--info-address__des">
								https://www.facebook.com/happyfruitsvietnam/
							</span>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<div class="footer--company-info">
			<p> <?= $settings['company_name'] . ". ĐC: " . $settings['company_address']  ?> </p>
			<p><?= $settings['company_info']  ?></p>
			<p><?= $settings['company_extra_1']  ?></p>
			<p><?= $settings['company_extra_2']  ?></p>
		</div>
	</div>
</footer>
<!-- END FOOTER -->
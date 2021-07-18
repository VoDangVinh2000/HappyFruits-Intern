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
			<a href="" class="footer-img--link">
				<img src="http://www.localhost/themes/efruit/child/happy/assets/img/main_logo.png" alt="" class="footer-img">
			</a>
		</div>
		<div class="footer--info">
			<ul class="footer--info-list">
				<li class="footer--info-item">
					<a href="#" class="footer--info-title">About us</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Introduction</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Image gallery</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Jobs</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Terms and Conditions</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Returns and Exchanges</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Privacy Policy</a>
				</li>
			</ul>
			<!-- Col 2 -->
			<ul class="footer--info-list">
				<li class="footer--info-item">
					<a href="#" class="footer--info-title">You may want to know</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Products</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Shipping</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Place Order</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Guarantee</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Promotion</a>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">Other questions</a>
				</li>
			</ul>
			<!-- Col 3 -->
			<ul class="footer--info-list">
				<li class="footer--info-item">
					<a href="#" class="footer--info-title">Contact</a>
				</li>
				<li class="footer--info-item">
					<div class="footer--info-link">
						<div class="footer--info-address">
							<!-- <i class="fa fa-home"></i> -->
							<span bind-translate="Cửa hàng">Cửa hàng</span>: <span class="efruit-vi">
								<?= getvalue($main_branch, 'short_address') ?>
							</span><span class="efruit-en efruitjs"><?= getvalue($main_branch, 'en_address')
																	?></span>
						</div>
					</div>
				</li>
				<li class="footer--info-item">
					<div class="footer--info-link">
						<div class="footer--info-address">
							<!-- <i class="fa fa-home"></i> -->
							<?php if (!empty($settings['company_address'])) : ?>
								<dd></i> <span bind-translate="Công ty">Công ty</span>: <span><?= $settings['company_address']
																													?></span></dd>
							<?php endif; ?>
							<!-- <span class="footer--info-address footer--info-address__title">
								Company:
							</span>
							<span class="footer--info-address footer--info-address__des">
								388 Huynh Van Banh, Ward 14, Phu Nhuan District, HCM city
							</span> -->
						</div>
					</div>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">
						<div class="footer--info-address footer--info-address-envolope">
							<i class="fa fa-phone"></i>
							<span class="footer--info-address footer--info-address__des">
								0938.70.70.15
							</span>
						</div>
					</a>
				</li>
				<li class="footer--info-item">
					<div href="#" class="footer--info-link">
						<div class="footer--info-address footer--info-address-envolope">
							<i class="fas fa-envelope"></i>
							<a href="#" class="contact--link">info@localhost</a>
							<i class="far fa-envelope"></i>
							<a href="#" class="contact--link">cskh@localhost</a>
						</div>
					</div>
				</li>
				<li class="footer--info-item">
					<a href="#" class="footer--info-link">
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
		<div class="footer--form-submit">
			<div class="footer--form-submit footer--form-submit-wrapper">
				<input class="input--form" type="email" name="" value="" placeholder="Your email address." aria-label="email@example.com">
				<button class="btn-submit" type="submit" name="">SUBSCRIBE</button>
			</div>
		</div>

		<div class="footer--group-icon">
			<div class="footer--group-icon__wrapper">
				<a href=""> <i class="fab fa-facebook-f"></i>
					<span class="icon-name">facebook</span>
				</a>
				<a href=""><i class="fab fa-twitter"></i>
					<span class="icon-name">twitter</span></a>
				<a href=""><i class="fab fa-instagram"></i>
					<span class="icon-name">instagram</span></a>
				<a href=""><i class="fab fa-youtube"></i>
					<span class="icon-name">youtube</span></a>
			</div>
		</div>

		<div class="footer--company-info">
			<span>Công Ty TNHH Thương Mại Dịch Vụ MID. ĐC: 388 Huỳnh Văn Bánh, Phường 14, Quận Phú Nhuận, TP
				HCM</span>
			<span>Số giấy phép ĐKKD: 0312974791 do sở Kế hoạch và Đầu Tư TPHCM cấp</span>
			<span>Giấy chứng nhận cơ sở đủ điều kiện an toàn thực phẩm số 1384/2016/ATTP-CNĐK</span>
		</div>
	</div>
</footer>
<!-- END FOOTER -->



<!-- <div class="y-foot">
	<div class="wrapper">
		<div class="identity">
			<span class="site-name <? //= strlen($settings['short_site_name']) > 12 ? 'small' : (strlen($settings['short_site_name']) > 8 ? 'medium' : '') 
									?>"><? //= get_setting('short_site_name') 
										?></span>
			<span class="copyright">&copy; <span class="number"><? //= $copy_right_year 
																?></span> <? //= get_setting('short_site_name') 
																			?></span><br />
			<a class="share-btn" target="_blank" href="javascript:window.location=%22http://www.facebook.com/sharer.php?u=%22+encodeURIComponent(document.location)+%22&#38;t=%22+encodeURIComponent(document.title)"><i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp;<span bind-translate="Chia sẻ">Chia sẻ</span></a><br /><br />
			<?php //if (env('GOV_LINK')) : 
			?>
				<a target="_blank" href="<? //= env('GOV_LINK') 
											?>"><img loading="lazy" src="<? //= get_theme_assets_url() 
																			?>img/dathongbao.png" style="width: 130px;height: auto;" /></a>
			<?php //endif; 
			?>
		</div>
		<div class="column">
			<div class="group-1">
				<dl>
					<dt bind-translate="Về chúng tôi">Về chúng tôi</dt>
					<dd><a href="/vi/gioi-thieu" bind-translate="Giới thiệu">Giới thiệu</a></dd>
					<dd><a href="/vi/thu-vien-hinh-anh" bind-translate="Thư viện hình ảnh">Thư viện hình ảnh</a></dd>
					<dd><a href="/tuyen-dung" target="_blank" bind-translate="Tuyển dụng">Tuyển dụng</a></dd>
					<dd><a href="/vi/chinh-sach-quy-dinh-chung" bind-translate="Chính sách, quy định chung">Chính sách, quy định chung</a></dd>
					<dd><a href="/vi/chinh-sach-doi-tra" bind-translate="Chính sách đổi trả">Chính sách đổi trả</a></dd>
					<dd><a href="/vi/chinh-sach-bao-mat-thong-tin" bind-translate="Chính sách bảo mật thông tin">Chính sách bảo mật thông tin</a></dd>
				</dl>
			</div>
		</div>
		<div class="column questions">
			<div class="group-2">
				<dl>
					<dt bind-translate="Có thể bạn thắc mắc">Có thể bạn thắc mắc</dt>
					<dd><a href="/vi/san-pham" bind-translate="Sản phẩm">Sản phẩm</a></dd>
					<dd><a href="/vi/giao-hang" bind-translate="Phương thức giao hàng">Phương thức giao hàng</a></dd>
					<dd><a href="/vi/dat-hang" bind-translate="Phương thức đặt hàng">Phương thức đặt hàng</a></dd>
					<dd><a href="/vi/cam-ket-san-pham" bind-translate="Cam kết sản phẩm">Cam kết sản phẩm</a></dd>
					<dd><a href="/vi/uu-dai-thanh-vien" bind-translate="Ưu đãi thành viên">Ưu đãi thành viên</a></dd>
					<dd><a href="/vi/cau-hoi-khac" bind-translate="Câu hỏi khác">Câu hỏi khác</a></dd>
				</dl>
			</div>
		</div>
		<div class="column contact">
			<div class="group-3">
				<dl>
					<dt bind-translate="Liên hệ">Liên hệ</dt>
					<dd><i class="fa fa-home"></i> <span bind-translate="Cửa hàng">Cửa hàng</span>: <span class="efruit-vi"><?= getvalue($main_branch, 'short_address') ?></span><span class="efruit-en efruitjs"><? //= getvalue($main_branch, 'en_address') 
																																																					?></span></dd>
					<? //php// if (!empty($settings['company_address'])) : 
					?>
						<dd><i class="fa fa-home"></i> <span bind-translate="Công ty">Công ty</span>: <span><? //= $settings['company_address'] 
																											?></span></dd>
					<?php //endif; 
					?>
					<dd><i class="fa fa-phone"></i> <span><? //= getvalue($main_branch, 'phone_number', '0938.70.70.15 - 0906.70.70.15') 
															?></span></dd>
					<dd><i class="fa fa-envelope"></i> <a id="info-email">Info email</a>&nbsp;&nbsp;<i class="fa fa-envelope-o"></i> <a id="cskh-email">CSKH</a></dd>
					<? //php// if (!empty($settings['facebook_link'])) : 
					?>
						<dd><i class="fa fa-facebook"></i>&nbsp;&nbsp;<a href="<? //= $settings['facebook_link'] 
																				?>" target="_blank"><? //= $settings['facebook_link'] 
																									?></a></dd>
					<? //php endif; 
					?>
				</dl>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php //if (!empty($settings['company_name']) && !empty($settings['company_address'])) : 
?>
	<div class="footer-company-info">
		<span style="color: #999; clear: both; display: block;"><? //= $settings['company_name'] 
																?>. ĐC: <? //= $settings['company_address'] 
																		?></span>
		<?php //if (!empty($settings['company_info'])) : 
		?>
			<span style="color: #999; clear: both; display: block;"><? //= $settings['company_info'] 
																	?></span>
		<? //php endif; 
		?>
		<? //php// if (!empty($settings['company_extra_1'])) : 
		?>
			<span style="color: #999; clear: both; display: block;"><? //= $settings['company_extra_1'] 
																	?></span>
		<? //php endif; 
		?>
		<? //php if (!empty($settings['company_extra_2'])) : 
		?>
			<span style="color: #999; clear: both; display: block;"><? //= $settings['company_extra_2'] 
																	?></span>
		<? //php endif; 
		?>
	</div>
<? //php endif; 
?> -->
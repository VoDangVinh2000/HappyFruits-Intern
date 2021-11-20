# thuc tap - leanhvu

## Hướng dẫn setup lại source code.

- Bước 1: Tạo một Virtual Host.
- Bước 2: file "host" trong "C:\Windows\System32\drivers\etc" thêm www.tên virtual host đã đặt.
- Bước 3: file httpd-vhosts.conf thêm ServerName www.tên virtual host đã đặt.
- Lưu ý: file javascript nên được viết bên file footer.php (đặt *.js ở dưới cùng)
<!-- using vim -->


## chức năng cần xử lý:
- [x] 1: Xác nhận đơn hàng: table xác nhận đơn hàng không đồng nhất.
- [x] 2: Bước 2 xác nhận đơn hàng
  - Cần highlight các trường bắt buộc trên form đặt hàng
  - Cần điền trước Họ tên, SĐT, email (nếu có) khi khách hàng đã đăng nhập.
  - Lỗi hiển thị khi nhấn vào hình ảnh của phương thức thanh toán

- [x] 3: Top menu: ẩn menu phụ khi trống
- [x] 6: Cần hiệu ứng khi thêm sản phẩm vào giỏ hàng (xem trang cũ)
- [x] 8: Footer:
  - Bỏ icon facebook
  - Giảm độ lớn font chữ cho các dòng ở cuối trang

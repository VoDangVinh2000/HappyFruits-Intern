<?php
require_once(__DIR__.'/env.inc.php');
session_start();

function redirect($url){
    header("Location: $url");
    die();
}
function error($msg){
    $_SESSION['error'] = $msg;
    $_SESSION['form_data'] = $_POST;
    redirect('/tuyen-dung');
}
/*
$valid_captcha = 0;
if (!empty($_POST['g-recaptcha-response'])) {
    $captcha = $post['g-recaptcha-response'];
    $secretKey = '6LdWiXkUAAAAACYO_zT_c-1uHfuuWNWlDsCEXqdQ';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha);
    $responseKeys = json_decode($response, true);
    if (intval($responseKeys["success"]) !== 1) {
        $valid_captcha = 0;
    } else {
        $valid_captcha = 1;
    }
}
else {
    $valid_captcha = 0;
}

if (!$valid_captcha)
    error('Vui lòng nhập đúng captcha');
*/

$servername = "localhost";
$database = "efruit_candidates";
$username = "efruit_can";
$password = "MMeXWmTC52Mh";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_query($conn,'SET NAMES UTF8');
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$diachiemail="";
$dienthoaididong="";
$form_data="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isset($_POST["diachiemail"])) {
		$email = $_POST['diachiemail'];
	} else{
		error('Vui lòng nhập email');
	}
	if(isset($_POST['dienthoaididong'])){
		$dienthoaididong = $_POST['dienthoaididong'];
        $dienthoaididong = str_replace('+', '', $dienthoaididong);
        if (strpos($dienthoaididong, '84') === 0)
            $dienthoaididong = substr($dienthoaididong, 2);
        if (strpos($dienthoaididong,'0') !== 0)
            $dienthoaididong = '0'. $dienthoaididong;
	}else{
		error('Vui lòng nhập số điện thoại');
	}
	unset($_POST['g-recaptcha-response']);
	$form_data = json_encode($_POST, JSON_UNESCAPED_UNICODE);
	$sql="INSERT INTO thongtinungvien(email,mobile,other) VALUES('$email','$dienthoaididong','$form_data')";
	if (!$conn->query($sql)){
		error("Error: " . $sql . "<br>" . $conn->error);
	}
}else{
	redirect('/tuyen-dung');
}

?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Nhúng thư viện phpmailer
require_once(__DIR__.'/PHPmailer/class.phpmailer.php');

//Khởi tạo đối tượng
$mail = new PHPMailer();

/*=====================================
 * THIET LAP THONG TIN GUI MAIL
 *=====================================*/

$mail->isMail();
/*
$mail->IsSMTP();
$mail->SMTPAuth   = true;                 // Sử dụng đăng nhập vào account
$mail->SMTPSecure = "ssl";
$mail->Host       = "mail.efruit.vn";     // Thiết lập thông tin của SMPT
$mail->Port       = 465;                  // Thiết lập cổng gửi email của máy
$mail->Username   = "sender@efruit.vn";  // SMTP account username
$mail->Password   = "mikjuji9k";         // SMTP account password
*/

//Thiet lap thong tin nguoi gui va email nguoi gui
$mail->SetFrom(env('EMAIL_SENDER', 'sender@efruit.vn'), env('SITE_NAME', 'eFruit').' - Sender');

//Thiết lập thông tin người nhận
$mail->AddAddress('hieu.ps.nguyen@gmail.com');
$mail->AddAddress('mik.hien.do@gmail.com');
$mail->AddAddress(env('EMAIL_HR', 'hr@efruit.vn'));

//Thiết lập email nhận email hồi đáp
//nếu người nhận nhấn nút Reply
$mail->AddReplyTo($email);

/*=====================================
 * THIET LAP NOI DUNG EMAIL
 *=====================================*/

//Thiết lập tiêu đề
$mail->Subject    = env('SITE_NAME', 'eFruit')." - THÔNG TIN ỨNG VIÊN";

//Thiết lập định dạng font chữ
$mail->CharSet = "utf-8";

ob_start();
?>
<b>I/ THÔNG TIN CÁ NHÂN</b> <br>
<table style="width: 100%; border-collapse: collapse; ">
	<tr>
		<td style="border: 1px solid black"> Họ và tên: <?php echo $_POST['hovaten'] ?></td>
		<td style="border: 1px solid black"> Số điện thoại di động: <?php echo $_POST['dienthoaididong'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Ngày sinh: <?php echo date('d/m/Y', strtotime($_POST['born'])) ?><br/>Nơi sinh: <?php echo $_POST['where'] ?></td>
		<td style="border: 1px solid black">Địa chỉ email: <?php echo $_POST['diachiemail'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Giói tính: <?php echo $_POST['gender'] ?></td>
		<td style="border: 1px solid black">Tình trạng hôn nhân: <?php echo $_POST['tinhtranghonnhan'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black" >Dân tộc:&nbsp;<?php echo $_POST['dantoc'] ?></td>
		<td style="border: 1px solid black" >Tình trạng sức khỏe:&nbsp;<?php echo $_POST['tinhtrangsuckhoe'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Tôn giáo:&nbsp;<?php echo $_POST['tongiao'] ?></td>
		<td style="border: 1px solid black">Chiều cao: <?php echo $_POST['chieucao'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Quốc tịch: <?php echo $_POST['quoctich'] ?></td>
		<td style="border: 1px solid black">Cân nặng: <?php echo $_POST['cannang'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Số CMND: <?php echo $_POST['socmnd'] ?></td>
		<td style="border: 1px solid black"></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Ngày cấp: <?php echo date('d/m/Y', strtotime($_POST['ngaycap'])) ?></td>
		<td style="border: 1px solid black"></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Nơi cấp: <?php echo $_POST['noicap'] ?></td>
		<td style="border: 1px solid black"></td>
	</tr>
	<tr>
		<td style="border: 1px solid black" colspan ="2">Hộ khẩu thường trú: <?php echo $_POST['hokhauthuongtru'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black" colspan ="2">Nơi ở hiện tại: <?php echo $_POST['noiohiennay'] ?></td>
	</tr>
</table><br>
<b>II/ THÔNG TIN ỨNG TUYỂN</b>
<table style="width: 100%;  border-collapse: collapse;" >
    <tr>
        <td style="border: 1px solid black">
            Thời gian ứng tuyển <?php echo $_POST['hinhthuc'] ?>:
            <?php echo !empty($_POST['chonca'])?implode(', ', $_POST['chonca']):'' ?>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black">Vị trí ứng tuyển: <?php echo !empty($_POST['vitri'])?implode(', ', $_POST['vitri']):'' ?></td>
    </tr>
    <tr>
        <td style="border: 1px solid black">
            Mức lương mong muốn </br>
            1. Khi thử việc: <?php echo is_numeric($_POST['thuviec'])?number_format($_POST['thuviec']):$_POST['thuviec'] ?> </br>
            2. Sau thử việc: <?php echo is_numeric($_POST['sauthuviec'])?number_format($_POST['sauthuviec']):$_POST['sauthuviec'] ?>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black">Ngày có thể nhận việc <?php echo date('d/m/Y', strtotime($_POST['ngaycothe'])) ?></td>
    </tr>
</table><br>
<b>III/ TRÌNH ĐỘ HỌC VẤN</b><br>
<table style="width: 100%; border-collapse: collapse; " >
    <tr>
        <td style="border: 1px solid black" colspan ="2">
            Các văn bằng đạt được: <?php echo !empty($_POST['vanbang'])?implode(', ', $_POST['vanbang']):'' ?>
        </td>
    </tr>
	<tr>
		<td style="border: 1px solid black">Trường: <?php echo $_POST['truong'] ?></td>
		<td style="border: 1px solid black">Tin học: <?php echo $_POST['tinhoc'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">Ngành: <?php echo $_POST['nganh'] ?></td>
		<td style="border: 1px solid black">Ngoại ngữ: <?php echo $_POST['ngoaingu'] ?></td>
	</tr>
</table><br>
<table style="width: 100%;  border-collapse: collapse;" >
	<tr>
		<th style="border: 1px solid black" align="center">Lịch học</th>
		<th style="border: 1px solid black" align="center">T2</th>
		<th style="border: 1px solid black" align="center">T3</th>
		<th style="border: 1px solid black" align="center">T4</th>
		<th style="border: 1px solid black" align="center">T5</th>
		<th style="border: 1px solid black" align="center">T6</th>
		<th style="border: 1px solid black" align="center">T7</th>
		<th style="border: 1px solid black" align="center">CN</th>
	</tr>
	<tr>
		<th style="border: 1px solid black" align="center">Sáng</th>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangt2'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangt3'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangt4'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangt5'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangt6'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangt7'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['sangcn'] ?></td>
	</tr>
	<tr>
		<th style="border: 1px solid black" align="center">Chiều</th>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['chieut2'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['chieut3'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['chieut4'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['chieut5'] ?></td>
		<td align="center"><?php echo $_POST['chieut6'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['chieut7'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['chieucn'] ?></td>
	</tr>
	<tr>
		<th	style="border: 1px solid black" align="center"> Tối</th>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toit2'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toit3'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toit4'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toit5'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toit6'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toit7'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['toicn'] ?></td>
	</tr>
</table><br>

<b>IV/ THÔNG TIN KHÁC</b><br>
<table style="width: 100%;  border-collapse: collapse;">
	<tr>
		<td style="border: 1px solid black">1. Bạn có thể làm việc trong những ngày lễ, Tết(cổ truyền)?</td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['YN1'] ?></td>
	</tr>
	<tr>
		<td style="border: 1px solid black">2. Bạn có thể làm tới 22h30 không?</td>
		<td style="border: 1px solid black" align="center"> <?php echo $_POST['YN2'] ?> </td>
	</tr>
	<tr>
		<td style="border: 1px solid black">3. Bạn có thể làm xoay ca được không?(có khi ca sáng, có khi ca tối, hay ca gãy)?</td>
		<td style="border: 1px solid black" align="center">  <?php echo $_POST['YN3'] ?> </td>
	</tr>
	<tr>
		<td style="border: 1px solid black">4. Bạn mong muốn làm việc với <?=env('SITE_NAME', 'eFruit')?> trong bao lâu?</td>
		<td style="border: 1px solid black" align="center"> <?php echo $_POST['YN4'] ?> </td>
	</tr>
	<tr>
		<td style="border: 1px solid black"><?=env('YN5', '5. Trước đây bạn đã từng làm ở cửa hàng cà phê, thức uống hay ngành hàng về F&B nào tương tự eFruit chưa?')?></td>
		<td style="border: 1px solid black" align="center">
			<?php
            if(!empty($_POST['YN5']) && $_POST['YN5']=='rồi')
				echo 'Rồi'. (!empty($_POST['cuahang'])?': '.$_POST['cuahang']:'');
			else
			    echo 'Chưa';
			?> </td>

	</tr>
	<tr>
		<td style="border: 1px solid black">6. Phương tiện di chuyển</td>
		<td style="border: 1px solid black" align="center"> <?php echo !empty($_POST['phuongtien'])?implode(', ', $_POST['phuongtien']):'' ?> </td>
	</tr>
</table><br>
<b>V/ ƯU ĐIỂM BẢN THÂN</b>
<table style="width: 100%;  border-collapse: collapse;" >
	<tr>
		<td style="border: 1px solid black">Ưu điểm</td>
        <td style="border: 1px solid black" align="center"> <?php echo $_POST['uudiem'] ?> </td>
	</tr>	
		<tr>
		<td style="border: 1px solid black">Năng khiếu, tài lẻ</td>
		<td style="border: 1px solid black" align="center"> <?php echo !empty($_POST['YN9'])?implode(', ', $_POST['YN9']):'' ?></td>
	</tr>
</table><br>
<b>VI/ THÔNG TIN GIA ĐÌNH  </b><i>(ghi tên bố/mẹ và một người lớn có sử dụng điện thoại để tham chiếu)</i>
<table style="width: 100%;  border-collapse: collapse;" >
	<tr>
		<th style="border: 1px solid black" align="center">Họ và tên</th>
		<th style="border: 1px solid black" align="center">Năm sinh</th>
		<th style="border: 1px solid black" align="center">Quan hệ</th>
		<th style="border: 1px solid black" align="center">Nghề nghiệp</th>
		<th style="border: 1px solid black" align="center">Số điện thoại</th>
		<th style="border: 1px solid black" align="center">Nơi ở hiện nay</th>
	</tr>
	<tr>
		<?php if ( !empty($_POST['ttgd1']) || !empty($_POST['ttgd2']) || !empty($_POST['ttgd3']) || !empty($_POST['ttgd4']) || !empty($_POST['ttgd5']) || !empty($_POST['ttgd6'])):?>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd1'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd2'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd3'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd4'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd5'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd6'] ?></td>
		<?php endif; ?>
	</tr>
	<tr>
		<?php if ( !empty($_POST['ttgd8']) || !empty($_POST['ttgd9']) || !empty($_POST['ttgd10']) || !empty($_POST['ttgd11']) || !empty($_POST['ttgd12']) || !empty($_POST['ttgd13'])):?>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd8'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd9'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd10'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd11'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd12'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd13'] ?></td>
		<?php endif; ?>
	</tr>
	<tr>
		<?php if ( !empty($_POST['ttgd14']) || !empty($_POST['ttgd15']) || !empty($_POST['ttgd16']) || !empty($_POST['ttgd17']) || !empty($_POST['ttgd18']) || !empty($_POST['ttgd19'])):?>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd14'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd15'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd16'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd17'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd18'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd19'] ?></td>
		<?php endif; ?>
	</tr>
	<tr>
		<?php if ( !empty($_POST['ttgd20']) || !empty($_POST['ttgd21']) || !empty($_POST['ttgd22']) || !empty($_POST['ttgd23']) || !empty($_POST['ttgd24']) || !empty($_POST['ttgd25'])):?>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd20'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd21'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd22'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd23'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd24'] ?></td>
			<td style="border: 1px solid black" align="center"><?php echo $_POST['ttgd25'] ?></td>
		<?php endif; ?>
	</tr>
</table><br>
<b>VI/ KINH NGHIỆM LÀM VIỆC <br></b>
<table style="width: 100%;  border-collapse: collapse;" >
	<tr>
		<th style="border: 1px solid black" align="center">Công ty</th>
		<th style="border: 1px solid black" align="center">Chức vụ</th>
		<th style="border: 1px solid black" align="center">Lương</th>
		<th style="border: 1px solid black" align="center">Thời gian</th>
		<th style="border: 1px solid black" align="center">Lý do nghỉ việc</th>
		<th style="border: 1px solid black" align="center">Người tham chiếu</th>
		<th style="border: 1px solid black" align="center">Số ĐT liên hệ</th>
	</tr>
	<?php if ( !empty($_POST['knlv1']) || !empty($_POST['knlv2']) || !empty($_POST['knlv3']) || !empty($_POST['knlv4']) || !empty($_POST['knlv5']) || !empty($_POST['knlv6']) || !empty($_POST['knlv7'])):?>
    <tr>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv1'] ?></td>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv2'] ?></td>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv3'] ?></td>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv4'] ?></td>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv5'] ?></td>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv6'] ?></td>
        <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv7'] ?></td>
    </tr>
	<?php endif; ?>
    <?php if ( !empty($_POST['knlv8']) || !empty($_POST['knlv9']) || !empty($_POST['knlv10']) || !empty($_POST['knlv11']) || !empty($_POST['knlv12']) || !empty($_POST['knlv13']) || !empty($_POST['knlv14'])):?>
	<tr>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv8'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv9'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv10'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv11'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv12'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv13'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv14'] ?></td>
	</tr>
    <?php endif; ?>
    <?php if ( !empty($_POST['knlv15']) || !empty($_POST['knlv16']) || !empty($_POST['knlv17']) || !empty($_POST['knlv18']) || !empty($_POST['knlv19']) || !empty($_POST['knlv20']) || !empty($_POST['knlv21'])):?>
	<tr>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv15'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv16'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv17'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv18'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv19'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv20'] ?></td>
		<td style="border: 1px solid black" align="center"><?php echo $_POST['knlv21'] ?></td>
	</tr>
    <?php endif; ?>
    <?php if ( !empty($_POST['knlv22']) || !empty($_POST['knlv23']) || !empty($_POST['knlv24']) || !empty($_POST['knlv25']) || !empty($_POST['knlv26']) || !empty($_POST['knlv27']) || !empty($_POST['knlv28'])):?>
        <tr>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv22'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv23'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv24'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv25'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv26'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv27'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv28'] ?></td>
        </tr>
    <?php endif; ?>
    <?php if ( !empty($_POST['knlv29']) || !empty($_POST['knlv30']) || !empty($_POST['knlv31']) || !empty($_POST['knlv32']) || !empty($_POST['knlv33']) || !empty($_POST['knlv34']) || !empty($_POST['knlv35'])):?>
        <tr>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv29'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv30'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv31'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv32'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv33'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv34'] ?></td>
            <td style="border: 1px solid black" align="center"><?php echo $_POST['knlv35'] ?></td>
        </tr>
    <?php endif; ?>
</table>
<h5><i>Tôi cam đoan những thông tin trên đây là đúng sự thật.</i></h5>

<?php

// output goes only to buffer
$body = ob_get_contents();  // stores buffer contents to the variable
ob_end_clean();  // clears buffer and closes buffering ;

$mail->MsgHTML($body);
$mail->Body = $body;   // turns on output buffering

if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo "<h2>Thông tin của bạn đã được gửi tới <?=env('SITE_NAME', 'eFruit')?>. Chúng tôi sẽ trả lời bạn sớm nhất khi có thể. Cám ơn bạn.</h2>";
}
//echo $body;
?>
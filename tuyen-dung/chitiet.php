<?php
require_once(__DIR__.'/env.inc.php');
if (!empty($_SESSION['wrong_auth'])){
	unset($_SERVER['PHP_AUTH_USER']);
	unset($_SERVER['PHP_AUTH_PW']);  
	unset($_SESSION['wrong_auth']);
}
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header('WWW-Authenticate: Basic realm="eFruit - Jobs manager"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Bạn không có quyền truy cập trang này.';
	exit;
} else {
	if($_SERVER['PHP_AUTH_USER'] != 'tuyendung' || $_SERVER['PHP_AUTH_PW'] != '12345e'){
		echo 'Tên đăng nhập hoặc mật khẩu không đúng.';
		$_SESSION['wrong_auth'] = 1;
		exit;
	}
}

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

$id = $_GET['id'];
if(!is_numeric($id)){
	die('Invalid ID');
}
?>
<html>
<head>
<title><?=env('SITE_NAME', 'eFruit')?> - Thông tin ứng viên</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<style>
	body{
		font-family: Arial, serif;
	}
</style>
<body>
	<div class="container"> 
		<h2><?=env('SITE_NAME', 'eFruit')?> - Thông tin ứng viên</h2>
<?php
$query = "SELECT * FROM thongtinungvien WHERE id = $id";
	$result= mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result))
	{
		$row = $result->fetch_assoc();
		$form_data = json_decode($row['other'], true);
		?>
        <b>I/ THÔNG TIN CÁ NHÂN</b> <br>
        <table class="table"style="width: 100%; border-collapse: collapse; ">
            <tr>
                <td style="border: 1px solid black"> Họ và tên: <?php echo $form_data['hovaten'] ?></td>
                <td style="border: 1px solid black"> Số điện thoại di động: <?php echo $form_data['dienthoaididong'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Ngày sinh: <?php echo date('d/m/Y', strtotime($form_data['born'])) ?><br/>Nơi sinh: <?php echo $form_data['where'] ?></td>
                <td style="border: 1px solid black">Địa chỉ email: <?php echo $form_data['diachiemail'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Giớii tính: <?php echo $form_data['gender'] ?></td>
                <td style="border: 1px solid black">Tình trạng hôn nhân: <?php echo $form_data['tinhtranghonnhan'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black" >Dân tộc:&nbsp;<?php echo $form_data['dantoc'] ?></td>
                <td style="border: 1px solid black" >Tình trạng sức khỏe:&nbsp;<?php echo $form_data['tinhtrangsuckhoe'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Tôn giáo:&nbsp;<?php echo $form_data['tongiao'] ?></td>
                <td style="border: 1px solid black">Chiều cao: <?php echo $form_data['chieucao'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Quốc tịch: <?php echo $form_data['quoctich'] ?></td>
                <td style="border: 1px solid black">Cân nặng: <?php echo $form_data['cannang'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Số CMND: <?php echo $form_data['socmnd'] ?></td>
                <td style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Ngày cấp: <?php echo date('d/m/Y', strtotime($form_data['ngaycap'])) ?></td>
                <td style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Nơi cấp: <?php echo $form_data['noicap'] ?></td>
                <td style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black" colspan ="2">Hộ khẩu thường trú: <?php echo $form_data['hokhauthuongtru'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black" colspan ="2">Nơi ở hiện tại: <?php echo $form_data['noiohiennay'] ?></td>
            </tr>
        </table><br>
        <b>II/ THÔNG TIN ỨNG TUYỂN</b>
        <table class="table"style="width: 100%;  border-collapse: collapse;" >
            <tr>
                <td style="border: 1px solid black">
                    Thời gian ứng tuyển <?php echo $form_data['hinhthuc'] ?>:
                    <?php echo !empty($form_data['chonca'])?implode(', ', $form_data['chonca']):'' ?>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Vị trí ứng tuyển: <?php echo !empty($form_data['vitri'])?implode(', ', $form_data['vitri']):'' ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">
                    Mức lương mong muốn </br>
                    1. Khi thử việc: <?php echo is_numeric($form_data['thuviec'])?number_format($form_data['thuviec']):$form_data['thuviec'] ?> </br>
                    2. Sau thử việc: <?php echo is_numeric($form_data['sauthuviec'])?number_format($form_data['sauthuviec']):$form_data['sauthuviec'] ?>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Ngày có thể nhận việc <?php echo date('d/m/Y', strtotime($form_data['ngaycothe'])) ?></td>
            </tr>
        </table><br>
        <b>III/ TRÌNH ĐỘ HỌC VẤN</b><br>
        <table class="table"style="width: 100%; border-collapse: collapse; " >
            <tr>
                <td style="border: 1px solid black" colspan ="2">
                    Các văn bằng đạt được: <?php echo !empty($form_data['vanbang'])?implode(', ', $form_data['vanbang']):'' ?>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Trường: <?php echo $form_data['truong'] ?></td>
                <td style="border: 1px solid black">Tin học: <?php echo $form_data['tinhoc'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Ngành: <?php echo $form_data['nganh'] ?></td>
                <td style="border: 1px solid black">Ngoại ngữ: <?php echo $form_data['ngoaingu'] ?></td>
            </tr>
        </table><br>
        <table class="table"style="width: 100%;  border-collapse: collapse;" >
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
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangt2'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangt3'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangt4'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangt5'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangt6'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangt7'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['sangcn'] ?></td>
            </tr>
            <tr>
                <th style="border: 1px solid black" align="center">Chiều</th>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['chieut2'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['chieut3'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['chieut4'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['chieut5'] ?></td>
                <td align="center"><?php echo $form_data['chieut6'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['chieut7'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['chieucn'] ?></td>
            </tr>
            <tr>
                <th	style="border: 1px solid black" align="center"> Tối</th>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toit2'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toit3'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toit4'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toit5'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toit6'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toit7'] ?></td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['toicn'] ?></td>
            </tr>
        </table><br>

        <b>IV/ THÔNG TIN KHÁC</b><br>
        <table class="table"style="width: 100%;  border-collapse: collapse;">
            <tr>
                <td style="border: 1px solid black">1. Bạn có thể làm việc trong những ngày lễ, Tết(cổ truyền)?</td>
                <td style="border: 1px solid black" align="center"><?php echo $form_data['YN1'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid black">2. Bạn có thể làm tới 22h30 không?</td>
                <td style="border: 1px solid black" align="center"> <?php echo $form_data['YN2'] ?> </td>
            </tr>
            <tr>
                <td style="border: 1px solid black">3. Bạn có thể làm xoay ca được không?(có khi ca sáng, có khi ca tối, hay ca gãy)?</td>
                <td style="border: 1px solid black" align="center">  <?php echo $form_data['YN3'] ?> </td>
            </tr>
            <tr>
                <td style="border: 1px solid black">4. Bạn mong muốn làm việc với eFruit trong bao lâu?</td>
                <td style="border: 1px solid black" align="center"> <?php echo $form_data['YN4'] ?> </td>
            </tr>
            <tr>
                <td style="border: 1px solid black"><?=env('YN5', '5. Trước đây bạn đã từng làm ở cửa hàng cà phê, thức uống hay ngành hàng về F&B nào tương tự eFruit chưa?')?></td>
                <td style="border: 1px solid black" align="center">
                    <?php
                    if(!empty($form_data['YN5']) && $form_data['YN5']=='rồi')
                        echo 'Rồi'. (!empty($form_data['cuahang'])?': '.$form_data['cuahang']:'');
                    else
                        echo 'Chưa';
                    ?> </td>

            </tr>
            <tr>
                <td style="border: 1px solid black">6. Phương tiện di chuyển</td>
                <td style="border: 1px solid black" align="center"> <?php echo !empty($form_data['phuongtien'])?implode(', ', $form_data['phuongtien']):'' ?> </td>
            </tr>
        </table><br>
        <b>V/ ƯU ĐIỂM BẢN THÂN</b>
        <table class="table"style="width: 100%;  border-collapse: collapse;" >
            <tr>
                <td style="border: 1px solid black">Ưu điểm</td>
                <td style="border: 1px solid black" align="center"> <?php echo $form_data['uudiem'] ?> </td>
            </tr>
            <tr>
                <td style="border: 1px solid black">Năng khiếu, tài lẻ</td>
                <td style="border: 1px solid black" align="center"> <?php echo !empty($form_data['YN9'])?implode(', ', $form_data['YN9']):'' ?></td>
            </tr>
        </table><br>
        <b>VI/ THÔNG TIN GIA ĐÌNH  </b><i>(ghi tên bố/mẹ và một người lớn có sử dụng điện thoại để tham chiếu)</i>
        <table class="table"style="width: 100%;  border-collapse: collapse;" >
            <tr>
                <th style="border: 1px solid black" align="center">Họ và tên</th>
                <th style="border: 1px solid black" align="center">Năm sinh</th>
                <th style="border: 1px solid black" align="center">Quan hệ</th>
                <th style="border: 1px solid black" align="center">Nghề nghiệp</th>
                <th style="border: 1px solid black" align="center">Số điện thoại</th>
                <th style="border: 1px solid black" align="center">Nơi ở hiện nay</th>
            </tr>
            <tr>
                <?php if ( !empty($form_data['ttgd1']) || !empty($form_data['ttgd2']) || !empty($form_data['ttgd3']) || !empty($form_data['ttgd4']) || !empty($form_data['ttgd5']) || !empty($form_data['ttgd6'])):?>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd1'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd2'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd3'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd4'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd5'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd6'] ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ( !empty($form_data['ttgd8']) || !empty($form_data['ttgd9']) || !empty($form_data['ttgd10']) || !empty($form_data['ttgd11']) || !empty($form_data['ttgd12']) || !empty($form_data['ttgd13'])):?>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd8'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd9'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd10'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd11'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd12'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd13'] ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ( !empty($form_data['ttgd14']) || !empty($form_data['ttgd15']) || !empty($form_data['ttgd16']) || !empty($form_data['ttgd17']) || !empty($form_data['ttgd18']) || !empty($form_data['ttgd19'])):?>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd14'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd15'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd16'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd17'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd18'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd19'] ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ( !empty($form_data['ttgd20']) || !empty($form_data['ttgd21']) || !empty($form_data['ttgd22']) || !empty($form_data['ttgd23']) || !empty($form_data['ttgd24']) || !empty($form_data['ttgd25'])):?>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd20'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd21'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd22'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd23'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd24'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['ttgd25'] ?></td>
                <?php endif; ?>
            </tr>
        </table><br>
        <b>VI/ KINH NGHIỆM LÀM VIỆC <br></b>
        <table class="table"style="width: 100%;  border-collapse: collapse;" >
            <tr>
                <th style="border: 1px solid black" align="center">Công ty</th>
                <th style="border: 1px solid black" align="center">Chức vụ</th>
                <th style="border: 1px solid black" align="center">Lương</th>
                <th style="border: 1px solid black" align="center">Thời gian</th>
                <th style="border: 1px solid black" align="center">Lý do nghỉ việc</th>
                <th style="border: 1px solid black" align="center">Người tham chiếu</th>
                <th style="border: 1px solid black" align="center">Số ĐT liên hệ</th>
            </tr>
            <?php if ( !empty($form_data['knlv1']) || !empty($form_data['knlv2']) || !empty($form_data['knlv3']) || !empty($form_data['knlv4']) || !empty($form_data['knlv5']) || !empty($form_data['knlv6']) || !empty($form_data['knlv7'])):?>
                <tr>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv1'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv2'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv3'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv4'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv5'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv6'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv7'] ?></td>
                </tr>
            <?php endif; ?>
            <?php if ( !empty($form_data['knlv8']) || !empty($form_data['knlv9']) || !empty($form_data['knlv10']) || !empty($form_data['knlv11']) || !empty($form_data['knlv12']) || !empty($form_data['knlv13']) || !empty($form_data['knlv14'])):?>
                <tr>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv8'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv9'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv10'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv11'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv12'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv13'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv14'] ?></td>
                </tr>
            <?php endif; ?>
            <?php if ( !empty($form_data['knlv15']) || !empty($form_data['knlv16']) || !empty($form_data['knlv17']) || !empty($form_data['knlv18']) || !empty($form_data['knlv19']) || !empty($form_data['knlv20']) || !empty($form_data['knlv21'])):?>
                <tr>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv15'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv16'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv17'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv18'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv19'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv20'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv21'] ?></td>
                </tr>
            <?php endif; ?>
            <?php if ( !empty($form_data['knlv22']) || !empty($form_data['knlv23']) || !empty($form_data['knlv24']) || !empty($form_data['knlv25']) || !empty($form_data['knlv26']) || !empty($form_data['knlv27']) || !empty($form_data['knlv28'])):?>
                <tr>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv22'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv23'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv24'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv25'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv26'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv27'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv28'] ?></td>
                </tr>
            <?php endif; ?>
            <?php if ( !empty($form_data['knlv29']) || !empty($form_data['knlv30']) || !empty($form_data['knlv31']) || !empty($form_data['knlv32']) || !empty($form_data['knlv33']) || !empty($form_data['knlv34']) || !empty($form_data['knlv35'])):?>
                <tr>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv29'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv30'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv31'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv32'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv33'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv34'] ?></td>
                    <td style="border: 1px solid black" align="center"><?php echo $form_data['knlv35'] ?></td>
                </tr>
            <?php endif; ?>
        </table>
		<?php
	}
	else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
	</div>
</body>
</html> 
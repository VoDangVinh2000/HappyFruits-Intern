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
$diachiemail="";
$dienthoaididong="";
$form_data="";
?>
<html>
<head>
<title><?=env('SITE_NAME', 'eFruit')?> - Danh sách ứng tuyển</title>
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
		<h2><?=env('SITE_NAME', 'eFruit')?> - Danh sách ứng tuyển</h2>
<?php
	$query = "SELECT * FROM thongtinungvien ORDER BY created_dtm DESC";
	$result= mysqli_query($conn, $query);
	if(mysqli_num_rows($result))
	{
		?>
		<table class="table">
			<tr>
                <td style="border: 1px solid black" align='center'><b>ID</b></td>
                <td style="border: 1px solid black" align='center'><b>EMAIL</b></td>
                <td style="border: 1px solid black" align='center'><b>SỐ ĐIỆN THOẠI DI ĐỘNG</b></td>
                <td style="border: 1px solid black" align='center'><b>NGÀY NỘP</b></td>
                <td style="border: 1px solid black" align='center'></td></tr>
		<?php
		while($row = mysqli_fetch_array($result))
		{
			echo '<tr>
                    <td style="border: 1px solid black";>'.$row['id'].'</td>
                    <td style="border: 1px solid black";>'.$row['email'].'</td>
                    <td style="border: 1px solid black";>'.$row['mobile'].'</td>
                    <td style="border: 1px solid black";>'.(!empty($row['created_dtm']) && $row['created_dtm'] != '0000-00-00 00:00:00'?date('d/m/Y H:i', strtotime($row['created_dtm'])):'').'</td>
                    <td style="border: 1px solid black";><a target="_blank" href="chitiet.php?id='.$row['id'].'">Xem chi tiết</a></td>
                  </tr>';
		} 
		?>
		</table>
		<?php
	}
	else {
        ?>
		<p>Chưa có dữ liệu.</p>
		<?php
    }
?>
	</div>
</body>
</html> 
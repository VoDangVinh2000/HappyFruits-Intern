<?php
require_once(__DIR__ . '/env.inc.php');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
    <title><?= env('SITE_NAME', 'eFruit') ?> - Đăng kí ứng tuyển</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Trang ứng tuyển nhân viên của <?= env('SITE_NAME', 'eFruit') ?>" />
    <link rel="shortcut icon" href="<?= env('ICON_URL', 'https://www.efruit.vn/themes/efruit/assets/img/favicon.ico') ?>" />
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style type="text/css">
        label {
            font-size: 14px;
            font-weight: normal;
        }

        table {
            align: center;
        }

        .no-margin {
            margin: 0px;
        }

        input[type="date"] {
            padding: 0 6px;
        }

        .g-recaptcha {
            align: left;
        }

        table td input.form-control {
            border-radius: 0;
        }

        .has-error .form-control {
            border-width: 2px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('input[name="YN5"]').change(function() {
                console.log($('input[name="YN5"]:checked').val());
                if ($('input[name="YN5"]:checked').val() == 'rồi') {
                    $('#id_YN5_3, #knlv1, #knlv2, #knlv3, #knlv4, #knlv5, #knlv6').attr('required', '');
                } else {
                    $('#id_YN5_3, #knlv1, #knlv2, #knlv3, #knlv4, #knlv5, #knlv6').removeAttr('required');
                }
            });
            $('input[name="hinhthuc"]').on('click', function(e) {
                $("#div_id_chonca_fulltime").addClass('hidden');
                $("#div_id_chonca_parttime").addClass('hidden');
                if ($(this).val() == 'fulltime') {
                    $("#div_id_chonca_fulltime").removeClass('hidden');
                } else {
                    $("#div_id_chonca_parttime").removeClass('hidden');
                }
            });
            //$(#frmTuynDung).validator().on()
            $('#frmTuyenDung').on('submit', function(e) {
                if (e.isDefaultPrevented()) {
                    // handle the invalid form...
                } else {
                    if ($('input[name="hinhthuc"]:checked').val() == 'fulltime' && $('input[name="chonca[]"]:checked').length == 0) {
                        $('html, body').animate({
                            scrollTop: $("#div_id_chonca_fulltime").offset().top
                        }, 2000);
                        alert('Vui lòng chọn ca fulltime');
                        return false;
                    }
                    if ($('input[name="hinhthuc"]:checked').val() == 'part-time' && $('input[name="chonca[]"]:checked').length == 0) {
                        $('html, body').animate({
                            scrollTop: $("#div_id_chonca_parttime").offset().top
                        }, 2000);
                        alert('Vui lòng chọn ca parttime');
                        return false;
                    }
                    if ($('input[name="vanbang[]"]:checked').length == 0) {
                        $('html, body').animate({
                            scrollTop: $("#div_id_vanbang").offset().top
                        }, 2000);
                        alert('vui lòng chọn bằng cấp mà bạn có');
                        return false;
                    }
                    if ($('input[name="vitri[]"]:checked').length == 0) {
                        $('html, body').animate({
                            scrollTop: $("#div_id_vitri").offset().top
                        }, 2000);
                        alert('vui lòng chọn vị trí ứng tuyển');
                        return false;
                    }

                    if ($('#g-recaptcha-response').length && $('#g-recaptcha-response').val() == '') {
                        alert('Vui lòng xác nhận không phải người máy.');
                        return false;
                    }
                }
                return true;
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2 class="text-center"><?= env('SITE_NAME', 'eFruit') ?> - Đăng ký ứng tuyển</h2>
        <form id="frmTuyenDung" method="post" action="formxuatmail.php" role="form">
            <div class="mainbox col-md-12">
                <?php
                if (!empty($_SESSION['error'])) {
                    echo '<h2 style="color: red;">' . $_SESSION['error'] . '</h2>';
                }
                ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title"><b>I/ THÔNG TIN CÁ NHÂN</b></div>
                    </div>
                    <div class="panel-body">
                        <i>(*) là trường bắt buộc</i><br /><br />
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div id="div_id_hovaten" class="row">
                                    <div class="form-group">
                                        <label for="id_hovaten" class="control-label col-md-4">Họ và tên:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required name="hovaten" value="" id="id_hovaten" maxlength="30" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_born" class="row ">
                                    <div class="form-group">
                                        <label for="id_born" class="control-label col-md-4 requiredField">Ngày sinh:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_born" maxlength="30" name="born" placeholder="" style="margin-bottom: 10px" type="date" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_where" class="row">
                                    <div class="form-group">
                                        <label for="id_where" class="control-label col-md-4 requiredField">Nơi sinh:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_where" maxlength="30" name="where" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_gender" class="row">
                                    <div class="form-group">
                                        <label for="id_gender" class="control-label col-md-4 requiredField"> Giới tính:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8" style="margin-bottom: 10px">
                                            <label class="radio-inline"> <input required type="radio" name="gender" id="id_gender_1" value="Nam" style="margin-bottom: 10px">Nam </label>
                                            <label class="radio-inline"> <input required type="radio" name="gender" id="id_gender_2" value="Nữ" style="margin-bottom: 10px">Nữ </label>
                                            <label class="radio-inline"> <input required type="radio" name="gender" id="id_gender_3" value="Khác" style="margin-bottom: 10px">Khác... </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_dantoc" class="row">
                                    <div class="form-group">
                                        <label for="id_dantoc" class="control-label col-md-4 requiredField">Dân tộc:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_dantoc" maxlength="30" name="dantoc" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_tongiao" class="row">
                                    <div class="form-group">
                                        <label for="id_tongiao" class="control-label col-md-4 requiredField"> Tôn giáo:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_tongiao" maxlength="30" name="tongiao" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_quoctich" class="row">
                                    <div class="form-group">
                                        <label for="id_quoctich" class="control-label col-md-4 requiredField"> Quốc tịch:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_quoctich" maxlength="30" name="quoctich" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_socmnd" class="row">
                                    <div class="form-group">
                                        <label for="id_socmnd" class="control-label col-md-4 requiredField">Số CMND:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_socmnd" maxlength="30" name="socmnd" placeholder="" style="margin-bottom: 10px" type="number" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_ngaycap" class="row">
                                    <div class="form-group">
                                        <label for="id_ngaycap" class="control-label col-md-4 requiredField"> Ngày cấp:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_ngaycap" maxlength="30" name="ngaycap" placeholder="" style="margin-bottom: 10px" type="date" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_noicap" class="row">
                                    <div class="form-group">
                                        <label for="id_noicap" class="control-label col-md-4 requiredField"> Nơi cấp:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_noicap" name="noicap" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div id="div_id_dienthoaididong" class="row">
                                    <div class="form-group">
                                        <label for="id_dienthoaididong" class="control-label col-md-4 requiredField">Điện thoại di động:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_dienthoaididong" maxlength="11" name="dienthoaididong" placeholder="" style="margin-bottom: 10px" type="number" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_diachiemail" class="row required">
                                    <div class="form-group">
                                        <label for="id_diachiemail" class="control-label col-md-4 requiredField">Địa chỉ email:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input required class="input-md textinput textInput form-control" id="d_diachiemail" name="diachiemail" placeholder="" style="margin-bottom: 10px" type="email" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_tinhtranghonnhan" class="row">
                                    <div class="form-group">
                                        <label for="id_tinhtranghonnhan" class="control-label col-md-4 requiredField"> Tình trạng hôn nhân:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8" style="margin-bottom: 10px">
                                            <label class="radio-inline" style="margin-left: 0;"> <input required type="radio" name="tinhtranghonnhan" id="id_tinhtranghonnhan_1" value="Độc thân" style="margin-bottom: 10px">Độc thân </label>
                                            <label class="radio-inline" style="margin-left: 0;"> <input required type="radio" name="tinhtranghonnhan" id="id_tinhtranghonnhan_2" value="Kết hôn" style="margin-bottom: 10px">Kết hôn </label>
                                            <label class="radio-inline" style="margin-left: 0;"> <input required type="radio" name="tinhtranghonnhan" id="id_tinhtranghonnhan_3" value="Khác" style="margin-bottom: 10px">Khác... </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_tinhtrangsuckhoe" class="row">
                                    <div class="form-group">
                                        <label for="id_tinhtrangsuckhoe" class="control-label col-md-4 requiredField"> Tình trạng sức khỏe:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_tinhtrangsuckhoe" name="tinhtrangsuckhoe" placeholder="" style="margin-bottom: 10px" type="text" />
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_chieucao" class="row">
                                    <label for="id_chieucao" class="control-label col-md-4 requiredField"> Chiều cao:<span class="asteriskField"></span> </label>
                                    <div class="controls col-md-8">
                                        <input class="input-md textinput textInput form-control" id="id_chieucao" maxlength="30" name="chieucao" placeholder="" style="margin-bottom: 10px" type="text" />
                                    </div>
                                </div>
                                <div id="div_id_cannang" class="row required">
                                    <label for="id_cannang" class="control-label col-md-4 requiredField"> Cân nặng:<span class="asteriskField"></span> </label>
                                    <div class="controls col-md-8">
                                        <input class="input-md textinput textInput form-control" id="id_cannang" maxlength="30" name="cannang" placeholder="" style="margin-bottom: 10px" type="text" />
                                    </div>
                                </div>
                                <!--
                            <div id="div_id_sotk" class="row required">
                                <label for="id_sotk" class="control-label col-md-4 requiredField">Số tài khoản:<span class="asteriskField"></span> </label>
                                <div class="controls col-md-8">
                                    <input class="input-md textinput textInput form-control" id="id_sotk" maxlength="30" name="sotk" placeholder="" style="margin-bottom: 10px" type="number" />
                                </div>
                            </div>
                            <div id="div_id_nganhang" class="row required">
                                <label for="id_nganhang" class="control-label col-md-4 requiredField">Ngân hàng:<span class="asteriskField"></span> </label>
                                <div class="controls col-md-8">
                                    <input class="input-md textinput textInput form-control" id="id_nganhang" maxlength="30" name="nganhang" placeholder="" style="margin-bottom: 10px" type="text" />
                                </div>
                            </div>
                            <div id="div_id_chinhanh" class="row required">
                                <label for="id_chinhanh" class="control-label col-md-4 requiredField">Chi nhánh:<span class="asteriskField"></span> </label>
                                <div class="controls col-md-8">
                                    <input class="input-md textinput textInput form-control" id="id_chinhanh" maxlength="30" name="chinhanh" placeholder="" style="margin-bottom: 10px" type="text" />
                                </div>
                            </div>
							-->
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div id="div_id_hokhauthuongtru" class="row">
                                    <div class="form-group">
                                        <label for="id_hokhauthuongtru" class="control-label col-md-3 requiredField">Hộ khẩu thường trú:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-9">
                                            <input class="input-md textinput textInput form-control" required id="id_hokhauthuongtru" name="hokhauthuongtru" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_noiohiennay" class="row">
                                    <div class="form-group">
                                        <label for="id_noiohiennay" class="control-label col-md-3 requiredField">Nơi ở hiện nay:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-9">
                                            <input class="input-md textinput textInput form-control" required id="id_noiohiennay" name="noiohiennay" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <div class="panel-title"><b>II/ THÔNG TIN ỨNG TUYỂN</b></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="div_id_hinhthuc" class="row">
                                    <div class="form-group">
                                        <label for="id_hinhthuc" class="control-label col-md-3 requiredField">Thời gian ứng tuyển:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-9" style="margin-bottom: 10px">
                                            <label class="radio-inline" style="margin-left: 0;"> <input required type="radio" name="hinhthuc" id="id_hinhthuc_1" value="fulltime" style="margin-bottom: 10px">Fulltime <i>(6ngày/tuần, T7, CN xoay 1 ngày, nghỉ 1 ngày)</i><br></label>
                                            &nbsp;&nbsp;
                                            <label class="radio-inline" style="margin-left: 0;"> <input required type="radio" name="hinhthuc" id="id_hinhthuc_2" value="part-time" style="margin-bottom: 10px">Partime <i>12h - 17h30, 17h - 22h</i><br></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_chonca_fulltime" class="row hidden">
                                    <div class="form-group">
                                        <label for="id_chonca" class="control-label col-md-3 requiredField"><span class="asteriskField"></span> </label>
                                        <div class="controls col-md-9" style="margin-bottom: 10px">
                                            <label class="checkbox-inline"> <input type="checkbox" name="chonca[]" id="id_chonca_1" value="7h30 - 17h" style="margin-bottom: 10px">7h30 - 17h </label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="chonca[]" id="id_chonca_2" value="13h - 22h" style="margin-bottom: 10px">13h - 22h<br> </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_chonca_parttime" class="row hidden">
                                    <div class="form-group">
                                        <label for="id_chonca" class="control-label col-md-3 requiredField"><span class="asteriskField"></span> </label>
                                        <div class="controls col-md-9" style="margin-bottom: 10px">
                                            <label class="checkbox-inline"> <input type="checkbox" name="chonca[]" id="id_chonca_4" value="12h - 17h30" style="margin-bottom: 10px">12h - 17h30 </label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="chonca[]" id="id_chonca_5" value="17h - 22h" style="margin-bottom: 10px">17h - 22h<br> </label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="chonca[]" id="id_chonca_6" value="partime" style="margin-bottom: 10px">part-time không cố định<br> </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_vitri" class="row">
                                    <div class="form-group">
                                        <label for="id_vitri" class="control-label col-md-3 requiredField">Vị trí ứng tuyển:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-9" style="margin-bottom: 10px">
                                            <?php
                                            $positions = env('POSITIONS', array(
                                                'Quản lý cửa hàng',
                                                'Nhân viên vận hành (admin)',
                                                'Nhân viên quản lý và phát triển sản phẩm',
                                                'Pha chế',
                                                'Giao hàng, hậu cần',
                                                'Thu ngân, bán hàng',
                                                'Khác...'
                                            ));
                                            $i = 1;
                                            foreach ($positions as $pos) :
                                            ?>
                                                <label class="checkbox-inline"> <input type="checkbox" name="vitri[]" id="id_vitri_<?= $i ?>" value="<?= $pos ?>" style="margin-bottom: 10px"><?= $pos ?></label><br />
                                            <?php $i++;
                                            endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <h4><b> Mức lương mong đợi</b></h4>
                                <div id="div_id_thuviec" class="row">
                                    <div class="form-group">
                                        <label for="id_thuviec" class="control-label col-md-3 requiredField">1. Khi thử việc:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-3">
                                            <input class="input-md textinput textInput form-control" required id="id_thuviec" maxlength="11" name="thuviec" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_sauthuviec" class="row">
                                    <div class="form-group">
                                        <label for="id_sauthuviec" class="control-label col-md-3 requiredField">2. Sau thử việc:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-3">
                                            <input class="input-md textinput textInput form-control" required id="id_sauthuviec" maxlength="11" name="sauthuviec" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_ngaycothe" class="row">
                                    <div class="form-group">
                                        <label for="id_ngaycothe" class="control-label col-md-3 requiredField">Ngày có thể nhận việc:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-3">
                                            <input class="input-md textinput textInput form-control" required id="id_ngaycothe" maxlength="30" name="ngaycothe" placeholder="" style="margin-bottom: 10px" type="date" />
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">
                        <div class="panel-title"><b>III/ TRÌNH ĐỘ HỌC VẤN</b></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="div_id_vanbang" class="row">
                                    <div class="form-group">
                                        <label for="id_vanbang" class="control-label col-md-4 requiredField">1. Các văn bằng đạt được: <span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8" style="margin-bottom: 10px">
                                            <label class="checkbox-inline"> <input type="checkbox" name="vanbang[]" id="id_vanbang_1" value="THPT" style="margin-bottom: 10px">THPT</label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="vanbang[]" id="id_vanbang_2" value="Trung cấp" style="margin-bottom: 10px">Trung cấp</label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="vanbang[]" id="id_vanbang_3" value="Cao đẳng" style="margin-bottom: 10px">Cao đẳng</label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="vanbang[]" id="id_vanbang_4" value="Đại học" style="margin-bottom: 10px">Đại học </label>
                                            <label class="checkbox-inline"> <input type="checkbox" name="vanbang[]" id="id_vanbang_3" value="Khác..." style="margin-bottom: 10px">Khác...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="div_id_truong" class="row">
                                    <div class="form-group">
                                        <label for="id_truong" class="control-label col-md-4 requiredField">Trường:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-8">
                                            <input class="input-md textinput textInput form-control" required id="id_truong" maxlength="30" name="truong" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_nganh" class="row required">
                                    <label for="id_nganh" class="control-label col-md-4 requiredField">Ngành:<span class="asteriskField"></span> </label>
                                    <div class="controls col-md-8">
                                        <input class="input-md textinput textInput form-control" id="id_nganh" name="nganh" placeholder="" style="margin-bottom: 10px" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="div_id_ngoaingu" class="row required">
                                    <label for="id_ngoaingu" class="control-label col-md-4 requiredField">Ngoại ngữ:<span class="asteriskField"></span> </label>
                                    <div class="controls col-md-8">
                                        <input class="input-md textinput textInput form-control" id="id_ngoaingu" name="ngoaingu" placeholder="" style="margin-bottom: 10px" type="text" />
                                    </div>
                                </div>
                                <div id="div_id_tinhoc" class="row required">
                                    <label for="id_tinhoc" class="control-label col-md-4 requiredField">Tin học:<span class="asteriskField"></span> </label>
                                    <div class="controls col-md-8">
                                        <input class="input-md textinput textInput form-control" id="id_tinhoc" name="tinhoc" placeholder="" style="margin-bottom: 10px" type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table border="1">
                                    <tr>
                                        <td align="center">Lịch học:</td>
                                        <td align="center"><b>T2</b></td>
                                        <td align="center"><b>T3</b></td>
                                        <td align="center"><b>T4</b></td>
                                        <td align="center"><b>T5</b></td>
                                        <td align="center"><b>T6</b></td>
                                        <td align="center"><b>T7</b></td>
                                        <td align="center"><b>CN</b></td>
                                    </tr>
                                    <tr>
                                        <td align="center">Sáng</td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangt2" name="sangt2" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangt3" name="sangt3" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangt4" name="sangt4" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangt5" name="sangt5" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangt6" name="sangt6" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangt7" name="sangt7" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="sangcn" name="sangcn" class="form-control" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">Chiều</td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieut2" name="chieut2" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieut3" name="chieut3" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieut4" name="chieut4" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieut5" name="chieut5" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieut6" name="chieut6" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieut7" name="chieut7" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="chieucn" name="chieucn" class="form-control" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">Tối</td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toit2" name="toit2" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toit3" name="toit3" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toit4" name="toit4" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toit5" name="toit5" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toit6" name="toit6" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toit7" name="toit7" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="toicn" name="toicn" class="form-control" value="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel-heading">
                        <div class="panel-title"><b>IV/ THÔNG TIN KHÁC</b></div>
                    </div>
                    <div class="panel-body">
                        <div id="div_id_YN1" class="row">
                            <div class="form-group">
                                <label for="id_YN1" class="control-label col-md-5 requiredField">1. Bạn có thể làm việc trong những ngày lễ, Tết(cổ truyền)?</label>
                                <div class="controls col-md-7" style="margin-bottom: 10px">
                                    <label class="radio-inline"> <input type="radio" required name="YN1" id="id_YN1_1" value="Có" style="margin-bottom: 10px">Có </label>
                                    <label class="radio-inline"> <input type="radio" required name="YN1" id="id_YN1_2" value="Không" style="margin-bottom: 10px">Không </label>
                                </div>
                            </div>
                        </div>
                        <div id="div_id_YN2" class="row ">
                            <div class="form-group">
                                <label for="id_YN2" class="control-label col-md-5 requiredField">2. Bạn có thể làm tới 22h30 không?</label>
                                <div class="controls col-md-7" style="margin-bottom: 10px">
                                    <label class="radio-inline"> <input required type="radio" name="YN2" id="id_YN2_1" value="Có" style="margin-bottom: 10px">Có </label>
                                    <label class="radio-inline"> <input required type="radio" name="YN2" id="id_YN2_2" value="Không" style="margin-bottom: 10px">Không </label>
                                </div>
                            </div>
                        </div>
                        <div id="div_id_YN3" class="row">
                            <div class="form-group">
                                <label for="id_YN3" class="control-label col-md-5 requiredField">3. Bạn có thể làm xoay ca được không?<br />(có khi ca sáng, có khi ca tối, hay ca gãy)</label>
                                <div class="controls col-md-7" style="margin-bottom: 10px">
                                    <label class="radio-inline"> <input required type="radio" name="YN3" id="id_YN3_1" value="Ca 1: 12h - 17h" style="margin-bottom: 10px">Ca 1: 12h - 17h30 </label>
                                    <label class="radio-inline"> <input required type="radio" name="YN3" id="id_YN3_2" value="Ca 2: 17h - 22h30 " style="margin-bottom: 10px">Ca 2: 17h - 22h30 </label>
                                </div>
                            </div>
                        </div>
                        <div id="div_id_YN4" class="row">
                            <div class="form-group">
                                <label for="id_YN4" class="control-label col-md-5 requiredField">4. Bạn mong muốn làm việc với <?= env('SITE_NAME', 'eFruit') ?> trong bao lâu?</label>
                                <div class="controls col-md-7" style="margin-bottom: 10px">
                                    <label class="radio-inline"> <input required type="radio" name="YN4" id="id_YN4_1" value="2-3 tháng" style="margin-bottom: 10px">2-3 tháng </label>
                                    <label class="radio-inline"> <input required type="radio" name="YN4" id="id_YN4_2" value="4-6 tháng" style="margin-bottom: 10px">4-6 tháng </label>
                                    <label class="radio-inline"> <input required type="radio" name="YN4" id="id_YN4_3" value="Hơn 6 tháng" style="margin-bottom: 10px">Hơn 6 tháng </label>
                                    <label class="radio-inline"> <input required type="radio" name="YN4" id="id_YN4_4" value="Lâu hơn nữa" style="margin-bottom: 10px">Lâu hơn nữa </label>
                                </div>
                            </div>
                        </div>
                        <div id="div_id_YN5" class="row">
                            <div class="form-group">
                                <label for="id_YN5" class="control-label col-md-12 requiredField"><?= env('YN5', '5. Trước đây bạn đã từng làm ở cửa hàng cà phê, thức uống hay ngành hàng về F&B nào tương tự eFruit chưa?') ?><span class="asteriskField"></span> </label>
                                <div class="controls col-md-8" style="margin-bottom: 10px">
                                    <label class="radio-inline"> <input required type="radio" name="YN5" id="id_YN5_1" value="Chưa" style="margin-bottom: 10px">Chưa </label>
                                    <label class="radio-inline"> <input required type="radio" name="YN5" id="id_YN5_2" value="rồi" style="margin-bottom: 10px">Rồi </label>
                                    (Nếu rồi thì Tên công ty/ cửa hàng) <input type="text" id="id_YN5_3" name="cuahang" value="" class="form-control"> <br>
                                </div>
                            </div>
                        </div>
                        <div id="div_id_YN7" class="row">
                            <div class="form-group">
                                <label for="id_YN7" class="control-label col-md-5">6. Phương tiện di chuyển</label>
                                <div class="controls col-md-7" style="margin-bottom: 10px">
                                    <label class="checkbox-inline"> <input type="checkbox" name="phuongtien[]" id="id_YN7_1" value="Xe máy" style="margin-bottom: 10px">Xe máy </label>
                                    <label class="checkbox-inline"> <input type="checkbox" name="phuongtien[]" id="id_YN7_2" value="Xe đạp" style="margin-bottom: 10px"> Xe đạp</label>
                                    <label class="checkbox-inline"> <input type="checkbox" name="phuongtien[]" id="id_YN7_3" value="Xe bus" style="margin-bottom: 10px"> Xe Bus </label>
                                    <label class="checkbox-inline"> <input type="checkbox" name="phuongtien[]" id="id_YN7_4" value="Khác..." style="margin-bottom: 10px">Khác...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <div class="panel-title"><b>V/ ƯU ĐIỂM BẢN THÂN</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div id="div_id_uudiem" class="row">
                                    <div class="form-group">
                                        <label for="id_uudiem" class="control-label col-md-3 requiredField">Ưu điểm:<span class="asteriskField">(*)</span> </label>
                                        <div class="controls col-md-9">
                                            <input class="input-md textinput textInput form-control" required id="id_uudiem" name="uudiem" placeholder="" style="margin-bottom: 10px" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="div_id_nangkhieu" class="row">
                                    <div class="form-group">
                                        <label for="id_nangkhieu" class="control-label col-md-3 requiredField">Năng khiếu, tài lẻ:</label>
                                        <div class="controls col-md-9" style="margin-bottom: 10px">
                                            <?php
                                            $abilities = env('ABILITIES', array(
                                                'Chụp ảnh',
                                                'Vẽ, hội họa',
                                                'MC, hát',
                                                'Viết lách',
                                                'Nấu ăn',
                                                'Điêu khắc',
                                                'Biết sử dụng đồ họa',
                                                'Khác...'
                                            ));
                                            $i = 1;
                                            foreach ($abilities as $ab) :
                                            ?>
                                                <?= $i == 6 ? '<br/>' : '' ?><label <?= $i == 5 ? 'style="margin-left: 0;"' : '' ?> class="checkbox-inline"> <input type="checkbox" name="YN9[]" id="id_nangkhieu_<?= $i ?>" value="<?= $ab ?>" style="margin-bottom: 10px"><?= $ab ?></label>
                                            <?php $i++;
                                            endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <div class="panel-title"><b>VI/ THÔNG TIN GIA ĐÌNH </b><i>(ghi tên bố/mẹ và một người lớn có sử dụng điện thoại để tham chiếu)</i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <table border="1">
                                    <tr>
                                        <td height="40" align="center">Họ và tên</td>
                                        <td align="center">Năm sinh</td>
                                        <td align="center">Quan hệ</td>
                                        <td align="center">Nghề nghiệp</td>
                                        <td align="center">Số điện thoại</td>
                                        <td align="center">Nơi ở hiện nay</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input required type="text" id="ttgd1" name="ttgd1" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input required type="text" id="ttgd2" name="ttgd2" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input required type="text" id="ttgd3" name="ttgd3" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input required type="text" id="ttgd4" name="ttgd4" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input required type="number" id="ttgd5" name="ttgd5" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input required type="text" id="ttgd6" name="ttgd6" class="form-control" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd8" name="ttgd8" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd9" name="ttgd9" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd10" name="ttgd10" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd11" name="ttgd11" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="number" id="ttgd12" name="ttgd12" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd13" name="ttgd13" class="form-control" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd14" name="ttgd14" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd15" name="ttgd15" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd16" name="ttgd16" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd17" name="ttgd17" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="number" id="ttgd18" name="ttgd18" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" id="ttgd19" name="ttgd19" class="form-control" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd20" name="ttgd20" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd21" name="ttgd21" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd22" name="ttgd22" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd23" name="ttgd23" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group no-margin">
                                                <input type="number" id="ttgd24" name="ttgd24" class="form-control" value="">
                                            </div>
                                        </td>
                                        <td>

                                            <div class="form-group no-margin">
                                                <input type="text" id="ttgd25" name="ttgd25" class="form-control" value="">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <div class="panel-title"><b>VII/ KINH NGHIỆM LÀM VIỆC</b></div>
                    </div>
                    <div class="panel-body">
                        <table border="1">
                            <tr>
                                <td align="center" height="40">Công ty</td>
                                <td align="center">Chức vụ</td>
                                <td align="center">Lương</td>
                                <td align="center">Thời gian</td>
                                <td align="center">Lý do nghỉ việc</td>
                                <td align="center">Người tham chiếu</td>
                                <td align="center">Số ĐT liên hệ</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv1" name="knlv1" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv2" name="knlv2" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv3" name="knlv3" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv4" name="knlv4" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv5" name="knlv5" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv6" name="knlv6" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv6" name="knlv7" class="form-control" value="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv7" name="knlv8" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv8" name="knlv9" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv9" name="knlv10" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv10" name="knlv11" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv11" name="knlv12" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv12" name="knlv13" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv13" name="knlv14" class="form-control" value="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv14" name="knlv15" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv15" name="knlv16" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv16" name="knlv17" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv17" name="knlv18" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv18" name="knlv19" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv19" name="knlv20" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv20" name="knlv21" class="form-control" value="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv14" name="knlv22" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv15" name="knlv23" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv16" name="knlv24" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv17" name="knlv25" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv18" name="knlv26" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv19" name="knlv27" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv20" name="knlv28" class="form-control" value="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv14" name="knlv29" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv15" name="knlv30" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv16" name="knlv31" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv17" name="knlv32" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv18" name="knlv33" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="text" id="knlv19" name="knlv34" class="form-control" value="">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group no-margin">
                                        <input type="number" id="knlv20" name="knlv35" class="form-control" value="">
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <h5><i>Tôi cam đoan những thông tin trên đây là đúng sự thật.</i></h5>
                        <div class="g-recaptcha" data-sitekey="6LdWiXkUAAAAAMdOa5hcGJTwlleKbBdc5zMO6OhG"></div>
                        <div class="clearfix"></div><br />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" name="" value="Đăng kí" class="btn btn-primary btn btn-info" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </form>
</body>

</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="js/validator.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
<?php
session_destroy();
?>
<?php

if (!$controlerObj->is_logged)
    die('Please login!!');

if (!session_id())
    session_start();

// Don't remove the following two rows
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$root = "http://$_SERVER[HTTP_HOST]";

$is_from_CKEditor = isset($_GET['CKEditor']) && isset($_GET['CKEditorFuncNum']);
$is_selecting_image = !empty($_GET['type']) && $_GET['type'] == 'select';
$url = BASE_URL. 'assets/plugins/ckeditor/plugins/imageuploader/';
if(isset($_GET["file_style"])){
    $file_style = strip_tags($_GET["file_style"]);
    $file_style = htmlspecialchars($file_style, ENT_QUOTES);
    if($file_style == "block" or $file_style == "list"){
        setcookie(
            "file_style",
            $file_style,
            time() + (10 * 365 * 24 * 60 * 60)
        );
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo '
            <script>
            alert("An error occurred.\r\n\r\nPlease use the image browser to change the file style or try again.");
            history.back();
            </script>
        ';
    }
} 

// show/hide file extension
if(!isset($_COOKIE["file_extens"])){
    $file_extens = "no";
} else {
    $file_extens = $_COOKIE["file_extens"];
}

// file_style
if(!isset($_COOKIE["file_style"])){
    $file_style = "block";
} else {
    $file_style = $_COOKIE["file_style"];
}

// Path to the upload folder, please set the path using the Image Browser Settings menu.
$useruploadpath = get_upload_path();

$filenames = array(
    "imgbrowser.php",
    "imgdelete.php",
    "imgupload.php",
    "pluginconfig.php",
    "uploads/",
);
foreach($filenames as $filename){
    if (!is_writable(__DIR__ .'/'.$filename)){
        $check_permission = false;
    } else {
        $check_permission = true;
    }
}
if(!$check_permission):
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <title>Quản lý hình ảnh <?=$is_from_CKEditor?'- CKEditor':''?> - Hệ thống quản lý cửa hàng</title>
        <link rel="icon" href="<?=get_admin_theme_assets_url()?>favicon.ico"/>
        <link rel="stylesheet" href="<?=$url?>styles.css"/>
        
        <script src="<?=$url?>dist/jquery.min.js"></script>
        <script src="<?=$url?>dist/jquery.lazyload.min.js"></script>
        <script src="<?=$url?>dist/js.cookie-2.0.3.min.js"></script>
        
        <script src="<?=$url?>function.js"></script>
        <style>
            #folderError a {
                color: #55ACEE;
            }
        </style>
    </head>
    <body>
    <div id="folderError">
        <b>Thanks for choosing Image Uploader and Browser for CKEditor!</b><br><br>
        To use this plugin you need to set <b>CHMOD writable permission (0777)</b> to the <i>imageuploader</i> folder on your server. <a href="http://ow.ly/RE7wC" target="_blank">How to Change File Permissions Using FileZilla (external link)</a><br><br>
        Check out the <a href="http://imageuploaderforckeditor.altervista.org/" target="_blank">Documentation</a> or the <a href="http://imageuploaderforckeditor.altervista.org/support/" target="_blank">Plugin FAQ</a> for more help.
    </div>

    </body>
    </html>
<?php
exit;
endif;
?>
<!DOCTYPE html>
<html lang="en"
      ondragover="toggleDropzone('show')"
      ondragleave="toggleDropzone('hide')">
<head>
    
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <title>Quản lý hình ảnh <?=$is_from_CKEditor?'- CKEditor':''?> - Hệ thống quản lý cửa hàng</title>
    <link rel="icon" href="<?=get_admin_theme_assets_url()?>favicon.ico"/>
    <link rel="stylesheet" href="<?=$url?>styles.css"/>
    
    <script src="<?=$url?>dist/jquery.min.js"></script>
    <script src="<?=$url?>dist/jquery.lazyload.min.js"></script>
    <script src="<?=$url?>dist/js.cookie-2.0.3.min.js"></script>
    
    <script src="<?=$url?>dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=$url?>dist/sweetalert.css"/>
    
    <script>var base_url = '<?=BASE_URL?>';</script>
    <script src="<?=$url?>function.js"></script>
</head>
<body>
    
<div id="header">
    <?php if ($is_from_CKEditor || $is_selecting_image):?>
    <img title="Quit" onclick="Cookies.remove('qEditMode');window.close();" src="<?=$url?>img/cd-icon-close-grey.png" class="headerIconRight iconHover"/>
    <?php endif;?>
    <img title="Reload" onclick="reloadImages();" src="<?=$url?>img/cd-icon-refresh.png" class="headerIconRight iconHover"/>
    <img title="Upload" onclick="uploadImg();" src="<?=$url?>img/cd-icon-upload-grey.png" class="headerIconCenter iconHover"/>
</div>
    
<div id="editbar">
    <div id="editbarView" onclick="#" class="editbarDiv"><img src="<?=$url?>img/cd-icon-images.png" class="editbarIcon editbarIconLeft"/><p class="editbarText">Xem</p></div>
    <a href="#" id="editbarDownload"><div class="editbarDiv"><img src="<?=$url?>img/cd-icon-download.png" class="editbarIcon editbarIconLeft"/><p class="editbarText">Download</p></div></a>
    <div id="editbarDelete" onclick="#" class="editbarDiv"><img src="<?=$url?>img/cd-icon-qtrash.png" class="editbarIcon editbarIconLeft"/><p class="editbarText">Xóa</p></div>
    <?php if ($is_from_CKEditor || $is_selecting_image):?>
    <div id="editbarUse" onclick="#" class="editbarDiv"><img src="<?=$url?>img/cd-icon-use.png" class="editbarIcon editbarIconLeft"/><p class="editbarText">Sử dụng</p></div>
    <?php endif;?>
    <img onclick="hideEditBar();" src="<?=$url?>img/cd-icon-close-black.png" class="editbarIcon editbarIconRight"/>
</div>
    
<div id="updates" class="popout"></div>
    
<div id="dropzone" class="dropzone" 
     ondragenter="return false;"
     ondragover="return false;"
     ondrop="drop(event)">
    <p>
        <img src="<?=$url?>img/cd-icon-upload-big.png"/><br/>
        Drop your files here
    </p>
</div>

<p class="folderInfo">Tổng: <span id="finalcount"></span> hình ảnh - <span id="finalsize"></span>
    <?php if($file_style == "block") { ?>
        <img title="List" src="<?=$url?>img/cd-icon-list.png" class="headerIcon floatRight" onclick="window.location.href = '<?=strstr($link, '?')?"$link&file_style=list":"$link?file_style=list"?>';"/>
    <?php } elseif($file_style == "list") { ?>
        <img title="Block" src="<?=$url?>img/cd-icon-block.png" class="headerIcon floatRight" onclick="window.location.href = '<?=strstr($link, '?')?"$link&file_style=block":"$link?file_style=block"?>';"/>
    <?php } ?>
</p>

<div id="files" style="margin: 0 1.2%;">
    <?php
    if (empty($images))
        echo '<div id="folderError">No images.</div>';
    else{
        $filesizefinal = 0;
        $count = 0;
        foreach($images as $image_data):
            $image = get_upload_path(). $image_data['filename'];
            $image_pathinfo = pathinfo($image);
            if(empty($image_pathinfo) || empty($image_pathinfo['extension']))
                continue;
            $image_extension = $image_pathinfo['extension'];
            $image_filename = $image_pathinfo['filename'];
            $path = get_upload_url(). $image_data['filename'];
            $square_small_path = get_upload_url(). 'square-small/'. $image_data['filename'];
            $size = @getimagesize($image);
            if ($size)
                $image_height = $size[0];
            else
                $image_height = 1000;
            $file_size_byte = @filesize($image);
            if (empty($file_size_byte)){
                $file_size_byte = 1024;
            }
            $file_size_kilobyte = ($file_size_byte/1024);
            $file_size_kilobyte_rounded = round($file_size_kilobyte,1);
            $filesizetemp = $file_size_kilobyte_rounded;
            $filesizefinal = round($filesizefinal + $filesizetemp);
            $count = ++$count;
            
            if($file_style == "block") { ?>
                <div class="fileDiv"
                     onclick="showEditBar('<?php echo $path; ?>','<?php echo $image_height; ?>','<?php echo $image_data['id']; ?>');"
                     ondblclick="showImage('<?php echo $path; ?>','<?php echo $image_height; ?>','<?php echo $image_data['id']; ?>');"
                     data-imgid="<?php echo $image_data['id']; ?>">
                    <div class="imgDiv"><img class="fileImg lazy" src="<?php echo $square_small_path; ?>"/></div>
                    <p class="fileDescription"><span class="fileMime"><?php echo $image_extension; ?></span> <?php echo $image_filename; ?><?php if($file_extens == "yes"){echo ".$image_extension";} ?></p>
                    <p class="fileTime"><?php echo date ("d/m/Y H:i", strtotime($image_data['created_dtm'])); ?></p>
                    <p class="fileTime"><?php echo $filesizetemp; ?> KB</p>
                </div>
            <?php } elseif($file_style == "list") { ?>
                <div class="fullWidthFileDiv"
                     onclick="showEditBar('<?php echo $path; ?>','<?php echo $image_height; ?>','<?php echo $image_data['id']; ?>');"
                     ondblclick="showImage('<?php echo $path; ?>','<?php echo $image_height; ?>','<?php echo $image_data['id']; ?>');"
                     data-imgid="<?php echo $image_data['id']; ?>">
                    <div class="fullWidthimgDiv"><img class="fullWidthfileImg lazy" src="<?php echo $square_small_path; ?>"/></div>
                    <p class="fullWidthfileDescription"><?php echo $image_filename; ?><?php if($file_extens == "yes"){echo ".$image_extension";} ?></p>
                    
                    <div class="qEditIconsDiv">
                        <img title="Delete File" src="<?=$url?>img/cd-icon-qtrash.png" class="qEditIconsImg" onclick="window.location.href = 'imgdelete.php?img=<?php echo $image; ?>'">
                    </div>
                    
                    <p class="fullWidthfileTime fullWidthfileMime fullWidthlastChild"><?php echo $image_extension; ?></p>
                    <p class="fullWidthfileTime"><?php echo $filesizetemp; ?> KB</p>
                    <p class="fullWidthfileTime fullWidth30percent"><?php echo date ("d/m/Y H:i", strtotime($image_data['created_dtm'])); ?></p>
                </div>
            <?php }

        endforeach;
        if($filesizefinal >= 1024){
            $filesizefinal = round($filesizefinal/1024,1) . " MB";
        }else{
            $filesizefinal .= " KB";
        }
        echo "
        <script>
            $( '#finalsize' ).html('$filesizefinal');
            $( '#finalcount' ).html('$count');
        </script>
        ";
    }
    ?>
</div>
    
<div id="uploadImgDiv" class="lightbox popout">
    <div class="buttonBar">
        <button class="headerBtn" onclick="$('#uploadImgDiv').hide(); $('#background2').slideUp(250, 'swing');"><img src="<?=$url?>img/cd-icon-close.png" class="headerIcon"/></button>
        <button class="headerBtn greenBtn" name="submit" style="font-size: 20px;" onclick="$('#uploadImgForm').submit();"><img src="<?=$url?>img/cd-icon-upload.png" class="headerIcon"/> Tải lên</button>
    </div><br/><br/><br/>
    <form action="<?=BASE_URL?>tai-anh" method="post" enctype="multipart/form-data" id="uploadImgForm" onsubmit="return checkUpload();">
        <p class="uploadP"><img src="<?=$url?>img/cd-icon-select.png" class="headerIcon"/>Chọn file tải lên</p>
        <input type="file" name="upload[]" id="upload" multiple/>
        <input type="hidden" name="redirect_to" value="<?=$link?>" />
        <br/>
        <br/>
    </form>
</div>

<div id="imageFullSreen" class="lightbox popout">
    <div class="buttonBar">
        <button id="imageFullSreenClose" class="headerBtn" onclick="$('#imageFullSreen').hide(); $('#background').slideUp(250, 'swing'); $('body').css('overflow', '');"><img src="<?=$url?>img/cd-icon-close.png" class="headerIcon"/></button>
        <a href="#" id="imgActionDownload"><button class="headerBtn"><img src="<?=$url?>img/cd-icon-download.png" class="headerIcon"/></button></a>
        <button class="headerBtn" id="imgActionDelete"><img src="<?=$url?>img/cd-icon-delete.png" class="headerIcon" /></button>
        <?php if ($is_from_CKEditor || $is_selecting_image):?>
        <button class="headerBtn greenBtn" id="imgActionUse" onclick="#" class="imgActionP"><img src="<?=$url?>img/cd-icon-use.png" class="headerIcon"/> Sử dụng</button>
        <?php endif;?>
    </div><br/><br/>
    <img id="imageFSimg" src="#" style="#"/><br/>
</div>
    
<div id="background" class="background" onclick="$('#imageFullSreenClose').trigger('click');"></div>
<div id="background2" class="background" onclick="$('#uploadImgDiv').hide(); $('#background2').slideUp(250, 'swing');"></div>
<div id="background3" class="background" onclick="$('#settingsDiv').hide(); $('#background3').slideUp(250, 'swing');"></div>

<!--Noscript part if js is disabled-->
<noscript> <div class="noscript"> <div id="folderError" class="noscriptContainer popout"> <b>Thanks for choosing Image Uploader and Browser for CKEditor!</b><br><br>To use this plugin you need to <b>enable JavaScript</b> in your web browser. <a href="http://www.enable-javascript.com/" target="_blank">How to enable JavaScript in your browser (external link)</a><br><br>Check out the <a href="http://imageuploaderforckeditor.altervista.org/" target="_blank">Documentation</a> or the <a href="http://imageuploaderforckeditor.altervista.org/support/" target="_blank">Plugin FAQ</a> for more help. </div></div></noscript>

</body>
</html>
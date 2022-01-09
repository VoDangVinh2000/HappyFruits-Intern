var table_name = 'assessment';
$(document).ready(function(){
    $('input[type=radio],input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%' // optional
    });
    $('#assessment_date').datepicker({language: 'vn', autoclose: true});

    $('input[name="has_parked"]').on('ifChecked', function(event){
        $('.parking_fee_container').removeClass('hidden');
    });
    $('input[name="has_parked"]').on('ifUnchecked', function(event){
        $('.parking_fee_container').addClass('hidden');
    });

    
    $('#frmAssessment').submit(function(){
        if (!isValidForm('frmAssessment'))
            return false;
        var working_time = parseFloat($('input[name="working_time"]').val());
        if( working_time <= 0){
            alert("Vui lòng nhập số giờ làm việc lớn hơn 0.");
            $('input[name="working_time"]').focus();
            return false;
        }else if(working_time >= 14){
            alert("Vui lòng nhập số giờ làm việc nhỏ hơn 14.");
            $('input[name="working_time"]').focus();
            return false;
        }

        var overtime = parseFloat($('input[name="overtime"]').val());
        if(overtime >= 10){
            alert("Vui lòng nhập số giờ tăng ca nhỏ hơn 10.");
            $('input[name="overtime"]').focus();
            return false;
        }
        
        var params = $(this).serialize() + '&ajax=1';
        $("#frmAssessment #submit").attr('disabled', true);
        $("#frmAssessment #submit span").text('Đang lưu...');
        blockElement('#main-wrapper');
        $.post(postback_url, params, function(data){
            if (data.status == 'OK')
                window.location.href = base_url + URIs[table_name];
            else
            {
                $("#frmAssessment #submit").attr('disabled', false);
                $("#frmAssessment #submit span").text('Lưu');
                unblockElement('#main-wrapper');
                alert(data.message);
            }
        },"json");
        return false; 
    });
});
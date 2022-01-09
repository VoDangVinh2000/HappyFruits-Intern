$(document).ready(function(){
    if($("#contactFrm").length){
        var msgContact = '';
        $("#contactFrm").validate({
            messages: {
                email: {
                    required: translate("Vui lòng nhập địa chỉ email"),
                    email: translate("Vui lòng nhập địa chỉ email hợp lệ")
                },
                name: {
                    required: translate("Vui lòng nhập tên")
                },
                message:{
                    required: translate("Vui lòng nhập lời nhắn")
                }
            }
        });
        $("#contactFrm .btn-submit").click(function(){
            if (!$("#contactFrm").valid()){
                return false;
            }
            var params = $("#contactFrm").serialize();
            $("#contactFrm .btn-submit").attr('disabled', true);
            $("#contactFrm .btn-submit span").text(translte('Đang gửi...'));

            pushEvent('Send Contact Clicked', 'Send Contact', 'Send Contact');
            $.post(postback_url, params, function(data){
                showAlertError(translate(data.message));
                $("#contactFrm .btn-submit").attr('disabled', false);
                $("#contactFrm .btn-submit span").text(translte('Gửi'));
                if (data.status == 'OK'){
                    $("#contactFrm .form-control").val('');
                }
            },"json");
            return false;
        });
    }
    if($("#voucherRequestFrm").length){
        $("#voucherRequestFrm").validate({
            messages: {
                v_email: {
                    required: translate("Vui lòng nhập địa chỉ email"),
                    email: translate("Vui lòng nhập địa chỉ email hợp lệ")
                },
                v_name: {
                    required: translate("Vui lòng nhập tên")
                },
                v_mobile: {
                    required: translate("Vui lòng nhập số điện thoại")
                }
            }
        });
        $("#voucherRequestFrm .btn-submit").click(function(){
            if (!$("#voucherRequestFrm").valid()){
                return false;
            }
            var params = $("#voucherRequestFrm").serialize();
            $("#voucherRequestFrm .btn-submit").attr('disabled', true);
            $("#voucherRequestFrm .btn-submit span").text('Đang gửi...');

            pushEvent('Send Voucher Request Clicked', 'Send Request', 'Send Request');
            $.post(postback_url, params, function(data){
                showAlertError('<p style="font-size: 18px; line-height: 20px;">' + translate(data.message) + '</p>', null, 'bootbox-form-alert');
                $("#voucherRequestFrm .btn-submit").attr('disabled', false);
                $("#voucherRequestFrm .btn-submit span").text('Gửi');
                if (data.status == 'OK'){
                    $("#voucherRequestFrm .form-control").val('');
                }
            },"json");
            return false;
        });
    }

    if($("#fruitPackageFrm").length){
        $("#fruitPackageFrm select").select2({minimumResultsForSearch: Infinity});
        $("#fruitPackageFrm").validate({
            messages: {
                p_email: {
                    required: translate("Vui lòng nhập địa chỉ email"),
                    email: translate("Vui lòng nhập địa chỉ email hợp lệ")
                },
                p_name: {
                    required: translate("Vui lòng nhập tên")
                },
                p_mobile: {
                    required: translate("Vui lòng nhập số điện thoại")
                }
            }
        });
        $("#fruitPackageFrm .btn-submit").click(function(){
            if (!$("#fruitPackageFrm").valid()){
                return false;
            }
            var params = $("#fruitPackageFrm").serialize();
            $("#fruitPackageFrm .btn-submit").attr('disabled', true);
            $("#fruitPackageFrm .btn-submit span").text('Đang gửi...');

            pushEvent('Send Package Request Clicked', 'Send Request', 'Send Request');
            $.post(postback_url, params, function(data){
                showAlertError('<p style="font-size: 18px; line-height: 20px;">' + translate(data.message) + '</p>', null, 'bootbox-form-alert');
                $("#fruitPackageFrm .btn-submit").attr('disabled', false);
                $("#fruitPackageFrm .btn-submit span").text('Đặt hàng');
                if (data.status == 'OK'){
                    $("#fruitPackageFrm")[0].reset();
                    $("#fruitPackageFrm .form-control").val('');
                    $("#fruitPackageFrm select").trigger('change');
                }
            },"json");
            return false;
        });

        $('#fruitPackageFrm #p_package').change(function(){
            var pkg = $(this).val();
            if(pkg == ''){
                $('#fruitPackageFrm .package_info').addClass('hidden');
            }else if(typeof packages != 'undefined'){

                var dataPackage = JSON.parse(packages);
                for(var key in dataPackage[pkg]){
                    if(key == 'price')
                        $('#fruitPackageFrm .package_' + key).html(money_format(dataPackage[pkg][key]))
                    else
                        $('#fruitPackageFrm .package_' + key).html(dataPackage[pkg][key])
                }
                $('#fruitPackageFrm .package_info').removeClass('hidden');
            }
        });
    }

    if($("#companyRequestFrm").length){
        $("#companyRequestFrm").validate({
            messages: {
                v_email: {
                    required: translate("Vui lòng nhập địa chỉ email"),
                    email: translate("Vui lòng nhập địa chỉ email hợp lệ")
                },
                v_name: {
                    required: translate("Vui lòng nhập tên")
                },
                v_mobile: {
                    required: translate("Vui lòng nhập số điện thoại")
                },
                v_number_of_customer: {
                    required: translate("Vui lòng nhập số khách sử dụng")
                },
                v_budget: {
                    required: translate("Vui lòng nhập chi phí dự kiến")
                }
            }
        });
        $("#companyRequestFrm .btn-submit").click(function(){
            if (!$("#companyRequestFrm").valid()){
                return false;
            }
            var params = $("#companyRequestFrm").serialize();
            $("#companyRequestFrm .btn-submit").attr('disabled', true);
            $("#companyRequestFrm .btn-submit span").text('Đang gửi...');

            pushEvent('Send Company Request Clicked', 'Send Request', 'Send Request');
            $.post(postback_url, params, function(data){
                showAlertError('<p style="font-size: 18px; line-height: 20px;">' + translate(data.message) + '</p>', null, 'bootbox-form-alert');
                $("#companyRequestFrm .btn-submit").attr('disabled', false);
                $("#companyRequestFrm .btn-submit span").text('Gửi');
                if (data.status == 'OK'){
                    $("#companyRequestFrm .form-control").val('');
                }
            },"json");
            return false;
        });
    }
});
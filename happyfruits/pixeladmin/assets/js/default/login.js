$(document).ready(function(){
    if (typeof RSA != 'undefined'){
        var $key = RSA.getPublicKey($pem);
        function encrypt(value) {
            return RSA.encrypt(value + new Date().getTime(), $key);
        }
    }
    
    var msg = '';
    $("#loginFrm").validator();
    $("#loginFrm").submit(function(){
        if(!isValidForm('loginFrm'))
            return false;
        if (typeof encrypt != 'undefined'){
            var encrypted_pass = encrypt($("#loginFrm #password").val());
            $("#loginFrm #e-password").val(encrypted_pass);
        }
        $("#loginFrm #submit").attr('disabled', true);
        $("#loginFrm #submit span").text('Đang đăng nhập...');
        return true;
    });
});
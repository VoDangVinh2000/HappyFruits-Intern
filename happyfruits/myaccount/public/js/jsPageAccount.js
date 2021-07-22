$(document).ready(function(){
    //login and register page
    $('input[name=email]').css('border-bottom','2px solid black');
    $('input[name=username]').click(function(){
        $(this).css('border-bottom','2px solid black');
        $('input[name=phone]').css('border-bottom','1px solid darkgray');
        $('input[name=confirm-password]').css('border-bottom','1px solid darkgray');
        $('input[name=email]').css('border-bottom','1px solid darkgray');
        $('input[name=password]').css('border-bottom','1px solid darkgray');
    });
      $('input[name=email]').click(function(){
        $(this).css('border-bottom','2px solid black');
        $('input[name=phone]').css('border-bottom','1px solid darkgray');
        $('input[name=confirm-password]').css('border-bottom','1px solid darkgray');
        $('input[name=username]').css('border-bottom','1px solid darkgray');
        $('input[name=password]').css('border-bottom','1px solid darkgray');
    });
      $('input[name=password]').click(function(){
        $(this).css('border-bottom','2px solid black');
        $('input[name=phone]').css('border-bottom','1px solid darkgray');
        $('input[name=confirm-password]').css('border-bottom','1px solid darkgray');
        $('input[name=username]').css('border-bottom','1px solid darkgray');
        $('input[name=email]').css('border-bottom','1px solid darkgray');
    });
     $('input[name=confirm-password]').click(function(){
        $(this).css('border-bottom','2px solid black');
        $('input[name=phone]').css('border-bottom','1px solid darkgray');
        $('input[name=password]').css('border-bottom','1px solid darkgray');
        $('input[name=username]').css('border-bottom','1px solid darkgray');
        $('input[name=email]').css('border-bottom','1px solid darkgray');
    });
    $('input[name=phone]').click(function(){
        $(this).css('border-bottom','2px solid black');
        $('input[name=confirm-password]').css('border-bottom','1px solid darkgray');
        $('input[name=password]').css('border-bottom','1px solid darkgray');
        $('input[name=username]').css('border-bottom','1px solid darkgray');
        $('input[name=email]').css('border-bottom','1px solid darkgray');
    });

    $('a[id=forgotpassword]').click(function(){
          $('.form-account').css('display','none');
           $('.form-forgot').css('display','block');
    })
    $('a[id=cancel]').click(function(){
          $('.form-account').css('display','block');
          $('.form-forgot').css('display','none');
    });
    //account page
    
    //address page
    //click css input form add a address
    //click cancel button form address
    
     $('button[name=cancel-form-profile-edit]').click(function(){
        $('#form-profile-edit').hide();
    });
     $('#a-profileEdit').click(function(){
        if($('#form-profile-edit').css('display') == "none"){
            $('#form-profile-edit').css('display','block');
        }
        else{
              $('#form-profile-edit').css('display','none');
        }
    });
});

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
    $('input[name=firstname-address]').click(function(){
        $(this).css('border-bottom','1px solid black');
        $('input[name=lastname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=cityAddress]').css('border-bottom','1px solid darkgray');
        $('input[name=phoneAddress]').css('border-bottom','1px solid darkgray');
    });
    $('input[name=lastname-address]').click(function(){
        $(this).css('border-bottom','1px solid black');
        $('input[name=firstname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=cityAddress]').css('border-bottom','1px solid darkgray');
        $('input[name=phoneAddress]').css('border-bottom','1px solid darkgray');
    });
    $('input[name=cityAddress]').click(function(){
        $(this).css('border-bottom','1px solid black');
        $('input[name=firstname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=lastname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=phoneAddress]').css('border-bottom','1px solid darkgray');
    });
    $('input[name=phoneAddress]').click(function(){
        $(this).css('border-bottom','1px solid black');
        $('input[name=firstname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=lastname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=cityAddress]').css('border-bottom','1px solid darkgray');
        
    });
      $('input[name=companyAddress]').click(function(){
        $('input[name=firstname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=lastname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=cityAddress]').css('border-bottom','1px solid darkgray');
          $('input[name=phoneAddress]').css('border-bottom','1px solid darkgray');
    });
      $('input[name=address1]').click(function(){
        $('input[name=firstname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=lastname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=cityAddress]').css('border-bottom','1px solid darkgray');
          $('input[name=phoneAddress]').css('border-bottom','1px solid darkgray');
    });
     $('input[name=address2]').click(function(){
        $('input[name=firstname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=lastname-address]').css('border-bottom','1px solid darkgray');
        $('input[name=cityAddress]').css('border-bottom','1px solid darkgray');
          $('input[name=phoneAddress]').css('border-bottom','1px solid darkgray');
    });
    //click cancel button form address
    $('button[name=cancel-form-add-address]').click(function(){
        $('#form-add-address').hide();
    });
    
     $('button[name=cancel-form-edit-address]').click(function(){
        $('#form-edit-address').hide();
    });
    $('#a-addAddress').click(function(){
        if($('#form-add-address').css('display') == "none"){
            $('#form-add-address').css('display','block');
        }
        else{
              $('#form-add-address').css('display','none');
        }
    });
     $('#a-editAddress').click(function(){
        if($('#form-edit-address').css('display') == "none"){
            $('#form-edit-address').css('display','block');
        }
        else{
              $('#form-edit-address').css('display','none');
        }
    });
});

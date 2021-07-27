


window.addEventListener('DOMContentLoaded', (event) => {
        //js profile page 
        let allInputLogin = document.querySelectorAll('.input-account');
        let a_editProfile = document.querySelector('#a-editProfile');
        let form_edit_profile = document.getElementById('form-edit-profile');
        let a_forgot = document.querySelector('#forgotpassword');
        let form_forgot = document.querySelector('.form-forgot');
        let form_login = document.querySelector('.form-account');
        let a_cancelFormForgot = document.getElementById('cancelFormForgot');
        if(a_editProfile){
            a_editProfile.addEventListener('click',function(){
                if(form_edit_profile.style.display == "none"){
                    form_edit_profile.style.display = "block";
                }
                else{
                        form_edit_profile.style.display = "none";
                }
            });
        }
        else{

        }
        //event for input of form-login
        allInputLogin.forEach(element => {
            element.addEventListener('focus',function(){
                element.style.borderBottom = "1px solid black";
                allInputLogin.forEach(element2 => { 
                if(element.name != element2.name){
                    element2.style.borderBottom = "1px solid darkgray";
                }
            });
        });
       
        //event click for link a of form-login "forgot your password"
      
        if(a_forgot){
            a_forgot.addEventListener('click',function(){
            form_login.style.display = "none";
            form_forgot.style.display = "block";
            });
        }
        else{

        }
        if(a_cancelFormForgot){
            a_cancelFormForgot.addEventListener('click',function(){
            form_login.style.display = "block";
            form_forgot.style.display = "none";
            });
        }
        else{

        }
        $(document).ready(function(){
            $('input[name=username]').css('border-bottom','1px solid black');
        });
    });
});
 
 //cancel form edit profile
function cancelProfile(){
     let form_edit_profile = document.getElementById('form-edit-profile');
    form_edit_profile.style.display = "none";
}

//owl-carousel home page, trai cay dac san viet category
$(document).ready(function () {
      $('.owl-carousel').owlCarousel({
          autoplay:true,
          autoplayhoverpause:true,
          autoplaytimeout:200,
          items:4,
          nav:true,
          loop:true,
          responsive : {
                0 : {
                    items:1,
                    dots:false
                },
                480 : {
                    items:1,
                    dots:false
                },
                782 : {
                    items:2,
                    dots:false
                },
                960 : {
                    items:4,
                    dots:false
                },
                1200 : {
                     items:4,
                    dots:false
                }
          }
      });
});



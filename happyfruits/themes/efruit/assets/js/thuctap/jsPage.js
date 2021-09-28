window.addEventListener('DOMContentLoaded', (event) => {
    //js profile page 
    let allInputLogin = document.querySelectorAll('.input-account');
    let a_editProfile = document.querySelectorAll('#a-editProfile');
    let form_edit_profile = document.getElementById('form-edit-profile');
    let a_forgot = document.querySelectorAll('#forgotpassword');
    let form_forgot = document.querySelector('.form-forgot');
    let form_login = document.querySelector('.form-account');
    let a_cancelFormForgot = document.querySelectorAll('#cancelFormForgot');
    let form_change_password = document.querySelector('.form-change-password');
    let btn_change_password = document.querySelectorAll('#change-password');
    let btn_cancel_form_change_password = document.querySelectorAll('#cancel-change-password');
    let btnShowpopup = document.querySelector('#showPopup');
    let cartModal = document.querySelector('.cart-modal');
    
    if(btnShowpopup){
        btnShowpopup.addEventListener('click',function(){
            cartModal.style.display = "block";
        })
    }
    if (a_editProfile) {
        a_editProfile.forEach(element => {
            element.addEventListener('click', function () {
                if (form_edit_profile.style.display == "none") {
                    form_edit_profile.style.display = "block";
                } else {
                    form_edit_profile.style.display = "none";
                }
            });
        });
    } else {}
    //event for input of form-login
    allInputLogin.forEach(element => {
        element.addEventListener('focus', function() {
            element.style.borderBottom = "1px solid black";
            allInputLogin.forEach(element2 => {
                if (element.name != element2.name) {
                    element2.style.borderBottom = "1px solid darkgray";
                }
            });
        });
        //event click for link a of form-login "forgot your password"
        if (a_forgot) {
            a_forgot.forEach(element => {
                element.addEventListener('click', function () {
                    form_login.style.display = "none";
                    form_forgot.style.display = "block";
                });
            });
        } else {}
        if (a_cancelFormForgot) {
            a_cancelFormForgot.forEach(element => {
                element.addEventListener('click', function () {
                    form_login.style.display = "block";
                    form_forgot.style.display = "none";
                });
            });
        } else {}

        //display form change password
        if (btn_change_password) {
            btn_change_password.forEach(element => {
                element.addEventListener('click', function () {
                    form_login.style.display = "none";
                    form_change_password.style.display = "block";
                });
            });
        } else {}
        //hide form change password
        if (btn_cancel_form_change_password) {
            btn_cancel_form_change_password.forEach(element => {
                element.addEventListener('click', function () {
                    form_login.style.display = "block";
                    form_change_password.style.display = "none";
                });
            });
        } else {}
    });
        $(document).ready(function () {
            $('input[name=username]').css('border-bottom', '1px solid black');
        });
        //Hủy cookie cho thông báo của phần đăng ký và đăng nhập
        window.onload = (event) => {
           
            let allcookie = document.cookie;
            let cookiearray = allcookie.split(';');
            let str = "";
            let arr = [];
            for (var i = 0; i < cookiearray.length; i++) {
                str = cookiearray[i].trim().split('=');
                for (let j = 0; j < str.length; j++) { //j=0
                    arr.push(str[j]);
                }
            }
            for (let key = 0; key < arr.length; key++) {
                if (arr[key] == "error_username") {
                    setCookie(arr[key], '', 0);
                }
                if (arr[key] == "error_email") {
                    setCookie(arr[key], '', 0);
                }
                if (arr[key] == "error_username_password") {
                    setCookie(arr[key], '', 0);
                }
                if (arr[key] == "error_acount_does_not_exist") {
                    setCookie(arr[key], '', 0);
                }
                if (arr[key] == "error_email_edit"){
                    setCookie(arr[key], '', 0);
                }
                if(arr[key] == "send_mail_success"){
                    setCookie(arr[key], '', 0);
                }
                if(arr[key] == "change_password_success"){
                    setCookie(arr[key], '', 0);
                }

                if(arr[key] == "error_password"){
                    setCookie(arr[key], '', 0);
                }
            }
        };

    getPageScroll();
});


window.addEventListener('DOMContentLoaded', (event) => {
    const btnShowPass = document.querySelector('#btnShowPass');
    const password = document.querySelector('#password');
    if (btnShowPass) {
        btnShowPass.addEventListener("click", () => {
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
            });
        }
        else {
        }
});


function setCookie(cname, cvalue, exMins) {
    var d = new Date();
    d.setTime(d.getTime() + (exMins * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


//cancel form edit profile
function cancelProfile() {
    let form_edit_profile = document.getElementById('form-edit-profile');
    form_edit_profile.style.display = "none";
}

//get scroll page
function getPageScroll(){
    let nav_menu = document.querySelector('.scroll-nav-mobile');
    let logo_nav = document.querySelector('.logo-nav');
    let main_nav = document.querySelector('.main-nav');
    let widthScreen = window.screen.width;
    let offsetY = window.pageYOffset;
    console.log(widthScreen);
    if(widthScreen > 0 && widthScreen < 700){
        //If width of screen > 0 and  < 700 => css position nav 2 and nav 3
        if(offsetY > 200){
        //css nav_menu => nav 2
        nav_menu.style.position = "fixed";
        nav_menu.style.width = "100%";
        nav_menu.style.height = "auto";
        nav_menu.style.zIndex = "1000";
        nav_menu.style.top = "0";
        nav_menu.style.background = "#fff";
        nav_menu.style.border = "1px solid darkgray";
        nav_menu.style.transition = "0.3s all";
        //css logo-nav
        logo_nav.style.padding = "1em 0";
        logo_nav.style.overflow = "hidden";
        //css main-menu
        main_nav.style.position = "fixed";
        main_nav.style.width = "100%";
        main_nav.style.top = "56px";
        main_nav.style.zIndex = "9999";
        main_nav.style.padding = "0";
        main_nav.style.background = "#fff";
        main_nav.style.borderTop = "none";
        }
        else{
            //css nav_menu => nav 2
            nav_menu.style.position = "static";
            nav_menu.style.width = "100%";
            nav_menu.style.zIndex = "1000";
            nav_menu.style.top = "0";
            nav_menu.style.background = "none";
            nav_menu.style.border = "none";
              //css logo-nav
            logo_nav.style.padding = "3em 0";
            logo_nav.style.overflow = "initial";
             //css main-menu
            main_nav.style.position = "relative";
            main_nav.style.width = "100%";
            main_nav.style.top = "0";
            main_nav.style.zIndex = "initial";
            main_nav.style.padding = "initial";
            main_nav.style.borderTop = "initial"
        }
    }
    else{
        //if condition is wrong => return css to initial.
        //css nav_menu => nav 2
        nav_menu.style.position = "static";
        nav_menu.style.width = "100%";
        nav_menu.style.height = "auto";
        nav_menu.style.zIndex = "1";
        nav_menu.style.top = "0";
        nav_menu.style.background = "none";
        nav_menu.style.border = "none";
        //css logo-nav
        logo_nav.style.padding = "3em 0";
        logo_nav.style.overflow = "initial";
          //css main-menu
        main_nav.style.position = "relative";
        main_nav.style.width = "100%";
        main_nav.style.top = "0";
        main_nav.style.borderTop = "initial";
    }
    
}
//owl-carousel home page, trai cay dac san viet category
$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        autoplay: true,
        autoplayhoverpause: true,
        autoplaytimeout: 100,
        items: 4,
        nav: true,
        loop: true,
        lazyLoad: true,
        responsive: {
            0: {
                items: 2,
                dots: false
            },
            480: {
                items: 2,
                dots: false
            },
            782: {
                items: 2,
                dots: false
            },
            960: {
                items: 4,
                dots: false
            },
            1200: {
                items: 4,
                dots: false
            }
        }
    });
});
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
            }
        };
    });
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
                items: 1,
                dots: false
            },
            480: {
                items: 1,
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
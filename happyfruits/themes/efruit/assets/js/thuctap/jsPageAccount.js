//Chuyen sang javascript
//let = 
// let inputAll = document.querySelectorAll('.input-account');

window.addEventListener('DOMContentLoaded', (event) => {
        //event for input of form-login
        let allInputLogin = document.querySelectorAll('.input-account');
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
        let a_forgot = document.querySelector('#forgotpassword');
        let form_forgot = document.querySelector('.form-forgot');
        let form_login = document.querySelector('.form-account');
        let a_cancelFormForgot = document.getElementById('cancelFormForgot');
        if(a_forgot){
            a_forgot.addEventListener('click',function(){
            form_login.style.display = "none";
            form_forgot.style.display = "block";
            })
        }
        if(a_cancelFormForgot){
            a_cancelFormForgot.addEventListener('click',function(){
            form_login.style.display = "block";
            form_forgot.style.display = "none";
            })
        }
 });
});



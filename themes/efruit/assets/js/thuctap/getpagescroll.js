//get scroll page
function getPageScroll(){
  let nav_menu = document.querySelector('.scroll-nav-mobile');
  let logo_nav = document.querySelector('.logo-nav');
  let main_nav = document.querySelector('.main-nav');
  let widthScreen = window.screen.width;
  let offsetY = window.pageYOffset;
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
      main_nav.style.zIndex = 1000;
      main_nav.style.borderTop = "initial";
  }
  
}
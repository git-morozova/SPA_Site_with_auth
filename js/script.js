window.addEventListener('load',function(){
  document.getElementsByTagName('header')[0].addEventListener('click',function(){
    toggle_menu();
  });
});
window.addEventListener('scroll',function(){
  header_scroll();
  parallax('banner-wrapper-fixed',5,0);
});
function header_scroll(){
  var my_header = document.getElementsByTagName('header')[0];
  var scroll_height = window.pageYOffset;
  if(scroll_height > 400){
    my_header.className = 'header header-scroll';
  }
  else {
    my_header.className = 'header';
  }
}
function parallax(elem,speed,number){
  var target = document.getElementsByClassName(elem)[number];
  var scroll_value = window.pageYOffset;
  if(scroll_value <= 700){
    target.style.transform = 'translateY('+(-scroll_value/speed)+'px)';
  } 
  else {
    return;
  }
}

function toggle_menu(){
  var menu_bar = document.querySelector('.header ul');
  var btn = document.getElementsByClassName('toggle-btn')[0];
  //btn.innerHTML = '&times;';
  if(document.documentElement.clientWidth <= 768){
  //if(menu_bar.style.display == 'none'){
    if(menu_bar.className == 'display-none-mobile'){
      menu_bar.className = 'display-block';
      menu_bar.style.animation = 'flip 1 0.4s 0s';
      btn.innerHTML = '&times;';
      btn.style.fontSize = '40px';
      btn.style.animation = 'fade 1 0.2s 0s';
    }
    else if(menu_bar.className == 'display-block'){
     menu_bar.className = 'display-none-mobile';
      btn.innerHTML = '&#9776';
      btn.style.fontSize = '30px';
      btn.style.animation = 'top-in-basic 1 0.2s 0s';
    }
 }
}


/* Галерея */
var angle = 0;
function galleryspin(sign) { 
spinner = document.querySelector("#spinner");
if (!sign) { angle = angle + 45; } else { angle = angle - 45; }
spinner.setAttribute("style","-webkit-transform: rotateY("+ angle +"deg); -moz-transform: rotateY("+ angle +"deg); transform: rotateY("+ angle +"deg);");
}
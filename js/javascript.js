//Get the side menu
var sidemenu = document.getElementById("side-menu");


// When the user scrolls down 80px from the top of the document, side menu will stick
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    sidemenu.style.top = "20px";
    sidemenu.style.position = "fixed";
  } else {
    sidemenu.style.position = "static";
  }
}
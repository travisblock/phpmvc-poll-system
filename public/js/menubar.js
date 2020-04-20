// $(document).ready(function(){
//
// $('.menu-icon').on("click", function(){
//   $("nav ul").toggleClass("showing");
// });
// });


var menu = document.querySelector(".menu-icon");

menu.onclick = function(){
  var nav = document.querySelector('nav ul');
  nav.classList.toggle('showing');
};

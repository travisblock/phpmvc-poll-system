var element = document.getElementById("signinform");
var element2= document.getElementById("loginform");
var login   = document.getElementById("login");
var signin  = document.getElementById("signin");

document.getElementById("signin").onclick = function(){
  element.classList.remove("hide");
  element2.classList.add("hide");
  signin.classList.add('border');
  login.classList.remove("border");
};

document.getElementById("login").onclick = function(){
  element.classList.add("hide");
  element2.classList.remove("hide");
  login.classList.add("border");
  signin.classList.remove('border');

};

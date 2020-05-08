
/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

document.addEventListener("DOMContentLoaded", function(){

  var detail = document.getElementsByClassName("detailBtn");

  for (var i=0; i < detail.length; i++){
    detail[i].onclick = function(){

      var id  = this.getAttribute('data-id');
      var url = baseurl + '/polling/getPollingById';
      var xhr = new XMLHttpRequest();

      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
          document.getElementById("pollDetail").innerHTML = this.responseText;
        }
      };
      var data = {id:id};
      xhr.send(JSON.stringify(data));

    };
  };

  var menu = document.querySelector(".menu-icon");

  menu.onclick = function(){
    var nav = document.querySelector('nav ul');
    nav.classList.toggle('showing');
  };

});

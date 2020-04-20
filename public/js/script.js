
document.addEventListener("DOMContentLoaded", function(){

  // var xhr = new XMLHttpRequest();
  // var url = 'http://192.168.1.13:8081/polling/getPolling';
  //
  // xhr.onreadystatechange = function(){
  //   if(this.readyState == 4 && this.status == 200){
  //     document.getElementById("pollData").innerHTML = this.responseText;
  //   }
  // };
  //
  // xhr.open("get", url, true);
  // xhr.send();

  var detail = document.getElementsByClassName("detailBtn");

  for (var i=0; i < detail.length; i++){
    detail[i].onclick = function(){

      var id = this.getAttribute('data-id');
      var url = 'http://192.168.1.13:8081/polling/getPollingById';
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

      // $.ajax({
      //   url: 'http://192.168.1.13:8081/polling/getPollingById',
      //   data: {id : id},
      //   method: 'post',
      //   dataType: 'json',
      //   success: function(data){
      //     $('#pollDetail').html(data);
      //   }
      // });

    };
  };

});


  <div class="container-footer">
    <div class="footer-isi">
      Made with love by <a href="https://github.com/ajid2/phpmvc-poll-system" target="_blank">Ajid Stark</a>
    </div>
  </div>
</div>

<script type="text/javascript">

function collapseMenu(collapse){
  if(collapse.matches){
    wrapper.classList.toggle('collapse');
  }else {
    wrapper.classList.remove('collapse');
  }
}

var menu = document.querySelector(".list-menu");
var wrapper = document.querySelector('.wrapper');
menu.onclick = function(){
  wrapper.classList.toggle('collapse');
};

var collapse = window.matchMedia("(max-width: 780px)")
collapseMenu(collapse)
collapse.addListener(collapseMenu)

var paths = window.location.href;
var path  = paths.split("/", 5);

Array.from(document.querySelectorAll(".sidebar a")).forEach(function(itm){
  var items = itm.getAttribute('href');
  var item = items.split("/", 5);

  if(item[4] == path[4]){
    itm.classList.add('active');
  }

});


function validasiFile(){
  var output     = document.getElementById('preview');
  var namaUpload = document.getElementById('namaUpload');
  var namaFile   = event.target.files[0]['name'];
  var inputfile  = document.querySelector('.inputfile');

  var inputFile = document.getElementById('file');
  var pathFile = inputFile.value;
  var ekstensiOk = /(\.jpg|\.png|\.jpeg)$/i;
  if(!ekstensiOk.exec(pathFile)){
    alert('Gambar Harus png , jpg , atau jpeg');
    inputFile.value = '';
    namaUpload.innerHTML = "Upload File";
    inputfile.classList.remove('focus');
    output.remove();
    return false;
  }else{
    output.src = URL.createObjectURL(event.target.files[0]);
    output.classList.add('preview');
    namaUpload.innerHTML = namaFile;
    inputfile.classList.add('focus');
  }
}

function uploadXls(){
  var inputFile  = document.getElementById('file');
  var pathFile   = inputFile.value;
  var namaUpload = document.getElementById('namaUpload');
  var namaFile   = event.target.files[0]['name'];
  var txt1       = document.getElementById("text1");
  var txt2       = document.getElementById("text2");
  var output     = document.querySelector("#preview");
  var form       = document.querySelector("#inputForm");
  var fileInput  = document.querySelector("#file");
  var file       = fileInput.files[0];

  var ekstensiOk = /(\.xls|\.xlsx|\.csv)$/i;
  if(!ekstensiOk.exec(pathFile)){
    alert('File harus xls atau xlsx');
    inputFile.value = '';
    return false;
  }else{

    txt1.style.display = "none";
    txt2.style.display = "none";
    namaUpload.innerHTML = namaFile;

    var data = new FormData();
    data.append('file', file);
    var url = 'http://192.168.1.13:8081/admin/preview';
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url,true);
    xhr.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        output.innerHTML = this.responseText;
      }
    }
    xhr.send(data);
  }
}

window.setTimeout(function(){
  var msg = document.getElementById('msg');
  if(msg !== null)
    msg.classList.toggle('hide');
}, 3000);

window.setTimeout(function(){
  var msg = document.getElementById('msg');
  if(msg !== null)
    msg.remove();
}, 4000);





function checkAll(){
  var btnCheckHapus = document.querySelector("#btnCheckHapus");
  var ele = document.querySelectorAll("#checkHapus");
  for(var i=0;i<ele.length;i++){

    if(btnCheckHapus.checked == true){
      ele[i].checked = true;
    }else{
      ele[i].checked = false;
    }
  }
}

</script>
</body>
</html>

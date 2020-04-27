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
var output=document.getElementById('preview');
output.src=URL.createObjectURL(event.target.files[0]);
output.classList.add('preview');

var inputFile = document.getElementById('file');
var pathFile = inputFile.value;
var ekstensiOk = /(\.jpg|\.png|\.jpeg)$/i;
if(!ekstensiOk.exec(pathFile)){
alert('Gambar Harus png , jpg , atau jpeg');
  inputFile.value = '';
  return false;
  }
}

</script>
</body>
</html>

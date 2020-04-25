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

var path = window.location.href;

Array.from(document.querySelectorAll(".sidebar a")).forEach(function(itm){
  var items = itm.getAttribute('href');
  console.log(items);
  if(items == path){
    itm.classList.add('active');
  }
});
</script>
</body>
</html>

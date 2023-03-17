
  <div class="d-none">
       <p>La sessión espira en:&nbsp</p><p id="number" class="text-danger"></p>
  </div>

<script type="text/javascript">
 n=900;
 var l=document.getElementById('number');
 var id=window.setInterval(function(){
  document.onmousemove=function(){
    n=900
  };
  l.innerText=n;
  n--;
  if (n == -2) {
    location.href='?url=inactividad';
  }
 },1200);
</script>
         
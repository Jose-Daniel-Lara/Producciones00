<?php 
session_start();
session_destroy();

die("<script>location='?url=usuario'</script>");

 ?>
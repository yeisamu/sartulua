<?php
session_start();
?>
<div class="login1">Auxiliar: [<?php echo $_SESSION['loginaux'];  ?>]</div>
<div id="cerrars"></div>
<a href="#" onclick="cambia_aux('cerrars')" >Cambiar Aux</a>  
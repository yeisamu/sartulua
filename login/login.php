<?php
error_reporting(0);
require_once("logoutChecker.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            @import url("admincss/login.css");
        </style>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/loginjs.js"></script>
        
      <title>Entrada al sistema</title>
    </head>
    <body onload="javascript:document.getElementById('username').focus();">
    <div class="loadingAnim"><img src="images/loading.gif" style="border:none; outline:none" /></div>
    <div id="message"></div>
        <div id="LoginWrapper">
        <?php 
			$tm = time();
		?>
        <form name="LoginForm<?php echo $tm; ?>" method="post" id="loginForm" action="#" autocomplete="off">
            <table width="450" cellpadding="5" cellspacing="0" border="0" id="loginTbl">
                <tr>
                    <th colspan="2">SART</th>
                </tr>
                <tr>
                    <td class="label" width="120"><span class="username">Usuario</span></td>
                    <td class="field"><input type="text" name="uname4Login"  class="inputFiled" id="username" value="" /></td>
                </tr>
                <tr>
                     <td class="label"><span class="password">Password</span></td>
                     <td class="field"><input type="password" name="pass4Login" class="inputFiled" id="password" value="" autocomplete="off" /></td>
                </tr>
                <tr>
                    <td colspan="2" ><input type="submit" name="login" value="Entrar" class="loginBtn" /><!--<span style="float:right; margin-right:10px;"> --><input type="reset" name="login" value="Cancelar" class="loginBtn" /><!--</span> --></td>
               </tr>
            </table>
        </form>
        </div>
       <!-- <div id="copyRight" align="center">Plugin Developed By <a href="http://www.visitharish.com" target="_blank">Harish Chandra Kharel</a><br />
        </div> -->
    </body>
</html>

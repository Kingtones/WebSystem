<html>
<style type="text/css">
div.button{position:absolute;right:10px;top: 60px}
div.reg_form{position: absolute;right:200px;top:20px}
div.button2{position: absolute;right:120px;top:25px}
div.button3{position: absolute;right:120px;top:55px}
</style>
<center>
		<h2>Chat At Will</h2>
		<div class="reg_form">

		<form id="form" method="POST">
			<table width="40"border="0"cellpadding="0">
				<tr>
					<td  >username:</td>
					<td><input type="text" name="username" placeholder="username"></t>
				</tr>
				<tr>
					<td  >password:</td>
					<td><input type="password"name="password" placeholder="password"></t>
				</tr>

					
			</table>
			<div class="button">
			<input type="submit"name="submit"value="登陆"/>
			<input name="checkbox" type="checkbox" value="checkbox" checked="checked" />自动登陆
			
		</div>
		</form>
	</div>
	
	<?php
	echo "<div class = button2>";

	 echo anchor('Caw_member/index','用户注册','title="注册用户"');
	 echo "</div>";
	 
	 
	 echo "<div class = button3>";

	 echo anchor('Caw_index/index','忘记密码','title="忘记密码"');
	 echo "</div>";
	 ?>
</div>

</center>
<center>
	

	<hr  width="90%" style="position:absolute;top:110px">

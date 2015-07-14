
<style type="text/css">
div.user_info2{position:absolute;right:200px;top: 20px}
div.user_info3{position: absolute;right:240px;top:40px}
div.user_info4{position: absolute;right:210px;top:60px}
div.user_info5{position: absolute;right:200px;top:40px}
h2{
	position: relative;
	top:10px;

}

</style>

	<center>
		<h2>Chat At Will</h2>

			
			<?php
			
			echo "<div class=user_info2>";
			echo "<strong>";
			echo anchor("userspace/index/$userid",$username);
			
			echo "</strong>";
			echo "</div></br>";
			echo "<div class=user_info5>";
			
			echo anchor("$url",'退出','');
			
			
			
			echo "</div></br>";
			echo "<div class=user_info3>";
			echo anchor('Message','消息','');
			echo "</br></div>";
			echo "<div class=user_info4>";
			echo anchor('Password/motify','修改密码','');
			echo "<div>";
			?>
		


		</center>
		<center>
			<hr  width="90%" style="position:absolute;top:110px">
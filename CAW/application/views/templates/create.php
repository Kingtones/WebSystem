<style>
div.a{position:relative;top:200px;}
textarea{
	resize: none;
	width: 500px;
	height: 200px;
}
input.title{
	width: 500px;
	height: 30px;
}
input{
	width: 60px;
}
</style>
<div class=a>
<form width = "800" action="<?php  echo site_url("$con/create");?>"method="post">
			<table width="400"border="0">
				<tr>
					<td >标题:</td>
					<td><input  class="title" type="text"name="title"></td>
				</tr>
				<tr>
					<td>内容:</td>
					<td><textarea name="content"rows="5"cols="30"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"align="center">
						<input type="submit" name="submit"value="提交"/>
						<input type="reset" value="重置">
				</tr>
			</table>
		</from>
	</div>
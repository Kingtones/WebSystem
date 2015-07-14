<style>
div.a{position:relative;top:400px;}
textarea{
	resize: none;
	width: 500px;
}
</style>
<div class="a">
<form id="comment" width = "800" action=" <?php echo base_url();?>index.php/<?php echo $url;?>
	/show/<?php echo $article_id;?>" method="post">
			<table width="600"border="0">
				
				<tr>
					<td>评论:</td>
					<td><textarea name="content"rows="5"cols="30"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"align="center">
						<input type="submit" name="submit"value="提交"/>
						<input type="hidden" value="<?php echo $parentid;?>" name="pid">
						<input type="reset" value="重置">
				</tr>
			</table>
		</from>
	</div>
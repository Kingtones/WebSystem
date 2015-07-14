<style>
div.page{
	position: relative;
	top: 150px;
	font-size: 30px;
}
</style>
<center>
	<?php
echo"<div class=page>";
	echo"<br/><br/>";
	echo "当前{$page}/{$pages}页，共{$total}条";
	
	echo anchor("$url",'首页');
	echo "||";
	if($page<2){
	echo anchor("$url",'上一页');
}
else {
	$url2=$url."/".($page-1);
	echo anchor("$url2",'上一页');
}
	echo"||";
	if($page>$pages-1){
	$url3=$url."/".$pages;
	echo anchor("$url3",'下一页');
}
else{
	$url4=$url."/".($page+1);
	echo anchor("$url4",'下一页');

}
	echo "||";

	$url5=$url."/".$pages;
	echo anchor("$url5",'末页');


	echo "</div>";
	?>
</center>
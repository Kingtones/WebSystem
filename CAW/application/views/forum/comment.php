<style>
div.fenye{
	position: relative;
	top:220px;
	font-size: 30px;
}
</style>
<?php
for($i=0;$i<$num;$i++){

	echo "<ul>";
echo"
<div class=\"img\" id=\"text$i\">";


echo "<a href=\"".base_url()."index.php/userspace/index/$com_id[$i]\">";
echo  "<img src=\"".base_url().
"/images/user-icon.png\" HEIGHT=\"100\" 
WIDTH=\"100\"/></a>";
 

echo "<div class=\"button\">";
echo "<font style=\"FONT-SIZE:20px\">".
anchor("userspace/index/author_id",$com_name[$i])."</font></br>";
echo"<br>";
echo anchor("userspace/care/$com_id[$i]",
	'<button>关注 </button>')."&nbsp;&nbsp;";

 echo anchor("message/send/$com_id[$i]",'<button>私信 </button>');
 
 echo "<br>";
  echo "<div class=\"content\">";
  echo $com_body[$i];
  echo "<form action =\"".base_url().
  "index.php/forum/show/$article_id/#comment\" method=\"POST\">" ;
  echo "<input type=\"hidden\" value=\"$id[$i]\" name=\"parentid\">";
  
 echo " <input type=\"submit\" name=\"submit\"value=\"回复\"/>";
 echo "</form>";
  
  
echo "</div>";
 echo "</div>";


echo "
</div>
</ul>";









	echo "</ul>";
}

?>

<?php

echo"<div class=fenye>";
	echo"<br/><br/>";
	echo "当前{$page}/{$pages}页，共{$total}条";
	
	echo anchor("forum/show/$article_id/1",'首页');
	echo "||";
	if($page<2){
		
	echo anchor("forum/show/$article_id/1",'上一页');
}
else {
	$page2=$page-1;
	
	echo anchor("forum/show/$article_id/$page2",'上一页');
}
	echo"||";
	if($page>$pages-1){
	
	echo anchor("forum/show/$article_id/$pages",'下一页');
}
else{
	$page3=$page+1;
	echo anchor("forum/show/$article_id/$page3",'下一页');

}
	echo "||";

	
	echo anchor("forum/show/$article_id/$pages",'末页');


	echo "</div>";
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<META http-equiv=Content-Type content="text/html; charset=utf8">


 
<style type="text/css">

<!--
*{padding:0; margin:0}
img{border:0; display:block;}
BODY {
PADDING-RIGHT: 300px; PADDING-LEFT: 0px; FONT-SIZE: 20px; PADDING-BOTTOM: 0px; MARGIN: 0px auto; COLOR: black; LINE-HEIGHT: 150%; PADDING-TOP: 150px; BACKGROUND-COLOR: white; TEXT-ALIGN: center
}
div.user{
	position: absolute;
	top:200px;
	right: 200px;
}
div.img{
	position: relative;
	top: 30px;
}
h2{
	position: absolute;
	left: 600px;
	top: 20px;
}
 
.dis {
DISPLAY: block
}
.undis {
DISPLAY: none
}
#cntR {
WIDTH: 600px
}
#NewsTop {
CLEAR: both; MARGIN-BOTTOM: 16px
}
#NewsTop P {
FLOAT: left; LINE-HEIGHT: 30px
}
#NewsTop P.topTit {
FONT-WEIGHT: bold; WIDTH: 107px
}
#NewsTop P.topC0 {
BACKGROUND: #dcdcdc; BORDER-LEFT: #f2f2f2 1px solid; WIDTH: 100px; CURSOR: pointer;
}
#NewsTop P.topC1 {
BACKGROUND: #c2130e; BORDER-LEFT: #f2f2f2 1px solid; WIDTH: 100px; COLOR: #fff;
}
#NewsTop #NewsTop_tit {
BORDER-BOTTOM: #c2130e 3px solid; HEIGHT: 21px; 
}
#NewsTop #NewsTop_cnt {
PADDING-LEFT: 32px; BACKGROUND: url(http://www.popuni.com/attachments/month_0703/o2007320133249.gif) no-repeat 12px 13px; LINE-HEIGHT: 26px; PADDING-TOP: 7px; HEIGHT: 260px; TEXT-ALIGN: left
}
#NewsTop #NewsTop_cnt A {
COLOR: #666; TEXT-DECORATION: none
}
#NewsTop #NewsTop_cnt A:hover {
COLOR: #c2130e; TEXT-DECORATION: underline
}
-->
</style>
</HEAD>
<BODY>



<DIV id="cntR">
<DIV id="NewsTop">
<DIV id="NewsTop_tit">
<p class="topTit" >个人信息</P>
<p class="topC0" ><?php echo anchor("userspace/index/$userid/article/1",'帖子列表');?></P>
<p class="topC0" ><?php echo anchor("userspace/index/$userid/reply/1",'回复列表');?></P>
<p class="topC0" ><?php echo anchor("userspace/index/$userid/friend/1",'关注列表');?></P>
<p class="topC0" ><?php echo anchor("userspace/index/$userid/anonymity/1",'已发匿名');?></P>

</DIV>
<DIV id="NewsTop_cnt">
	<SPAN>
<?php 
if($flag=="article"){
	echo "<BR>";
	for($i=0;$i<$num;$i++){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
		echo "<font style=\"FONT-SIZE:30px\">";
			if(strlen($title[$i])>15){
			$title[$i]=mb_substr($title[$i],0,8)."...";
		}
			$len=strlen($title[$i]);
			
		echo anchor("forum/show/$articleid[$i]",$title[$i]);
		echo "</font>";
		
		for($a=$len;$a<20;$a++){
			echo "&nbsp;";

		}


		echo "<font style=\"FONT-SIZE:3px\">".$author[$i]."</font>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
		echo "<font style=\"FONT-SIZE:2px\">".$time[$i]."</font>";
		echo "<BR>";

	}
	echo "<BR>";
	echo "当前{$page}/{$pages}页，共{$total}条";
	
	echo anchor("userspace/index/$userid/$flag/1",'首页');
	echo "||";
	if($page<2){
	echo anchor("userspace/index/$userid/$flag/1",'上一页');
}
else {
	$page2=$page-1;
	echo anchor("userspace/index/$userid/$flag/$page2",'上一页');
}
	echo"||";
	if($page>$pages-1){
	echo anchor("userspace/index/$userid/$flag/$pages",'下一页');
}
else{
	$page3=$page+1;
	echo anchor("userspace/index/$userid/$flag/$page3",'下一页');

}
	echo "||";

	
	echo anchor("userspace/index/$userid/$flag/$pages",'末页');


}
elseif($flag=="anonymity"){
	echo "<BR>";
	for($i=0;$i<$num;$i++){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
		echo "<font style=\"FONT-SIZE:30px\">";
			if(strlen($title[$i])>15){
			$title[$i]=mb_substr($title[$i],0,8)."...";
		}
			$len=strlen($title[$i]);
			
		echo anchor("forum/show/$articleid[$i]",$title[$i]);
		echo "</font>";
		for($a=$len;$a<20;$a++){
			echo "&nbsp;";

		}


		echo "<font style=\"FONT-SIZE:3px\">".$anonymous[$i]."</font>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<font style=\"FONT-SIZE:2px\">".$time[$i]."</font>";
		echo "<BR>";

	}
	echo "<BR>";
	echo "当前{$page}/{$pages}页，共{$total}条";
	
	echo anchor("userspace/index/$userid/$flag/1",'首页');
	echo "||";
	if($page<2){
	echo anchor("userspace/index/$userid/$flag/1",'上一页');
}
else {
	$page2=$page-1;
	echo anchor("userspace/index/$userid/$flag/$page2",'上一页');
}
	echo"||";
	if($page>$pages-1){
	echo anchor("userspace/index/$userid/$flag/$pages",'下一页');
}
else{
	$page3=$page+1;
	echo anchor("userspace/index/$userid/$flag/$page3",'下一页');

}
	echo "||";

	
	echo anchor("userspace/index/$userid/$flag/$pages",'末页');

}
elseif($flag=="friend"){
	echo "<BR>";
	for($i=0;$i<$num;$i++){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
		echo "<font style=\"FONT-SIZE:30px\">";
		
			
		echo anchor("userspace/index/$friendid[$i]",$friendname[$i]);
		echo "</font>";
		for($a=$len;$a<20;$a++){
			echo "&nbsp;";

		}


		
		echo "<font style=\"FONT-SIZE:2px\">".$time[$i]."</font>";
		echo "<BR>";

	}
	echo "<BR>";
	echo "当前{$page}/{$pages}页，共{$total}条";
	
	echo anchor("userspace/index/$userid/$flag/1",'首页');
	echo "||";
	if($page<2){
	echo anchor("userspace/index/$userid/$flag/1",'上一页');
}
else {
	$page2=$page-1;
	echo anchor("userspace/index/$userid/$flag/$page2",'上一页');
}
	echo"||";
	if($page>$pages-1){
	echo anchor("userspace/index/$userid/$flag/$pages",'下一页');
}
else{
	$page3=$page+1;
	echo anchor("userspace/index/$userid/$flag/$page3",'下一页');

}
	echo "||";

	
	echo anchor("userspace/index/$userid/$flag/$pages",'末页');


}

?>

</SPAN>


</DIV>
<DIV class="user">
	<div class="img">
<?php echo "<img src=\"".base_url()."/images/user-icon.png\" HEIGHT=\"200\" WIDTH=\"200\"/>";
echo "</div>";
	  echo "<br><font style=\"FONT-SIZE:10px\">用户名：<button>$user</button></font></br>";
	  echo "<a href =\"".base_url()."index.php/userspace/change/$userid\"><br><font style=\"FONT-SIZE:10px\">匿名：<button>$anonymity</button>
	  </font></br>";
?>


</DIV>






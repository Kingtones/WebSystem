<!DOCTYPE html>
<style>
div.img{
	position: relative;
	right:0px;
	top:200px;
	border: 1px solid #000;
	width: 400px;
	margin:0 auto;
	padding-right:500px;
	background-color: #00AEAE;



}
div.title{
	position: relative;
	top: 120px;
	width: 800px;
	background-color: #00AEAE;
	
}
div.time{
	position: relative;
	left: 150px;
}
div.lead{
	position: relative;
	text-align: left;
	
	width: 500px;
	background-color: #B15BFF;
	top: 100px;
	font-size: 25px;
	font-color:	#E0E0E0;
	right: 180px
}
div.content{

	text-align: left;
	
	position: relative;
	left: 300px;
	bottom:150px;
	padding-top: 10px;
	margin: 0px auto;
	border: px solid #000;
	height: 80px;
	font-size: 20px;
}
<div class="content2">
</style>
<div  class="lead">
	<?php echo anchor("anonymous/index","匿名聊天");?>=><?php echo $title; ?>
</div>
<div class="title">
<h3><font SIZE="20px" color="#00AEAE"><?php echo $title;?></font></h3>
<div class="time">
<h4><?php echo $time;?></h4>
</div>
</div>



<ul>
<div class="img" >

	
<?php echo  "<img src=\"".base_url().
"/images/user-icon.png\" HEIGHT=\"100\" 
WIDTH=\"100\"/>";?>
</a>
<?php 
 

echo "<div class=\"button\">";
echo "<font style=\"FONT-SIZE:20px\">".
$author."</font></br>";
echo"<br>";

 echo anchor("message/send/$author_id",'<button>私信 </button>');
 
 echo "<br>";
  echo "<div class=\"content\">";
  
 echo $body;
echo "</div>";
 echo "</div>";


?>
</div>
</ul>
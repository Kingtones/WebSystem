<?php
$top=(140-$log*30);

echo "
<style type=\"text/css\">
div.big{}

div.more{position: absolute;left:260px;top:{$top}px}
div.show{position:relative;clear}

a{color:#069;}
dl{ position:absolute;top: {$top}px;left:80px; width:160px;border:dashed 1px #666; font-size:20px; padding:40px; background:#FDFBDB;}
dt{clear:left; float:left; padding:2px 0;}
dd{ text-align:right;  padding:8px 0;font-size:12px; color:#666;}
</style>
";?>
<div class=show>
	<?php
	 echo "<div  class=big>";
	
	
	echo "<table>";
	echo "<div class =more>";
	echo anchor("anonymous/index",'匿名热帖');
	
	echo "</table></div>";

	echo "<dl>";

	for($i=0;$i<10;$i++){
		

		echo "<dt>";
		
		echo "<font style=\"font-size:5px\">";
		
		echo anchor("anonymous/show/$articleid[$i]",$title[$i]);
		echo "</font>";
		
		//echo "<dt>";
		//echo anchor('Anonymous/show/'.$data[i]['article_id'],substr($data[i][title], 0,21),'')."</dt>";		
		echo "</dt>";
		
		echo "<dd>";
		echo "$author[$i]";
		echo "</dd>";
		//echo "<dd>$data[i]['author']"<dd>;
		
		
	}
	echo "</dl>";


	?>


</div>
</div>





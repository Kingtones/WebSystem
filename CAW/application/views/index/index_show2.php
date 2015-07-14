<?php 
$top=(140-$log*30);
echo "
<style type=\"text/css\">
div.big{}


div.show{position:relative;clear}

a{color:#069;}
dt{clear:left; float:left; padding:2px 0;}
dd{ text-align:right;  padding:8px 0;font-size:12px; color:#666;}

div.more2{position: absolute;left:550px;top:{$top}px}
dl2{ position:absolute;top: 220px;left:380px; width:160px;border:dashed 1px #666; font-size:20px; padding:40px; background:#FDFBDB;}

</style>";
?>
<div class=show>

	
	<?php

	
	
	echo "<table>";
	echo "<div class =more2>";
	echo anchor('anonymous/index','最新匿名');
	echo "</table></div>";

	echo "<dl2>";

	for($i=0;$i<10;$i++){
		

		echo "<dt>";
		echo "<font style=\"font-size:5px\">";
		
		echo anchor("anonymous/show/$articleid[$i]",$title[$i]);
		echo "</font>";
		echo "</dt>";
		//echo "<dt>".anchor('Anonymous/show/'.$data[i]['article_id'],substr($data[i][title], 0,21),'')."</dt>";		
		
		
		echo "<dd>";
		echo "$author[$i]";
		echo "</dd>";
		//echo "<dd>$data[i]['author']"<dd>;
		
		
	}
	echo "</dl2>";


	?>
</div>
</div>
</div>



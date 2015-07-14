<?php
$top=(140-$log*30);
echo "
<style type=\"text/css\">
div.big{}


div.show{position:relative;clear}

a{color:#069;}

dd{ text-align:right;  padding:8px 0;font-size:12px; color:#666;}

div.more4{position: absolute;left:1150px;top:{$top}px}
dl4{ position:absolute;top: 220px;left:980px; width:160px;border:dashed 1px #666; font-size:20px; padding:40px; background:#FDFBDB;}

</style>";
?>

<div class=show>

	
	<?php

	
	
	echo "<table>";
	echo "<div class =more4>";
	echo anchor('forum/index','最新发表');
	echo "</table></div>";

	echo "<dl4>";

	for($i=0;$i<10;$i++){
		

		echo "<dt>";
		echo "<font style=\"font-size:5px\">";
		echo anchor("forum/show/$articleid[$i]",$title[$i]);
		echo "</font>";
		echo "</dt>";
		
		
		echo "<dd>";
		echo "$author[$i]";
		echo "</dd>";
		
		
		
	}
	echo "</dl4>";


	?>
</div>
</div>
</div>






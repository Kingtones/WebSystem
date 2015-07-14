<?php
$top=(140-$log*30);
echo "
<style type=\"text/css\">
div.big{}


div.show{position:relative;clear}

a{color:#069;}

dt{clear:left; float:left; padding:2px 0;}
dd{ text-align:right;  padding:8px 0;font-size:12px; color:#666;}

div.more3{position: absolute;left:850px;top:{$top}px}
dl3{ position:absolute;top: 220px;left:680px; width:160px;border:dashed 1px #666; font-size:20px; padding:40px; background:#FDFBDB;}


</style>
";
?>

<div class=show>

	<?php

	
	
	echo "<table>";
	echo "<div class =more3>";
	echo anchor('forum/index','日常热帖');
	echo "</table></div>";

	echo "<dl3>";

	for($i=0;$i<10;$i++){
		

		echo "<dt>";
		echo "<font style=\"font-size:5px\">";
		
		echo anchor("forum/show/$articleid[$i]",$title[$i]);
		echo "</font>";
		echo "</dt>";
		
		
		echo "<dd>";
		
		echo "$author[$i]";

		echo "</dd>";
		//echo "<dd>$data[i]['author']"<dd>;
		
		
	}
	echo "</dl3>";
	


	?>

	
</div>
</div>
</div>







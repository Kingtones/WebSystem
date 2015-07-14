<?php
$top=560-$log*30;
echo "
<style type=\"text/css\">
div.footer{position:relative;top:{$top};}


</style>
";?>


<div class=footer>

<strong>&copy;<?php date_default_timezone_set('PRC');
 echo date('Y-m-d H:i:s',time())."<br/>WebE_Homwork</br>";?> 版权@CodeIgniter2015</strong>  
</div>
</body>
</html>
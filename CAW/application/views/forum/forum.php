
<style>
a{
  text-decoration: none;
}


table.change{
  position: relative;
  top:160;
  background-color:#FFE6FF;
}
table.change:hover
{
background-color:#E0E0E0
}
a:hover{
background-color:red
}
</style>

<table class="change"id="aa" width="1000" align="center" height="40"  border="0"style="border:1px solid #000000;">
  
  
  <tr align="center" valign="bottom">
    <td width="750"  rowspan="2"><div align="left"><font size="4px"><?php echo ($id+1);?>&nbsp;&nbsp;
        <?php echo anchor ("forum/show/$article_id",$title);?>&nbsp; &nbsp; &nbsp; </font> <font size="3px">   
        <a href="http://第二页的地址/">2</a>  
        <a href="http://第三页的地址/">3</a>
        <a href="http://第四页的地址/">4</a>
    <a href="http://第五页的地址/">5</a>&nbsp;</font></div></td>
    
  <font size="1px">
    <td width="150"    align="left"><font style="font-size:1px">作者：</font>
<?php echo anchor ("userspace/index/$user_id",$author);?></a></td>
    <td width="80" ><?php echo $com_total;?></td>
    <td width="150" > <?php echo anchor("userspace/index/$com_id",$com_user);?></td></font>
  </tr>
   
  <tr align="center" valign="bottom"  >
    <td height="16"  > <font style="font-size:1px"><?php echo $time;?></font></td>
    <td></td>
    <td><font style="font-size:12px"><?php echo $com_time;?></font></td></font>
  </tr>
</table>



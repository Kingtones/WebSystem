<script language="javascript">
 


function highlightPage(){         //这个函数作用是判断当前点击的URL，以便高亮显示相应的导航栏

 if(!document.getElementsByTagName) return false;  

 if(!document.getElementById) return false;  

   if(!document.getElementById("navigation")) return false;  

   var nav=document.getElementById("navigation");  

   var links=nav.getElementsByTagName("a");  

   for(var i=0; i<links.length; i++) {  

     var linkurl=links[i].getAttribute("href");  

    var currenturl=window.location.href;  

     if (currenturl.indexOf(linkurl)!=-1) {  

       links[i].className="here";  

       var linktext=links[i].lastChild.nodeValue.toLowerCase();  

       document.body.setAttribute("id",linktext);  

    }  

   }  

 } 
window.onload=highlightPage;     //执行上面的函数
</script>
<style>

 #navigation a.here:link,
 #navigation a.here:visited,
 #navigation a.here:hover,
 #navigation a.here:active {
  
 line-height: 20px;
 background-color:#BBFFFF; 

 color: #8600FF;
 text-decoration: none;

 letter-spacing: 0px;
 display: block;  
     }


.nav ul{
position: absolute;
top: 130px;
width:1130px;
margin:0px auto;
height:45px;
padding:0;
}
.nav ul li{
float:right;
}
.nav ul li a{
width:280px;
height:45px;
line-height:40px;
background:#00AEAE;
color:#FFF;
margin:5px 10px;
font-size:30px;
display:block;
text-align:center;
text-decoration:none;
}
.nav ul li a:hover{
width:280px;
height:45px;
line-height:42px;
border:1px solid red;
color:red;
background:#FFF;
}

</style>

<div class="nav">
 <ul id="navigation">
   <li><?php echo anchor('forum/index','日常交流')?></li>
   <li><?php echo anchor('anonymous/index','匿名专区')?></li>
   
   <li><?php echo anchor('caw_index/index','首页')?></li>
  
   
 </ul>
</div>
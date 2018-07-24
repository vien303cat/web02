<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php 
include_once("head.php");
include_once("web_list.php");

if(!empty($_POST["logout"])){
	$_SESSION["player"] = "";
	header("location:index.php");
}

$enter = 0 ;
if(!empty($_SESSION["player"]) && $_SESSION["player"] == "admin" ){
	$enter = 1;
	
}

$nowpage = "index";
if(!empty($_GET["do"])){
	$nowpage = $_GET["do"];
}




?>

<title>健康促進網</title>
<link href="./home_files/css.css" rel="stylesheet" type="text/css">
<script src="./home_files/jquery-1.9.1.min.js"></script>
<script src="./home_files/js.js"></script>
</head>

<body>
<div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
	<pre id="ssaa"></pre>
</div>
<iframe name="back" style="display:none;"></iframe>
	<div id="all">
    	<div id="title">
        <?=$month?> 月 <?=$day?> 號 <?=$week?> | 今日瀏覽: <?=$today_cnt?> | 累積瀏覽: <?=$totle_cnt?>      
		<table width="10%" border="0" align="right" cellspacing="0" cellpadding="2"><tr><td align="right"><a href="index.php">回首頁</a></td></tr></table> </div>
        <div id="title2">
        	<img src="img\02B01.jpg" title="健康促進往-回首頁" alt="健康促進往-回首頁"/>
        </div>
        <div id="mm">
        	<div class="hal" id="lef">
<?php if($enter ==0){ ?> <!--使用者介面-->
    	    <a class="blo" href="?do=po">分類網誌</a>
           	<a class="blo" href="?do=news">最新文章</a>
           	<a class="blo" href="?do=poping">人氣文章區</a>
           	<a class="blo" href="?do=know">講座訊息</a>
           	<a class="blo" href="?do=que">問卷調查</a>
		<?php }else{ ?><!--管理者介面-->
			<a class="blo" href="?do=admin">帳號管理</a>
           	<a class="blo" href="#">分類網誌</a>
           	<a class="blo" href="?do=pop">最新文章管理</a>
           	<a class="blo" href="#">講座管理</a>
           	<a class="blo" href="?do=que">問卷管理</a>	
		<?php } ?>				  
			   </div>
            <div class="hal" id="main">
            	<div>
				<table width="82%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="right">
				<marquee>請民眾踴躍投稿電子報，讓電子報成為大家相互交流、分享的園地！詳見最新文章</marquee></td></tr></table>
                	<span align="center" style="width:18%; display:inline-block;">
					<?php if(empty($_SESSION["player"])){ ?>
                    	                    	<a href="?do=login">會員登入</a>
											<?php
											}else{ echo "歡迎，".$_SESSION["player"]; ?> 
											<form action="" method="POST">
											<input type="submit" value="登出"/>
											<input type="hidden" name="logout" value="1"/>
											</form>
											<?php } ?>
                    	                    </span>
				<?php include_once($web_list[$nowpage]); ?>
                </div>
            </div>
        </div>
        <div id="bottom">
    	    本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2018健康促進網社群平台 All Right Reserved 
    		 <br>服務信箱：health@test.labor.gov.tw<img src="./home_files/02B02.jpg" width="28">
        </div>
    </div>

</body></html>
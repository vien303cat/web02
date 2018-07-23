<?php

$now_page = 1 ;
$page_cnt = 3 ;
if(!empty($_GET["page"])){
  $now_page = $_GET["page"];
}else{$_GET["page"] = 1;}
$open_page = ($now_page-1) * $page_cnt ;

$sql = "select * from article where article_display = '1'" ;
$c1 = mysqli_query($link,$sql);
$row = mysqli_num_rows($c1);
$sql = "select * from article where article_display = '1' limit $open_page,$page_cnt" ;
$c1 = mysqli_query($link,$sql);
$c2 = mysqli_fetch_assoc($c1);
$all_page = ceil($row/$page_cnt);
if($_GET["page"] == 1 && $_GET["page"] == $all_page){
  $front_page = 1 ;
  $next_page =  1 ;
}else if($_GET["page"] == 1){
    $front_page = 1 ;
    $next_page = $now_page + 1 ;
}else if($_GET["page"] == $all_page ){
  $front_page = $now_page - 1 ;
  $next_page =  $all_page;
}else{
  $front_page = $now_page - 1 ;
  $next_page = $now_page + 1 ;
}


?>

<fieldset id="left_list">
<legend>
    <span>目前位置:<?=$web_map_list[$_GET['do']]?></span>
</legend>

<table width="80%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td width="40%" align="center">標題</td>
    <td width="60%" align="center">內容</td>
  </tr>
  <?php do{ ?>
  <tr>
    <td width="40%" align="left" style="background-color:#EEE;"><?=$c2["article_title"]?></td>
    <td width="60%" align="left"><?=mb_substr($c2["article_cnt"],0,30,'utf-8')?></td>
  </tr>
  <?php }while($c2 = mysqli_fetch_assoc($c1)) ?>
  <tr>
    <td colspan="2" align="left">
    <?php
        echo "<a href='?do=news&page=".$front_page."'> < </a>" ;
        for($i=1;$i<=$all_page;$i++){
          if($i == $now_page){
          echo "<span style='font-size:36px'><a href='?do=news&page=".$i."'>".$i."</a></span>";
          }else{ echo "<a href='?do=news&page=".$i."'>".$i."</a>"; }
        }
        echo "<a href='?do=news&page=".$next_page."'> > </a>" ;
    ?>
    </td>
  </tr>
</table>

</fieldset>

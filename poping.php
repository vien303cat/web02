<style>
  .OOO{
    display:none;
    background-color:rgba(255,255,0,0.9);
    font-size:8px;
    width:300px;
    height:250px;
    overflow:auto;
    position:absolute;
    
  }
  .QQQ:hover .OOO{
    display:block;
  }
</style>

<?php

  $now_page = 1 ;
  $page_cnt = 5 ;
  if(!empty($_GET["page"])){
    $now_page = $_GET["page"];
  }else{$_GET["page"] = 1;}
  $open_page = ($now_page-1) * $page_cnt ;

  $sql = "select * from article " ;
  $c1 = mysqli_query($link,$sql);
  $row = mysqli_num_rows($c1);
  $sql = "select * from article limit $open_page,$page_cnt" ;
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
    <td width="40%" align="center">內容</td>
    <td width="20%" align="center">人氣</td>
  </tr>
  <?php do{ 
    $ssql = "select * from log where log_newseq = '".$c2["article_seq"]."'";
    $cc1  =  mysqli_query($link,$ssql); 
    $rrow = mysqli_num_rows($cc1);
    if(!empty($_SESSION["player"])){
      $ssql = "select * from log where log_acc ='".$_SESSION["player"]."' and log_newseq = '".$c2["article_seq"]."' ";
      $cc1 = mysqli_query($link,$ssql);
      $row = mysqli_num_rows($cc1);
      if($row == 0){
        $good = "<a href='javascript:pgood(".$c2["article_seq"].",1)'>讚</a>";
      }else{
        $good = "<a href='javascript:pgood(".$c2["article_seq"].",2)'>收回讚</a>";
      }
    }
    ?>
  <tr>
    <td width="40%" align="left" style="background-color:#EEE;" ><?=$c2["article_title"]?></td>
    <td width="40%" align="left"><div class="QQQ">
    <?=mb_substr($c2["article_cnt"],0,30,'utf-8')."..."?><div class="OOO"><span style="color:#0DD;font-size:16px;"><?=$c2["article_title"]?></span><br><?=nl2br($c2["article_cnt"])?></div></div></td>
    <td width="20%" align="center"><?=$rrow?>個人說<img src="icon/02B03.jpg" width="15"/><?php if(!empty($_SESSION["player"])){ echo $good; } ?></td>
  </tr>
  <?php }while($c2 = mysqli_fetch_assoc($c1)) ?>
  <tr>
    <td colspan="2" align="left">
    <?php
        echo "<a href='?do=poping&page=".$front_page."'> < </a>" ;
        for($i=1;$i<=$all_page;$i++){
          if($i == $now_page){
          echo "<span style='font-size:36px'><a href='?do=poping&page=".$i."'>".$i."</a></span>";
          }else{ echo "<a href='?do=poping&page=".$i."'>".$i."</a>"; }
        }
        echo "<a href='?do=poping&page=".$next_page."'> > </a>" ;
    ?>
    </td>
  </tr>
</table>

</fieldset>

<script>
  function pgood(artseq,ever){
    $.post("good_api.php",{artseq,ever},function(){
      document.location.href="?do=poping&lookno=<?=$now_page?>";
    });
  }
</script>
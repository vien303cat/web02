<?php

if(!empty($_GET["lookno"])){ $now_page = $_GET["lookno"]; }
$sql = "select * from article where article_seq = '".$_GET["lookno"]."'" ;
$c1 = mysqli_query($link,$sql);
$row = mysqli_num_rows($c1);
$c2 = mysqli_fetch_assoc($c1);

if(!empty($_SESSION["player"])){
  $sql = "select * from log where log_acc ='".$_SESSION["player"]."' and log_newseq = '".$_GET["lookno"]."' ";
  $c1 = mysqli_query($link,$sql);
  $row = mysqli_num_rows($c1);
  if($row == 0){
    $good = "<a href='javascript:pgood(".$_GET["lookno"].",1)'>讚</a>";
  }else{
    $good = "<a href='javascript:pgood(".$_GET["lookno"].",2)'>收回讚</a>";
  }
}

?>

<fieldset id="left_list">
<legend>
    <span>文章標題：<?=$c2["article_title"]?> | <?=$good;?> </span>
</legend>
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
<td width="80%" align="left"><?=nl2br($c2["article_cnt"])?></td>
  </tr>
</table>

</fieldset>

<script>
  function pgood(artseq,ever){
    $.post("good_api.php",{artseq,ever},function(){
    document.location.href="?do=news_look&lookno=<?=$now_page?>";
    });
  }
</script>
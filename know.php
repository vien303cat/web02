<?php
$sql = "select * from qa_log where qa_log_titleseq ='".$_GET["list"]."' ";
$c1 = mysqli_query($link,$sql);
$totlepoint = mysqli_num_rows($c1);
echo $totlepoint;
$sql = "select * from qa ,qa_select  where qa_seq = qa_select_qaseq and qa_seq ='".$_GET["list"]."' ";
$c1 = mysqli_query($link,$sql);
$c2 = mysqli_fetch_assoc($c1);

?>

<fieldset id="left_list">
  <legend>目前位置：首頁 > 問卷調查 > <?=$c2["qa_title"]?> </legend>
    <table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td align="left" colspan="2"><?=$c2["qa_title"]?></td>
      </tr>
      <?php 
        do{ 
        $sql ="select * from qa_log where qa_log_select = '".$c2["qa_select_seq"]."'" ;
        $cc1 =mysqli_query($link,$sql);
        $rrow = mysqli_num_rows($cc1);
        $vinow = round(($rrow / $totlepoint) * 10000 ) / 100 ; 
        $viwidth = $vinow * 3 ; 
      ?>
      <tr>
        <td align="left" width="50%"><?=$c2["qa_select_con"]?></td>
        <td align="left" width="50%"><div style="width:<?=$viwidth?>px;height:15px;background-color:#CCC;display:inline-block;"></div><?=$rrow?>票 (<?=$vinow?>%)</td>
      </tr>
      <?php }while($c2 = mysqli_fetch_assoc($c1)); ?>
            <tr>
        <td align="center" colspan="2"><input type="button" value="返回" onclick="document.location.href='index.php?do=que'"></td>
      </tr>
    </table>
</fieldset>

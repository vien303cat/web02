<?php
if(!empty($_SESSION["player"])){
    $iflog = "<a>參與投票</a>";
}else{ $iflog = "<a href='index.php?do=login'>請先登入</a>";}

$sql = "select * from qa";
$c1 = mysqli_query($link,$sql);
$c2 = mysqli_fetch_assoc($c1);
?>
<fieldset id="left_list">
  <legend>目前位置：首頁 > 問卷調查</legend>
    <table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td align="center">編號</td>
        <td align="center">問卷題目</td>
        <td align="center">投票總數</td>
        <td align="center">結果</td>
        <td align="center">狀態</td>
      </tr>
<?php $i = 1; do{  
    if(!empty($_SESSION["player"])){
        $iflog = "<a href='?do=visit&list=".$c2["qa_seq"]."'>參與投票</a>";
    }else{ $iflog = "<a href='index.php?do=login'>請先登入</a>";} 
    $cc1 = mysqli_query($link,"select * from qa_log where qa_log_titleseq = '".$c2["qa_seq"]."'");
    $roww = mysqli_num_rows($cc1); 
    ?>
      <tr>
        <td align="center"><?=$i?></td>
        <td align="center"><?=$c2["qa_title"]?></td>
        <td align="center"><?=$roww?></td>
        <td align="center"><a href="?do=know&list=<?=$c2["qa_seq"]?>">結果</a></td>
        <td align="center"><?=$iflog?></td>
      </tr>
<?php $i++; }while($c2 = mysqli_fetch_assoc($c1))?>
    </table>
</fieldset>

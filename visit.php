<?php

$sql = "select * from qa ,qa_select  where qa_seq = qa_select_qaseq and qa_seq ='".$_GET["list"]."' ";
$c1 = mysqli_query($link,$sql);
$c2 = mysqli_fetch_assoc($c1);

if(!empty($_POST["select"])){
    $sql = "insert into qa_log value(NULL,'".$_GET["list"]."','".$_POST["select"]."','".$_SESSION["player"]."')";
    mysqli_query($link,$sql);
    echo "<script>alert('投票成功'); document.location.href='index.php?do=que';</script>";
}

?>
<form method="post" action="" >
<fieldset id="left_list">
  <legend>目前位置：首頁 > 問卷調查 > <?=$c2["qa_title"]?> </legend>
    <table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td align="left"><?=$c2["qa_title"]?></td>
      </tr>
      <?php do{ ?>
      <tr>
        <td align="left"><input type="radio" name="select" value="<?=$c2['qa_select_seq']?>"><?=$c2["qa_select_con"]?></td>
      </tr>
      <?php }while($c2 = mysqli_fetch_assoc($c1)) ?>
            <tr>
        <td align="left"><input type="submit" value="我要投票"></td>
      </tr>
    </table>
</fieldset>
</form>

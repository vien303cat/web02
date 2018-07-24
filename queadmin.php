<?php

if(!empty($_POST["q_name"])){
    $sql = "insert into qa value(NULL,'".$_POST["q_name"]."')";
    mysqli_query($link,$sql);
    $sql = "select * from qa where qa_title ='".$_POST["q_name"]."'";
    $c1 = mysqli_query($link,$sql);
    $c2 = mysqli_fetch_assoc($c1);
    $qaseq = $c2["qa_seq"];
    for($i=0;$i<count($_POST["q_select"]);$i++){
        $sql = "insert into qa_select value(NULL,'$qaseq','".$_POST['q_select'][$i]."');";
        mysqli_query($link,$sql);
    }
}

?>

<form method="post" action="">
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td align="left" width="15%" >問卷名稱</td>
    <td align="left" width="85%"><input type="text" name="q_name"></td>
  </tr>
  <td colspan="2" align="left">
    <span id="ooo">選項<input type="text" name='q_select[]'/></span>
    <input type="button" value="更多" onclick="add_select()"/>
    </td>
  <tr>
    <td colspan="2" align="left">
    <input type="submit" value="送出"/>
    <input type="reset" value="清空"/>
    </td>
  </tr>
</table>
</form>

<script>
var inselect = "<br>選項<input type='text' name='q_select[]'/>";
    function add_select(){
        document.getElementById("ooo").innerHTML = document.getElementById("ooo").innerHTML + inselect ; 
    }
</script>
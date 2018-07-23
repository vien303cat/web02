<?php


if(!empty($_POST["acc"])){
    $acc = $_POST["acc"];
    $pw = $_POST["pw"];
    $sql = "select * from member where member_acc ='$acc';";
    $c1 = mysqli_query($link,$sql);
    $c2 = mysqli_fetch_assoc($c1);

    if($acc == $c2["member_acc"]){
        if($pw == $c2["member_pw"]){
            $_SESSION["player"]=$_POST["acc"];
            header("location:index.php");
        }else{ echo "<script>alert('密碼錯誤')</script>";}
    }else{echo "<script>alert('無此帳號')</script>";}
}

?>


<form action="index.php?do=login" method="POST">
<div>
<fieldset style="width:400px;margin:0 auto;">
    <legend>會員登入</legend>
    
    <table width="80%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td width="50%" align="left" style="background-color:#EEE;">帳號</td>
    <td width="50%" align="left" ><input type="text" name="acc"/></td>
  </tr>
  <tr>
    <td width="50%" align="left" style="background-color:#EEE;">密碼</td>
    <td width="50%" align="left"><input type="text" name="pw"/></td>
  </tr>
  <tr>
    <input type="hidden" value="1" name="iflogin"/>
    <td width="60%" align="left"><input type="submit" value="登入"/><input type="reset" value="清除"/></td>
    <td width="40%" align="right"><a href="index.php?do=forget">忘記密碼</a>|<a href="index.php?do=add">尚未註冊</a></td>
  </tr>
</table>

</fieldset>
</div>
</form>
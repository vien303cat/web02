<?php
$link = mysqli_connect("localhost","root","","db02");
mysqli_query($link,"SET NAMES UTF8");

if(!empty($_POST["addin"])){
    if(!empty($_POST["acc"]) && !empty($_POST["pw"])){      //不可空白
        if(!empty($_POST["pw2"]) && !empty($_POST["email"])){  //不可空白
            $acc = $_POST["acc"];
            $pw = $_POST["pw"];
            $pw2 = $_POST["pw2"];
            $email = $_POST["email"];

            $sql = "select * from member where member_acc ='$acc'";
            $c1 = mysqli_query($link,$sql);
            $row = mysqli_num_rows($c1);
            if(!empty($row)){    //帳號重複
                echo "<script>alert('帳號重複')</script>";
            }else{
                if($pw == $pw2){    //再次確認密碼
                    $sql = "insert into member value(NULL,'$acc','$pw','$email')";
                    mysqli_query($link,$sql);
                    echo "<script>alert('註冊成功')</script>";
                }else{ echo "<script>alert('請再次確認密碼'); document.location.href='?do=login';</script>"; }
            }


        }else{echo "<script>alert('不可空白')</script>";}
    }else{echo "<script>alert('不可空白')</script>";}
}
?>
<form action="" method="POST">

<fieldset><legend>會員註冊</legend>
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" align="center" valign="middle"><span style="color:#f00;font-size:8px;">*請設定您要註冊的帳號及密碼(最長12字元)</span></td>
  </tr>
  <tr>
    <td width="50%" align="left" valign="middle">Step1:登入帳號</td>
    <td width="50%" align="left" valign="middle"><input type="text" name="acc" maxlength="12"/></td>
  </tr>
  <tr>
    <td width="50%" align="left" valign="middle">Step2:登入密碼</td>
    <td width="50%" align="left" valign="middle"><input type="password" name="pw" maxlength="12"/></td>
  </tr>
  <tr>
    <td width="50%" align="left" valign="middle">Step3:再次確認密碼</td>
    <td width="50%" align="left" valign="middle"><input type="password" name="pw2" maxlength="12"/></td>
  </tr>
  <tr>
    <td width="50%" align="left" valign="middle">Step4:信箱(忘記密碼時使用</td>
    <td width="50%" align="left" valign="middle"><input type="text" name="email"/></td>
  </tr>
  <tr>
    <input type="hidden" value="1" name="addin"/>
    <td colspan="2" align="left" valign="middle"><input type="submit" value="註冊"><input type="reset" value="清除"></td>
  </tr>
</table>
</fieldset>
</form>
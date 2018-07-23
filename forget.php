<?php
    if(!empty($_POST["email"])){
        $email = $_POST["email"];
        $sql ="select * from member where member_email ='$email';";
        $c1 = mysqli_query($link,$sql);
        $c2 = mysqli_fetch_assoc($c1);
        $row = mysqli_num_rows($c1);
        
        if(!empty($row)){
            $pw = "您的密碼為:".$c2["member_pw"];
        }else{$pw = "查無此資料";}
    }

?>
<form action="" method="POST">
<div style="font-size:24px;margin:auto auto;">
<table width="60%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td>請輸入信箱以查詢密碼</td>
  </tr>
  <tr>
    <td><input type="text" name="email"/></td>
  </tr>
  <tr>
    <td><span style="color:#F00;font-size:12px;">
    <?php
    if(!empty($pw)){
        echo $pw."<br>" ;
    }
    ?></span>
    <input type="submit" value="尋找"/></td>
  </tr>
</table>
</div>
</form>
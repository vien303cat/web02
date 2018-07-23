<?php
  
  if(!empty($_POST["my_no"][0])){
    for($i=0;$i<count($_POST["my_no"]);$i++){  
      $sql = "update article set article_display ='0' where article_seq ='".$_POST["my_no"][$i]."';";
      mysqli_query($link,$sql);
      if(!empty($_POST["display"][$i])){
        $sql = "update article set article_display ='1' where article_seq ='".$_POST["display"][$i]."';";
        mysqli_query($link,$sql);
      }

      if(!empty($_POST["del"][$i])){
        $sql = "delete from article where article_seq ='".$_POST["del"][$i]."';";
        mysqli_query($link,$sql);
      }
  }
}

  $now_page = 1 ;
  $page_cnt = 3 ;
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
  if($_GET["page"] == 1){
    $front_page = 1 ;
    $next_page = $now_page + 1 ;
  }else if($_GET["page"] == $all_page){
    $front_page = $now_page - 1 ;
    $next_page =  $all_page;
  }else{
    $front_page = $now_page - 1 ;
    $next_page = $now_page + 1 ;
  }


?>

<form action="" method="POST">
<table width="80%" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td align="center" width="20%" valign="middle" style="background-color:#EEE;">編號</td>
    <td align="center" width="60%" valign="middle" style="background-color:#EEE;">標題</td>
    <td align="center" width="10%" valign="middle" style="background-color:#EEE;">顯示</td>
    <td align="center" width="10%" valign="middle" style="background-color:#EEE;">刪除</td>
  </tr>
  <?php do{ ?>
  <tr>
    <td align="center" width="20%" valign="middle"><?=$c2["article_seq"]?></td>
    <td align="center" width="60%" valign="middle"><?=$c2["article_title"]?></td>
    <input type="hidden" name="my_no[]" value="<?=$c2['article_seq']?>" />
    <td align="center" width="10%" valign="middle"><input type="checkbox" name="display[]" value="<?=$c2['article_seq']?>" <?php if($c2['article_display'] == 1){ ?> checked="checked" <?php } ?>  ></td>
    <td align="center" width="10%" valign="middle"><input type="checkbox" name="del[]" value="<?=$c2['article_seq']?>" ></td>
  </tr>
  <?php }while($c2 = mysqli_fetch_assoc($c1)) ?>
  <tr>
    <td colspan="4" align="center" valign="middle">
    <?php
    echo "<a href='?do=pop&page=".$front_page."'> < </a>" ;
    for($i=1;$i<=$all_page;$i++){
      if($i == $now_page){
      echo "<span style='font-size:36px'><a href='?do=pop&page=".$i."'>".$i."</a></span>";
      }else{ echo "<a href='?do=pop&page=".$i."'>".$i."</a>"; }
    }
    echo "<a href='?do=pop&page=".$next_page."'> > </a>" ;
    ?>
    </td>
  </tr>
  <tr>
    <input type="hidden" value="1" name="in"/>
    <td colspan="4" align="center" valign="middle"><input type="submit" value="確定修改"/></td>
  </tr>
</table>
</form>
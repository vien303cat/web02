<?php
session_start();
$link = mysqli_connect("localhost","root","","db02");
mysqli_query($link,"SET NAMES UTF8");
if($_POST["ever"] == 1){ $sql = "insert into log value(NULL,'".$_SESSION["player"]."','".$_POST["artseq"]."');" ;  }
if($_POST["ever"] == 2){ $sql = "delete from log where log_acc ='".$_SESSION["player"]."' and log_newseq = '".$_POST["artseq"]."';"; }
mysqli_query($link,$sql);
?>
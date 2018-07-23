<?php
session_start();
$today = strtotime("+6hour");
$now_today = date("Y-m-d",$today);
$month = date("m",$today);
$day = date("d",$today); 
$week = date("l",$today);
$link = mysqli_connect("localhost","root","","db02");
mysqli_query($link,"SET NAMES UTF8");

if(empty($_SESSION["user"])){
    $_SESSION["user"] = $now_today ;
    $sql = " select * from player where player_day = '".$now_today."';" ;
    $c1 = mysqli_query($link,$sql);
    $c2 = mysqli_fetch_assoc($c1);
    $row = mysqli_num_rows($c1);
    if(!empty($row)){
        $sql = " update player set player_cnt = player_cnt + 1 where player_day = '$now_today';" ;
        mysqli_query($link,$sql);
        
    }else{
        $sql = " insert into player value(NULL,'1','".$now_today."') ;" ;
        mysqli_query($link,$sql);
        }
}else{ 
    //=================若過了12點還在網頁的時候再insert一次(考試不考)
    if($_SESSION["user"] != $now_today){
        $_SESSION["user"] = $now_today ;
        $sql = " select * from player where player_day = '".$now_today."';" ;
        $c1 = mysqli_query($link,$sql);
        $c2 = mysqli_fetch_assoc($c1);
        $row = mysqli_num_rows($c1);
        if(!empty($row)){
            $sql = " update player set player_cnt = player_cnt + 1 where player_day = '$now_today';" ;
            mysqli_query($link,$sql);
            
        }else{
            $sql = " insert into player value(NULL,'1','".$now_today."') ;" ;
            mysqli_query($link,$sql);
            }
    }
    ////////////////////////////////////////////////////////////////
}

$sql ="select player_cnt from player where player_day = '$now_today'";
$c1 = mysqli_query($link,$sql);
$c2 = mysqli_fetch_assoc($c1);
$today_cnt = $c2["player_cnt"];

$sql ="select sum(player_cnt) from player ";
$c1 = mysqli_query($link,$sql);
$c2 = mysqli_fetch_assoc($c1);
$totle_cnt = $c2["sum(player_cnt)"];
?>
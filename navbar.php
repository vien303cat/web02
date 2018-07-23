<?php

if(!empty($_GET["do"])){
    $now_menu1 = $_GET["do"];
}else{$now_menu1 ="index";}

if(!empty($_GET["list2"])){
    $now_list = $_GET["list2"];
}else{$now_list ="a1";}

?>

<style>
#navbar{
    height:50px;
    margin:0 auto;
}


</style>
<div id="navbar">目前位置:<?=$web_map_list[$now_menu1].$web_map_list[$now_list]?> </div>
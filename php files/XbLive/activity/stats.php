<?php
$ACH_XUID=@$_GET['ACHXUID'];
include('../config.php'); 

$NumberoFHistory=@$_GET['NumberoFHistory'];
$NumberoFActivity=@$_GET['NumberoFActivity'];
    /*Json Files */
    $newfilename =   "$ACH_XUID.json";

    $local_pathFeed = $LocalVpsFolder."activity/feed/";
    $local_pathHistory = $LocalVpsFolder."activity/history/";


if(isset($NumberoFActivity)) {

    $jsondata = file_get_contents($local_pathFeed.$newfilename);
    $json = json_decode($jsondata, true);
    $Number = $json['numItems'];
    
    echo $Number;
    
}

if(isset($NumberoFHistory)) { 

    $jsondata = file_get_contents($local_pathHistory.$newfilename);
    $json = json_decode($jsondata, true);
    $Number =  $json['numItems'];
    echo $Number;
  
}
?>
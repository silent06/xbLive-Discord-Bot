<?php
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*GET varibles*/
    $recentplayers = @$_GET['recentplayers'];


    /*Json varibles*/ 
    $jsondata = file_get_contents('recent-players.json');
    $json = json_decode($jsondata, true);


    if(isset($recentplayers))
    {
        $output;
        $i = 0;
        foreach($json['people'] as $people) {
            $output =  $people['gamertag'];
            $i++;
            echo $output, "\n"; 
            if($i==75) break;
        }  
    } 

?>
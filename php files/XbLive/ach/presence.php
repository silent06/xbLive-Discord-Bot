<?php
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*GET varibles*/
    $presenceList = @$_GET['presenceList'];
    $NumberOfpresence = @$_GET['NumberOfpresence'];

    /*Json varibles*/ 
    $jsondata = file_get_contents('presence.json');
    $json = json_decode($jsondata, true);

    if(isset($NumberOfpresence)) {

        echo count($json['people']), "\n";
    }

    if(isset($presenceList)) {
        $output1; $output2;
        $i = 0;
        foreach($json as $people) {
            $output1 =  $people['xuid'];
            $output2 =  $people['state'];
            $i++;
            echo "XUID:", $output1,"  ", $output2, "\n";  
            if($i==30) break;
        }  
    }

?>
<?php
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }
    include('../config.php');
    $Multipeople=@$_GET['Multipeople'];
    $ACH_XUID=@$_GET['ACHXUID'];
    /*GET varibles*/
    $newfilename =   "$ACH_XUID.json";
    $local_path = $LocalVpsFolder."presence/files/";

    /*Json varibles*/ 
    $jsondata = file_get_contents($local_path.$newfilename);
    $json = json_decode($jsondata, true);

    if(isset($Multipeople)) {
        $output1; $output2;
        $i = 0;
        foreach($json as $people) {
            $output1 =  $people['xuid'];
            $output2 =  $people['state'];
            $i++;
            echo "(XUID:)", $output1,"  ", "($output2)", "\n";  
            if($i==30) break;
        }  
    }

?>
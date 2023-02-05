<?php
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*GET varibles*/
    $friendsList = @$_GET['friendsList'];
    $anotherfriendlist = @$_GET['anotherfriendlist'];/*Request Friends List */
    $NumberOfFriends = @$_GET['NumberOfFriends'];
    $FNumberOfFriends = @$_GET['FNumberOfFriends'];/*Request Friends total number of friends*/

    /*Json varibles*/ 
    $jsondata = @file_get_contents('friends.json');
    $json = json_decode($jsondata, true);

    $Fjsondata = @file_get_contents('anotherfriends.json');
    $Fjson = json_decode($Fjsondata, true);
    
     

    if(isset($NumberOfFriends)) {

        echo count($json['people']), "\n";
    }

    if(isset($FNumberOfFriends)) {

        echo count($Fjson['people']), "\n";
    }

    if(isset($friendsList))
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

    if(isset($anotherfriendlist))
    {
        $output;
        $i = 0;
        foreach($Fjson['people'] as $people) {
            $output =  $people['gamertag'];
            $i++;
            echo $output, "\n"; 
            if($i==75) break;
        }         
    }

 

?>
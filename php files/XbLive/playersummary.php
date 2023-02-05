<?php
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*Json varibles*/ 
    $jsondata = file_get_contents('playersummary.json');
    $json = json_decode($jsondata, true);
    $xuid = $json['people'][0]['xuid'];
    $profilepicture = $json['people'][0]['displayPicRaw'];
    $gamertag = $json['people'][0]['gamertag'];
    $gamerscore = $json ['people'][0]['gamerScore'];
    $XboxOneRep = $json['people'][0]['xboxOneRep'];
    $presenceState = $json['people'][0]['presenceState'];
    $presenceText = $json['people'][0]['presenceText'];
    $presenceDevices = $json['people'][0]['presenceDevices'];
    $titleIds= $json['people'][0]['socialManager']['titleIds'];

    /*GET varibles*/
    $gamerscoreS = @$_GET['gamerscore'];
    $xuids = @$_GET['xuid'];
    $profilepictures = @$_GET['profilepicture'];
    $gamertags = @$_GET['gamertag'];
    $XboxOneReps = @$_GET['XboxOneRep'];
    $presenceStateA = @$_GET['presenceState'];
    $presenceTextA = @$_GET['presenceText'];
    $presenceDevicesA = @$_GET['presenceDevices'];
    $titleIdsA = @$_GET['titleIds'];
    
    if(isset($titleIdsA))
    {
        echo $titleIds;

    }

    if(isset($presenceTextA))
    {
        echo $presenceText;

    }

    if(isset($presenceDevicesA))
    {
        echo $presenceDevices;

    }

    if(isset($presenceStateA))
    {
        echo $presenceState;

    }

    if(isset($gamerscoreS))
    {
        echo $gamerscore;

    }

    if(isset($xuids))
    {

        echo $xuid;
    }

    if(isset($profilepictures))
    {

        echo $profilepicture;
    }

    if(isset($gamertags))
    {

        echo $gamertag;
    }


    if(isset($XboxOneReps))
    {

        echo $XboxOneRep;
    }



?>
<?php
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*Json varibles*/ 
    $jsondata = file_get_contents('userprofile.json');
    $json = json_decode($jsondata, true);
    $xuid = $json['profileUsers'][0]['hostId'];
    $profilepicture = $json['profileUsers'][0]['settings'][0]['value'];
    $gamerscore = $json ['profileUsers'][0]['settings'][1]['value'];
    $gamertag = $json['profileUsers'][0]['settings'][2]['value'];
    $AccountTier = $json['profileUsers'][0]['settings'][3]['value'];
    $XboxOneRep = $json['profileUsers'][0]['settings'][4]['value'];
    $PreferredColor = $json['profileUsers'][0]['settings'][5]['value'];
    $RealName = $json['profileUsers'][0]['settings'][6]['value'];
    $Bio = $json['profileUsers'][0]['settings'][7]['value'];

    /*GET varibles*/
    $gamerscoreS = @$_GET['gamerscore'];
    $xuids = @$_GET['xuid'];
    $profilepictures = @$_GET['profilepicture'];
    $gamertags = @$_GET['gamertag'];
    $AccountTiers = @$_GET['AccountTier'];
    $XboxOneReps = @$_GET['XboxOneRep'];
    $Bios = @$_GET['Bio'];

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

    if(isset($AccountTiers))
    {

        echo $AccountTier;
    }

    if(isset($XboxOneReps))
    {

        echo $XboxOneRep;
    }

    if(isset($Bios))
    {

        echo $Bio;
    }


?>
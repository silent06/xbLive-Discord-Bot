<?php

    if(!isset($_SESSION))
    {
        session_start();
    }
    include('../config.php'); 
    $gameachievementshistory=@$_GET['gameachievementshistory'];

    /*GET varibles*/
    $newfilename =   "gameachievementshistory.json";
    $local_path = $LocalVpsFolder."ach/files";

    /*Json varibles*/ 
    $jsondata = file_get_contents($local_path.$newfilename);
    $json = json_decode($jsondata, true);


                            
    if(isset($gameachievementshistory)) 
    {
        if(!empty($json['titles'][0]))
        {

            /*GET varibles*/
            $lastUnlock = @$_GET['lastUnlock'];
            $titleId = @$_GET['titleId'];
            $titleType = @$_GET['titleType'];
            $name = @$_GET['name'];
            $earnedAchievements = @$_GET['earnedAchievements'];
            $currentGamerscore = @$_GET['currentGamerscore'];
            $maxGamerscore = @$_GET['maxGamerscore'];
            $rarityCategory1 = @$_GET['rarityCategory1'];
            $isRarestCategory = @$_GET['isRarestCategory'];
            $rarityCategory2 = @$_GET['rarityCategory2'];
            $isRarestCategory2 = @$_GET['isRarestCategory2'];
            $totalOfUnlocks2 = @$_GET['totalOfUnlocks2'];


            /*Parse Json */
            $returnlastUnlock = $json['titles'][0]['lastUnlock'];
            $returntitleId = $json['titles'][0]['titleId'];
            $returntitleType = $json['titles'][0]['titleType'];
            $returnname = $json['titles'][0]['name'];
            $returnearnedAchievements = $json['titles'][0]['earnedAchievements'];
            $returncurrentGamerscore = $json['titles'][0]['currentGamerscore'];
            $returnmaxGamerscore = $json['titles'][0]['maxGamerscore'];

            $rareUnlocksCategory1 = $json['titles'][0]['rareUnlocks'][0]['rarityCategory'];
            $rareUnlocksisRarestCategory1 = $json['titles'][0]['rareUnlocks'][0]['isRarestCategory'];
            
            $rareUnlocksCategory2 = $json['titles'][0]['rareUnlocks'][1]['rarityCategory'];
            $rareUnlocksisRarestCategory2 = $json['titles'][0]['rareUnlocks'][1]['isRarestCategory'];


            $totalOfUnlocks = $json['titles'][0]['rareUnlocks'][0]['numUnlocks'];


            if(isset($lastUnlock))
            {
                echo $returnlastUnlock;
        
            }


            if(isset($titleId))
            {
                echo $returntitleId;
        
            }

            if(isset($titleType))
            {
                echo $returntitleType;
        
            }


            if(isset($name))
            {
                echo $returnname;
        
            }

            if(isset($earnedAchievements))
            {
                echo $returnearnedAchievements;
        
            }

            if(isset($currentGamerscore))
            {
                echo $returncurrentGamerscore;
        
            }
            
            if(isset($maxGamerscore))
            {
                echo $returnmaxGamerscore;
        
            }

            if(isset($rarityCategory1))
            {
                echo $rareUnlocksCategory1;
        
            }

            if(isset($rarityCategory2))
            {
                echo $rareUnlocksCategory2;
        
            }
            
            if(isset($isRarestCategory))
            {

                $isRarest = $rareUnlocksisRarestCategory1 ? "true":"false";
                echo $isRarest;
        
            }

            if(isset($isRarestCategory2))
            {
                $isRarest = $rareUnlocksisRarestCategory2 ? "true":"false";
                echo $isRarest;
        
            }

            if(isset($totalOfUnlocks2))
            {
                echo $totalOfUnlocks;
        
            }

        }
        else {

          
        }

    } 
  

?>

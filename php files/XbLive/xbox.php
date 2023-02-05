<?php

    if(!isset($_SESSION))
    {
        session_start();
    }
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    //use \OpenXBL\Api;
    //header('Content-type: text/plain');
    include('config.php'); 
    
    /*OpenXbl Api Variables */
    $API_KEY = @$_GET['APIKEY'];
    $xbox = new Api('8c0cckgkwk8kc0swg0s4goscc8w8c4wswoo');
    $ACH_XUID=@$_GET['ACHXUID'];
    $VPSFolder= $LocalVpsFolder;
    
////////////////////////////////////////////Profile Commands///////////////////////////////////////////////////////////////////////
    /*Json varibles*/ 
    $jsondata = file_get_contents('profile.json');
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
    $tenurelevel = $json['profileUsers'][0]['settings'][8]['value'];

    /*GET varibles*/
    $gamerscoreS = @$_GET['gamerscore'];
    $xuids = @$_GET['xuid'];
    $profilepictures = @$_GET['profilepicture'];
    $gamertags = @$_GET['gamertag'];
    $AccountTiers = @$_GET['AccountTier'];
    $XboxOneReps = @$_GET['XboxOneRep'];
    $Bios = @$_GET['Bio'];
    $tenurelevels = @$_GET['tenurelevel'];
    $downloadinfo = @$_GET['downloadinfo'];
 
    if(isset($downloadinfo)) {
        //grab profile info & save to localdrive for reading 
        print $data = $xbox->get($downloadinfo);
        $newfilename = "profile.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
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

    if(isset($AccountTiers))
    {

        echo $AccountTier;
    }
    
    if(isset($tenurelevels))
    {

        echo $tenurelevel;
    }

    if(isset($XboxOneReps))
    {

        echo $XboxOneRep;
    }

    if(isset($Bios))
    {

        echo $Bio;
    }


    /*Search for user profile by XUID */
    $userprofile = @$_GET['userprofile'];

    if(isset($userprofile))
    {        
        print $data = $xbox->get($userprofile);
        $newfilename = "userprofile.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        //another's profile information
        ///account/{xuid} 
    }


////////////////////////////////////////////Profile Commands///////////////////////////////////////////////////////////////////////



////////////////////////////////////////////Friend Commands///////////////////////////////////////////////////////////////////////   
    $AddFriend = @$_GET['AddFriend'];
    $RemoveFriend = @$_GET['RemoveFriend'];
    $friendlist= @$_GET['friendlist'];
    $anotherfriendlist= @$_GET['anotherfriendlist'];
    $findpersongamertag= @$_GET['findpersongamertag'];
    $addfriendfavorite= @$_GET['addfriendfavorite'];
    $removefriendfavorite= @$_GET['removefriendfavorite'];


    if(isset($AddFriend))
    {
        $APIKey = new Api($API_KEY);
        $APIKey->get($AddFriend);
        echo "AddedFriend";
    }

    if(isset($RemoveFriend))
    {
        $APIKey = new Api($API_KEY);
        $APIKey->get($RemoveFriend);
        echo "RemovedFriend\n";
    }

    if(isset($friendlist))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($friendlist);
        $newfilename = "friends.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
    }

    if(isset($anotherfriendlist))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($anotherfriendlist);
        $newfilename = "anotherfriends.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        // $xbox->get('friends?xuid={xuid}');
    }

    if(isset($findpersongamertag))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($findpersongamertag);
        $newfilename = "findpersongamertag.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        // $xbox->get('friends/search?gt=OpenXBL');
    }

    if(isset($addfriendfavorite))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($addfriendfavorite);
        $newfilename = "addfriendfavorite.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //print $xbox->post('friends/favorite', array('xuids' => array('2535473210914202')));
    }

    if(isset($removefriendfavorite))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($removefriendfavorite);
        $newfilename = "removefriendfavorite.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //print $xbox->post('friends/favorite', array('xuids' => array('2535473210914202')));
    }

    //print $xbox->post('friends/favorite/remove', array('xuids' => array('2535473210914202')));
    /////////////////////////////////////////Friend Commands///////////////////////////////////////////////////////////////////////
    



    /////////////////////////////////////////Presence Commands///////////////////////////////////////////////////////////////////////
    $presence= @$_GET['presence'];
    $Multipeople= @$_GET['Multipeople'];
    $recentplayers= @$_GET['recent-players'];

    if(isset($presence))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($presence);
        $newfilename = "presence.json";
        $local_path =  $VPSFolder."presence/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
    }

    if(isset($Multipeople))
    {
        $APIKey = new Api($API_KEY);
        $data = $APIKey->get($Multipeople);
        $newfilename = "$ACH_XUID.json";
        $local_path = $VPSFolder."presence/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "", $local_path.$newfilename;
        //1234567,8762567,9027469827/presence 
    }

    if(isset($recentplayers))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($recentplayers);
        $newfilename = "recent-players.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
    }
    
    /////////////////////////////////////////Presence Commands///////////////////////////////////////////////////////////////////////


    /////////////////////////////////////////conversations Commands///////////////////////////////////////////////////////////////////////
    
    $conversationsrequests= @$_GET['conversationsrequests'];
    $conversations= @$_GET['conversations'];
    $getaconversation= @$_GET['getaconversation'];
    $sendaconversation= @$_GET['sendaconversation'];
    $sendaconversationXUID= @$_GET['sendaconversationXUID'];

    if(isset($conversationsrequests))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($conversationsrequests);
        $newfilename = "conversationsrequests.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //conversations/requests 
    }

    if(isset($conversations))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($conversations);
        $newfilename = "conversations.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //conversations
    }

    if(isset($getaconversation))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($getaconversation);
        $newfilename = "getaconversation.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //conversations/{xuid} 
    }

    if(isset($sendaconversation))
    {
        $APIKey = new Api($API_KEY);
        $Payload = [
            'xuid' => $sendaconversationXUID,
            'message' => $sendaconversation,
        ];
        $data = $APIKey->post("/conversations", $Payload);
        $newfilename = "sendaconversation.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";   
        //Payload: {"xuid": "2533274798000000","message": "This is an example payload."};
        //send a conversation
    }
    /////////////////////////////////////////conversations Commands///////////////////////////////////////////////////////////////////////
    

    /////////////////////////////////////////group Commands///////////////////////////////////////////////////////////////////////
    
    $group= @$_GET['group'];
    $groupsummary= @$_GET['groupsummary'];
    $groupmessages= @$_GET['groupmessages'];
    $groupcreatemessage= @$_GET['groupcreatemessage'];
    $groupsendmessage= @$_GET['groupsendmessage'];
    $grouprename= @$_GET['grouprename'];
    $groupleave= @$_GET['groupleave'];
    $groupinvite= @$_GET['groupinvite'];
    $groupkick= @$_GET['groupkick'];
    $generategamertag= @$_GET['generategamertag']; 

    if(isset($group))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($group);
        $newfilename = "group.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //group -get all group conversations  
    }

    if(isset($groupsummary))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupsummary);
        $newfilename = "groupsummary.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //group/summary/{group id} -gets a group chat summary   
    }

    if(isset($groupmessages))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupmessages);
        $newfilename = "groupmessages.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        ///group/summary/{group id} -Get a group chats messages  
    }

    if(isset($groupcreatemessage))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupcreatemessage);
        $newfilename = "groupcreatemessage.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Create a new message group.
        //Payload: {"participants":["2535428038000000","2533274802000000"]}  
        ///group/create  
    }

    if(isset($groupsendmessage))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupsendmessage);
        $newfilename = "groupsendmessage.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Send text message to group.
        //Payload: {"groupId":"{groupId}","message":"test message"} 
        ///group/send 
    }

    if(isset($grouprename))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($grouprename);
        $newfilename = "grouprename.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Rename a message group.
        //Payload: {"groupId":"000000000000000", "name":"Custom Name"} 
        //group/rename  
    }

    if(isset($groupinvite))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupinvite);
        $newfilename = "groupinvite.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Invite message group to voice chat.
        //Payload: {"groupId":"000000000000000"} 
        // /group/invite/voice 
    }

    if(isset($groupleave))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupleave);
        $newfilename = "groupleave.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Leave a message group.
        //Payload: {"groupId":"000000000000000"} 
        ///group/leave  
    }

    if(isset($groupinvite))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupinvite);
        $newfilename = "groupinvite.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Invite to message group.
        //Payload: {"groupId":"000000000000000", "participants":["00000-xuid-000000000"]} 
        //group/invite    
    }

    if(isset($groupkick))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($groupkick);
        $newfilename = "groupkick.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Kick user from message group.
        //Payload: {"groupId":"000000000000000", "xuid":"00000-xuid-000000000"} 
        //group/kick    
    }

    if(isset($generategamertag))
    {
        $APIKey = new Api($API_KEY);
        $Payload = [
            'Algorithm' => "1",
            'Count' => "3",
            'Locale' => "en-US",
            'Seed' => "1",
        ];
        print $data = $APIKey->post("generate/gamertag", $Payload);
        echo $data;
        $newfilename = "generategamertag.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
       
        //generate a random gamertag
        //Payload: {"Algorithm":1,"Count":3,"Locale":"en-US","Seed":""} 
        //generate/gamertag   
    }

    /////////////////////////////////////////group Commands///////////////////////////////////////////////////////////////////////


    /////////////////////////////////////////Clubs Commands///////////////////////////////////////////////////////////////////////

    $clubs= @$_GET['clubs']; 
    $clubsrecommendations=@$_GET['clubsrecommendations'];
    $clubsowned=@$_GET['clubsowned'];
    $createAclub=@$_GET['createAclub'];
    $clubtype=@$_GET['clubtype'];
    $clubName=@$_GET['clubName'];
    

    $searchAclub=@$_GET['searchAclub'];
    $reserveClub=@$_GET['reserveClub'];


    if(isset($clubs))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($clubs);
        $newfilename = "$ACH_XUID.json";
        $local_path =  $VPSFolder."clubs/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        ///clubs/{clubId} 
        //Return Club Details/Summary.  
    }

    if(isset($clubsrecommendations))
    {
        $APIKey = new Api($API_KEY);
        $Payload = [
            'xuid' => '2535406735879430',
        ];
        print $data = $APIKey->post('clubs/recommendations', $Payload);
        $newfilename = "clubsrecommendations.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        ///clubs/recommendations 
        //Return a list of clubs this user would be interested in joining.   
    }

    if(isset($clubsowned))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($clubsowned);
        $newfilename = "$ACH_XUID.json";
        $local_path = $VPSFolder."clubs/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        ///clubs/owned 
        //return a list of clubs this user owns and manages.    
    }
    
    if(isset($createAclub))
    {
        $APIKey = new Api($API_KEY);
        $Payload = [
            'name' => $clubName,
            'type' => $clubtype,
        ];
        print $data = $APIKey->post($createAclub, $Payload);
        $newfilename = "createAclub.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        print_r($Payload);
        echo $createAclub;
        //echo $clubtype;
        //Payload: {"name":"Hello World", "type":"[public/private/hidden]"}
        //Create a new club.
        ///clubs/create     
    }

    if(isset($searchAclub))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($searchAclub);
        $newfilename = "searchAclub.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //clubs/find?q=my search query
        //Return a list of clubs matching a search query.
        //q= URL parameter must not be empty.     
    }
    
    if(isset($reserveClub))
    {
        $APIKey = new Api($API_KEY);
        $Payload = [
            'name' => $clubName,
        ];
        $data = $APIKey->post($reserveClub, $Payload);
        $newfilename = "reserveClub.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //clubs/reserve 
        //Check to see if your name is available prior to sending a Create Club request.
        //Payload: {"name":"Hello World"}    
    }
    
    /////////////////////////////////////////Clubs Commands///////////////////////////////////////////////////////////////////////




    /////////////////////////////////////////Activity Commands///////////////////////////////////////////////////////////////////////
    $ActivityFeed=@$_GET['ActivityFeed'];
    $ActivityPost=@$_GET['ActivityPost'];
    $Activityhistory=@$_GET['Activityhistory'];

    if(isset($ActivityFeed))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($ActivityFeed);
        $newfilename = "$ACH_XUID.json";
        $local_path = $VPSFolder."activity/feed/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //activity/feed -Get Activity Feed
        //Return your activity feed.  
    }

    if(isset($ActivityPost))
    {
        $APIKey = new Api($API_KEY);

        $Payload = [
            'message' => 'This is a test',
        ];

        print $data = $APIKey->post($ActivityPost,$Payload);
        $newfilename = "ActivityPost.json";
        $local_path = $VPSFolder."activity/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //activity/feed  
        //Post a message to your activity feed. 
    }

    if(isset($Activityhistory))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($Activityhistory);
        $newfilename = "$ACH_XUID.json";
        $local_path = $VPSFolder."activity/history/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //activity/history   
        //Return your activity feed history.  
    }

    /////////////////////////////////////////Activity Commands///////////////////////////////////////////////////////////////////////

    $alerts=@$_GET['alerts'];
    $playersummary=@$_GET['playersummary'];


    if(isset($alerts))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($alerts);
        $newfilename = "alerts.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        ///alerts   
        //Return your notifications / alerts. Does not set to 'viewed/seen' status on-request.  
    }


    if(isset($playersummary))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($playersummary);
        $newfilename = "playersummary.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //player/summary    
        //Returns basic stats about the player. Basic multiplayer stats as well.  
    }
     

    /////////////////////////////////////////gameclips Commands///////////////////////////////////////////////////////////////////////
    
    $gameclips=@$_GET['gameclips'];
    $gameclipsdelete=@$_GET['gameclipsdelete'];
    $gamescreenshots=@$_GET['gamescreenshots'];
    $friendsgameclips=@$_GET['friendsgameclips'];

    if(isset($gameclips))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($gameclips);
        $newfilename = "gameclips.json";
        $local_path = $VPSFolder."gameclips/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //dvr/gameclips    
        //Returns player game clip metadata   
    }

    if(isset($friendsgameclips))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($friendsgameclips);
        $newfilename = "$ACH_XUID.json";
        $local_path = $VPSFolder."gameclips/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //dvr/gameclips    
        //Returns player game clip metadata   
    }
     
    if(isset($gameclipsdelete))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($gameclipsdelete);
        $newfilename = "gameclipsdelete.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //Deletes a game clip by returning status 200 OK.  
        //dvr/gameclips/delete/{{GameContentID}}    
    }

    if(isset($gamescreenshots))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($gamescreenshots);
        $newfilename = "gamescreenshots.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //dvr/screenshots  
        //Returns player screenshots metadata     
    }
    
    
    /////////////////////////////////////////gameclips Commands///////////////////////////////////////////////////////////////////////



    /////////////////////////////////////////achievements Commands///////////////////////////////////////////////////////////////////////

    $achievementslist=@$_GET['achievementslist'];
    $achievementslistgame=@$_GET['achievementslistgame'];
    $achievements=@$_GET['achievements'];
    $achievementstats=@$_GET['achievementstats'];
    $SpecificGameAchievements=@$_GET['SpecificGameAchievements'];
    $gameachievementshistory=@$_GET['gameachievementshistory'];
    $achievementsanotherplayersgame=@$_GET['achievementsanotherplayersgame'];
    if(isset($achievementslist))
    {

        $APIKey = new Api($API_KEY);
        $data = $APIKey->get($achievementslist);
        $newfilename =   "$ACH_XUID.json";
        $local_path = $VPSFolder."ach/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "", $local_path.$newfilename;
        //achievements/player/{xuid}   
        //Returns another player achievements list    
    }

    if(isset($achievementsanotherplayersgame))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($achievementsanotherplayersgame);      
        $newfilename = "$ACH_XUID.json";
        $local_path = $VPSFolder."achievementsanotherplayersgame/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "", $local_path.$newfilename;
        //Get Another Players Game Achievements   
        //achievements/player/{xuid}/title/{titleid} 
        
        /*Doesnt always pull specific title info */
    }

    if(isset($achievements))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($achievements);
        $newfilename = "achievements.json";
        $local_path =  $VPSFolder."ach/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        //echo "success";
        //achievements  
        //Get Player Achievements List  
    }

    if(isset($achievementstats))
    {
        $APIKey = new Api($API_KEY);
        $Payload = [
            'xuids'      => $ACH_XUID,     
        ];
        print $data = $APIKey->post($achievementstats, $Payload);
        $newfilename = "achievementstats.json";
        $local_path = $VPSFolder."ach/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        //echo "success";'titleId' => '1297287142',
        //achievements/stats/{titleId} 
        //Get user stats for a particular title   
        //{"arrangebyfield":"xuid","xuids":["2533274890702926"],"stats":[{"name":"MinutesPlayed","titleId":1717113201}]}
        //e.g. xbox.php?achievementstats=achievements/stats/137510457&APIKEY=
    }

    if(isset($SpecificGameAchievements))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($SpecificGameAchievements);
        $newfilename =   "SpecificGameAchievements.json";
        $local_path = $VPSFolder."ach/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        //echo "success";
        //achievements/title/{titleId} 
        //returns 150 items at a time. To page more data run /achievements/title/{titleId}/{continuationToken}
        //Get Specific Game Achievements  
    }
    
    if(isset($gameachievementshistory))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($gameachievementshistory);
        $newfilename = "gameachievementshistory.json";
        $local_path = $VPSFolder."ach/files/";
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //achievements/{titleId} 
        //returns game achievements history. If unsure of TitleId call /achievements first.
        //More games? use a comma like this: /achievements/100000,200000,300000
        //Get Game Achievements history  
    }

    /////////////////////////////////////////achievements Commands///////////////////////////////////////////////////////////////////////

    $party=@$_GET['party'];
    $partyInvite=@$_GET['partyInvite'];

    if(isset($party))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($party);
        $newfilename = "party.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";
        //party 
        //array of sessions the user is currently part of. I.e party chat rooms and their session config. values, summary of users in party.
    }

    if(isset($partyInvite))
    {
        $APIKey = new Api($API_KEY);
        print $data = $APIKey->get($partyInvite);
        $newfilename = "partyInvite.json";
        $local_path = $VPSFolder;
        // Write the contents back to the file
        file_put_contents($local_path.$newfilename, $data);
        echo "success";

        /*
        /party/invite/{sessionId/scid}
        Invite someone to party chat.
        If using this in your application first call "/party" to get a list of sessions (usually only 1) then call this endpoint to invite players to join the session. SessionName below is a value returned from /party
        Payload: {"xuid": "000000", "sessionName": ""}
        */
    }

     
?>
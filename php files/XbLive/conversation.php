<?php
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*GET varibles*/
    $conversations = @$_GET['conversations'];
    $NumberOfconversations = @$_GET['NumberOfconversations'];
    $UnreadConversations = @$_GET['UnreadConversations'];


    /*Json varibles*/ 
    $jsondata = file_get_contents('conversations.json');
    $json = json_decode($jsondata, true);
    $NumberOfconversation= $json['primary']['totalCount'];
    $UnreadConversation= $json['primary']['unreadCount'];
    //$test= $json['primary']['conversations'][0]['lastMessage']['contentPayload']['content']['parts'][0]['text'];
    //$test= $json['primary']['conversations']['isRead'];
    //print_r($test);
    //echo $test;

    if(isset($NumberOfconversations))
    {
        //print_r($NumberOfconversation);
        echo $NumberOfconversation;
    }

    if(isset($UnreadConversations))
    {
        //print_r($UnreadConversation);
        echo $UnreadConversation;
    }

    if(isset($conversations))
    {
       //$output = "ul>";
        $output;
        foreach($json['primary']['conversations'] as $people) {

            $output1 =  $people['conversationId'];/*ID that identifies conversation*/  
            $output2 =  $people['participants'][0];/*XUID of those who were in conversation*/         
            $output3 =  $people['lastMessage']['contentPayload']['content']['parts'][0]['text'];/*Message*/
            $output4 =  $people['isRead'];/*Has it been read?*/
            
            if($output4 = "1") {

                $isRead = "True";
            };

            echo "(MSG):", $output3, "(From XUID):", $output2, "(Read?):", $isRead, "(ConvoID):", $output1, "\n";

            //echo  "Message Details:", "\n";
            //echo  $output1, "\n";
            //echo  $output2, "\n";
            //echo  $output3, "\n";
            //echo  $isRead, "\n";/*Needs work, may not be correct*/
        }
        
        //$output .= "/ul>";
        
    }
?>
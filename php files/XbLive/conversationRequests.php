<?php
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }

    /*GET varibles*/
    $conversationsrequests = @$_GET['conversationsrequests'];
    $NumberOfconversations = @$_GET['NumberOfconversations'];
    $UnreadConversations = @$_GET['UnreadConversations'];


    /*Json varibles*/ 
    $jsondata = file_get_contents('conversationsrequests.json');
    $json = json_decode($jsondata, true);
    $NumberOfconversation= $json['totalCount'];
    $UnreadConversation= $json['unreadCount'];

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

    if(isset($conversationsrequests))
    {

        $output;
        foreach($json['conversations'] as $people) {

            $output1 =  $people['conversationId'];/*ID that identifies conversation*/  
            $output2 =  $people['participants'][0];/*XUID of those who were in conversation*/         
            $output3 =  $people['lastMessage']['contentPayload']['content']['parts'][0]['text'];/*Message*/
            $output4 =  $people['lastMessage']['lastUpdateTimestamp'];/*last time messsage was updated*/
            

            echo "(MSG):", $output3, "(From XUID):", $output2, "(TimeStamp):", $output4, "(ConvoID):", $output1, "\n";

        }

        
    }
?>
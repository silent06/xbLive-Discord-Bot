<!doctype html>
<html lang="en">
<head>
<title>Activity Feed</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
<link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <!--jQuery-->
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
      <!--Popper js-->
      <script src="js/popper.min.js"></script>
      <!--Bootstrap js-->
      <script src="js/bootstrap.min.js"></script>
      <!--Magnific popup js-->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!--jquery easing js-->
      <script src="js/jquery.easing.min.js"></script>
      <!--owl carousel js-->
      <script src="js/owl.carousel.min.js"></script>
      <!--custom js-->
      <script src="js/scripts.js"></script>
      <script src="cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script>
      $(window).on("load",function() {

        $(".se-pre-con").fadeOut("slow")

      });
    </script>
</head>
<body>
<div style="background-color:black;" class="se-pre-con"> </div>
<?php

    if(!isset($_SESSION))
    {
        session_start();
    }
    include('../config.php'); 
    include('../stealth/sql/Conn.php'); 
    //stealth\sql
    require __DIR__ . '/../vendor/autoload.php';
    use \OpenXBL\Api;
    
     /*GET varibles*/
    $API_KEY=@$_GET['APIKEY'];
    $ACH_XUID=@$_GET['ACHXUID'];
    $ActivityFeed=@$_GET['ActivityFeed'];
    $ActivityHistory=@$_GET['ActivityHistory'];
    $NumberoFHistory=@$_GET['NumberoFHistory'];
    $NumberoFActivity=@$_GET['numberofactivity'];

    /*Json Files */
    $newfilename =   "$ACH_XUID.json";

    $local_pathFeed = $LocalVpsFolder."activity/feed/";
    $local_pathHistory = $LocalVpsFolder."activity/history/";



    if(isset($ActivityFeed)) {
    /*Json varibles*/ 
    $jsondata = file_get_contents($local_pathFeed.$newfilename);
    $json = json_decode($jsondata, true);
    
    }

    if(isset($ActivityHistory)) {
        /*Json varibles*/ 
        $jsondata = file_get_contents($local_pathHistory.$newfilename);
        $json = json_decode($jsondata, true);
        
    }

    $output1; 
    if(isset($ActivityFeed)) 
    {
      if(!empty($json['activityItems'])) {
        $output2 ="<div><center><b style=color:red; text-align=center;><u> Activity Feed:  </u></center></div>";
        echo $output2;
        foreach ($json['activityItems'] as $people) {

            
            if(!empty($people['screenshotId'])) {

                $output1 .= "<b style=color:red;> ScreenShot of: <p><u> " .$people['contentTitle'].  " <span href= '".$people['screenshotThumbnail']." '> <img src= '".$people['screenshotThumbnail']."'  width=100 height=100 border=0 ></span></b></u></p> " ;
                //$output3 .= "<b style=color:red;><u> " .$people['timeline']['timelineName'].  " <span href= '".$people['itemImage']." '> <img src= '".$people['itemImage']."'  width=100 height=100 border=0 ></span></b></u>" ;
                $output1 .= "<b style=color:red;><u> Date: </u> "  .$people['date']. "</b>";
                $output1 .= "<b style=color:red;> "  .$people['ugcCaption']. "</b>";
                $output1 .= "<b style=color:red;><u>Views: </u> "  .$people['numViews']. "</b>";
            }


            if($people['postType'] == "Link") {
            //$output3 .="<center><b style=color:red;><u>   </u>";
            $output1 .= "<b style=color:red;> Club Post: <p><u> " .$people['description'].  " <span href= '".$people['itemImage']." '> <img src= '".$people['itemImage']."'  width=100 height=100 border=0 ></span></b></u></p> " ;
            //$output3 .= "<b style=color:red;><u> " .$people['timeline']['timelineName'].  " <span href= '".$people['itemImage']." '> <img src= '".$people['itemImage']."'  width=100 height=100 border=0 ></span></b></u>" ;
            $output1 .= "<b style=color:red;><u> Number of LIkes: </u> "  .$people['numLikes']. "</b>";
            $output1 .= "<b style=color:red;><u> Number of Comments: </u> "  .$people['numComments']. "</b>";
            $output1 .= "<b style=color:red;><u> Number of Views: </u> "  .$people['numViews']. "</b>";
            }
            else {


                $output1 .= "<b style=color:red;><u> " .$people['contentTitle'].  " <span href= '".$people['contentImageUri']." '> <img src= '".$people['contentImageUri']."'  width=100 height=100 border=0 ></span></b></u> " ;
                //$output1 .= "<b style=color:red;><u> " .$people['itemText'].  " <span href= '".$people['itemImage']." '> <img src= '".$people['itemImage']."'  width=100 height=100 border=0 ></span></b></u>" ;
                //$output1 .= "<a><span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."' width=100 height=100 border=0 />  </span></a> ";
                //description
                $output1 .= "<dt><b style=color:red; ><u> Title ID:  </u>"  .$people['titleId']. "</b> </dt>";
                $output1 .= "<dt><b style=color:red; ><u> Achievements Earned Date: </u>"  .$people['date']. "</b></dt>";
                $output1 .= "<dt><b style=color:red; ><u> Description:  </u>"  .$people['description']. "</b> </dt>";
                $output1 .= "<dt><b style=color:red;><u> Author: </u> "  .$people['authorInfo']['modernGamertag']. "</b</dt>";
                $output1 .= "<dt><b style=color:red;><u> Score Earned: </u> "  .$people['gamerscore']. "</b></dt>";
                $output1 .= "<dt><a><span href= '".$people['authorInfo']['imageUrl']." '> <img src= '".$people['authorInfo']['imageUrl']."' width=100 height=100 border=0 />  </span></a></dt>";
            }

        }
        foreach ($json['activityItems'] as $people) {



        }
        echo "<div >   
            <div id=stars>              
                <div id=stars2 >
                    <div id=star3 >
                
               
                    $output1
                    $output3
                    </div> 
                 </div> 
            </div>      
        
             </div>";

      }else {

        echo "<b style=color:red;>Sorry Unable to find your title records?? :( </b>";
      }

    } 



    $output1; 
    if(isset($ActivityHistory)) 
    {
      if(!empty($json['activityItems'])) {
        $output2 ="<div><center><b style=color:red; text-align=center;><u> Activity Feed:  </u></center></div>";
        echo $output2;
        foreach ($json['activityItems'] as $people) {
            $output1 .= "<b style=color:red;><u> " .$people['contentTitle'].  " <span href= '".$people['contentImageUri']." '> <img src= '".$people['contentImageUri']."'  width=100 height=100 border=0 ></span></b></u> " ;
            $output1 .= "<b style=color:red;><u> " .$people['itemText'].  " <span href= '".$people['itemImage']." '> <img src= '".$people['itemImage']."'  width=100 height=100 border=0 ></span></b></u>" ;
          //$output1 .= "<a><span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."' width=100 height=100 border=0 />  </span></a> ";
      
            $output1 .= "<dt><b style=color:red; ><u> Title ID:  </u>"  .$people['titleId']. "</b> </dt>";
            $output1 .= "<dt><b style=color:red; ><u> Achievements Earned Date: </u>"  .$people['date']. "</b></dt>";
            $output1 .= "<dt><b style=color:red;><u> Author: </u> "  .$people['authorInfo']['modernGamertag']. "</b</dt>";
            $output1 .= "<dt><b style=color:red;><u> Score Earned: </u> "  .$people['gamerscore']. "</b></dt>";
            $output1 .= "<dt><a><span href= '".$people['authorInfo']['imageUrl']." '> <img src= '".$people['authorInfo']['imageUrl']."' width=100 height=100 border=0 />  </span></a></dt>";
          //$output1 .= " <dt><b><u> Total Score: </b></u> "  .$people['achievement']['totalGamerscore']. "</dt> ";
          //$output1 .= " <dt><b><u> Player Progress: </b></u>"  .$people['achievement']['progressPercentage']. "%</dt> ";
                //<p>This is a paragraph.</p>
        }
        echo "<div >   
            <div id=stars>              
                <div id=stars2 >
                    <div id=star3 >
                
               
                    $output1
                    </div> 
                 </div> 
            </div>      
        
             </div>";

      }else {

        echo "<b style=color:red;>Sorry Unable to find your title records?? :( </b>";
      }

    } 
?>




</body>



</html>

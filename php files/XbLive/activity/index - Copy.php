<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Activity Feed</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="styles.css" />

<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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


</head>
<?php

    if(!isset($_SESSION))
    {
        session_start();
    }
    include('sql/Conn.php'); 
    require __DIR__ . '/../vendor/autoload.php';
    use \OpenXBL\Api;
    
     /*GET varibles*/
    $API_KEY=@$_GET['APIKEY'];
    $ACH_XUID=@$_GET['ACHXUID'];
    $ActivityFeed=@$_GET['ActivityFeed'];
    $achievementslist=@$_GET['achievementslist'];
    $achievementsSpecificlist=@$_GET['achievementsSpecificlist'];
    $gameachievementshistory=@$_GET['gameachievementshistory'];
    $achievementstats=@$_GET['achievementstats'];

    /*Json Files */
    $newfilename =   "$ACH_XUID.json";

    $local_pathFeed = "/var/www/html/XBLIO/activity/feed/";
    $local_pathHistory = "/var/www/html/XBLIO/activity/history/";


    if(isset($ActivityFeed)) {
    /*Json varibles*/ 
    $jsondata = file_get_contents($local_pathFeed.$newfilename);
    $json = json_decode($jsondata, true);
    
    }


?>


<body>
<div id="container">
<div id="header"><h1><a>Activity Feed:</a></h1></div>
  <div id="wrapper">
    <div id="content">
      <p><li><strong>
            <?php 
              
              $output1;
              if(isset($ActivityFeed)) 
              {
                if(!empty($json['activityItems'])) {

                  foreach ($json['activityItems'] as $people) {
                    $output1 .= " <dt><b style=color:red;><u> " .$people['contentTitle'].  " <span href= '".$people['contentImageUri']." '> <img src= '".$people['contentImageUri']."'  width=100 height=100 border=0 ></span></b></u></dt>  " ;
                    $output1 .= " <dt><b style=color:red;><u> " .$people['itemText'].  " <span href= '".$people['itemImage']." '> <img src= '".$people['itemImage']."'  width=100 height=100 border=0 ></span></b></u></dt>  " ;
                    //$output1 .= "<a><span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."' width=100 height=100 border=0 />  </span></a> ";
                
                    $output1 .= " <dt><b><u> Title ID: </b></u>"  .$people['titleId']. "</dt> ";
                    $output1 .= " <dt><b><u> Achievements Earned Date: </b></u>"  .$people['date']. "</dt> ";
                    $output1 .= " <dt><b><u> Author: </b></u> "  .$people['authorInfo']['modernGamertag']. "</dt>";
                    $output1 .= " <dt><b><u> Score Earned: </b></u> "  .$people['gamerscore']. "</dt> ";
                    $output1 .= "<a><span href= '".$people['authorInfo']['imageUrl']." '> <img src= '".$people['authorInfo']['imageUrl']."' width=100 height=100 border=0 />  </span></a> ";
                    //$output1 .= " <dt><b><u> Total Score: </b></u> "  .$people['achievement']['totalGamerscore']. "</dt> ";
                    //$output1 .= " <dt><b><u> Player Progress: </b></u>"  .$people['achievement']['progressPercentage']. "%</dt> ";
  
                  }
                  echo $output1;
                    //echo "<div id='stars'></div>  <div id='stars2'></div> <div id='stars3'></div> <div id='title'></div> ";


                }else {

                  echo "Sorry Unable to find your title records?? :(";
                }

              } 

              if(isset($achievementsSpecificlist)) 
              {
                  if(!empty($json2['achievements']))
                  {
                      foreach ($json2['achievements'] as $people) {
                        $output1 .= " <dt><b style=color:red;><u> Achievement Name: " .$people['name'].  " <span href= '".$people['mediaAssets'][0]['url']." '> <img src= '".$people['mediaAssets'][0]['url']."'  width=200 height=200 border=0 ></span></b></u></dt>" ;
                      //$output1 .= "<a><span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."' width=100 height=100 border=0 />  </span></a> ";
              
                        $output1 .= " <dt><b><u> ProgessSate: </b></u>"  .$people['progressState']. "</dt> ";
                        $output1 .= " <dt><b><u> Time Unlocked: </b></u>"  .$people['progression']['timeUnlocked']. "</dt> ";

                        $iSsecert = $people['isSecret'] ? "true":"false";
                        $output1 .= " <dt><b><u> isSecret?: </b></u> "  .$iSsecert. "</dt>";

                        $output1 .= " <dt><b><u> Description: </b></u> "  .$people['description']. "</dt> ";
                        $output1 .= " <dt><b><u> AchievementType: </b></u> "  .$people['achievementType']. "</dt> ";
                        $output1 .= " <dt><b><u> Rare?: </b></u>"  .$people['rarity']['currentCategory']. "</dt> ";
                        $output1 .= " <dt><b><u> Rare Percentage: </b></u>"  .$people['rarity']['currentPercentage']. "%</dt> ";
                        $output1 .= " <dt><b><u> GameScore: </b></u>"  .$people['rewards'][0]['value']. "</dt> ";
                        //$output1 .= " <dt><b><u> TotalRecords: </b></u>"  .$people['pagingInfo']['totalRecords']. "</dt> ";
                      }
                      $TotalRecords = "<b><u>  Total Number of Achievements:" .$json2['pagingInfo']['totalRecords']. "</b></u>";
                      $Moreinfo = "<b><u> Showing only 150. If theirs a number here means there's more than 150 achievements. Holy shit!" .$json2['pagingInfo']['continuationToken']. "</b></u>";
                      echo $TotalRecords;
                      echo $output1;
                      echo $Moreinfo;
                  }
                  else {

                    echo "Sorry Unable to find your title records?? :(";
                  }

              }   
              
              if(isset($achievements)) 
              {
                  if(!empty($json3['titles']))
                  {
                      foreach ($json3['titles'] as $people) 
                        {
                          $output1 .= " <dt><b style=color:red;><u> " .$people['name'].  " <span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."'  width=100 height=100 border=25 ></span></b></u></dt>  " ;
                          //$output1 .= "<a><span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."' width=100 height=100 border=0 />  </span></a> ";
              
                          $output1 .= " <dt><b><u> Title ID: </b></u>"  .$people['titleId']. "</dt> ";
                          $output1 .= " <dt><b><u> Achievements Earned: </b></u>"  .$people['achievement']['currentAchievements']. "</dt> ";
                          $output1 .= " <dt><b><u> Total Achievements: </b></u> "  .$people['achievement']['totalAchievements']. "</dt>";
                          $output1 .= " <dt><b><u> Current Score: </b></u> "  .$people['achievement']['currentGamerscore']. "</dt> ";
                          $output1 .= " <dt><b><u> Total Score: </b></u> "  .$people['achievement']['totalGamerscore']. "</dt> ";
                          $output1 .= " <dt><b><u> Player Progress: </b></u>"  .$people['achievement']['progressPercentage']. "%</dt> ";

                        }
                      echo $output1;
                      //echo "<div id='stars'></div>  <div id='stars2'></div> <div id='stars3'></div> <div id='title'></div> ";
                  
                  } 
                  else {

                    echo "Sorry Unable to find your title records?? :(";
                  }
                }

            
            
                if(isset($achievementstats)) 
                {
                    if(!empty($json4['groups']))
                    {
                      
                      $xbox = new Api($APIKEYForStats);
                      $data = $xbox->get('account');
                      $newfilename = "profile.json";
                      $local_path = "/xampp/htdocs/DizzyLive/XBLIO/ach/files/";
                      // Write the contents back to the file
                      file_put_contents($local_path.$newfilename, $data);
                      $jsondata5 = file_get_contents($local_path.$newfilename);
                      $json5 = json_decode($jsondata5, true);
                      
                      $gamertag = $json5['profileUsers'][0]['settings'][2]['value'];
                      $profilepicture = $json5['profileUsers'][0]['settings'][0]['value'];
                       
                       //echo "User Stats For: $gamertag";
                       echo " <dt><b style=color:red;><u> " .$gamertag.  " <span href= '".$profilepicture." '> <img src= '".$profilepicture."'  width=300 height=300 border=0 ></span></b></u></dt>  " ;

                        foreach ($json4['groups'] as $people) 
                        {
                            /*Gay way to do it for json but w/e */
                            $output1 .= " <dt><b><u> Title ID: </b></u>"  .$people['titleid']. "</dt> ";
                            $output1 .= " <dt> <u> Achievement Stats: </u> </dt> ";
                            $output1 .= " <dt><b style=color:red;> " .$people['statlistscollection'][0]['stats'][0]['value'].   " </b> ".$people['statlistscollection'][0]['stats'][0]['groupproperties']['DisplayName']. " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][1]['value'].  " </b> ".$people['statlistscollection'][0]['stats'][1]['groupproperties']['DisplayName']. " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u> </u>" .$people['statlistscollection'][0]['stats'][2]['value'].  " </b> ".$people['statlistscollection'][0]['stats'][2]['groupproperties']['DisplayName'].  " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][3]['value'].  " </b> ".$people['statlistscollection'][0]['stats'][3]['groupproperties']['DisplayName']. " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][4]['value'].  " </b> ".$people['statlistscollection'][0]['stats'][4]['groupproperties']['DisplayName']. " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>   </u>" .$people['statlistscollection'][0]['stats'][5]['value'].  "</b>  ".$people['statlistscollection'][0]['stats'][5]['groupproperties']['DisplayName']. " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][6]['value'].  " </b> ".$people['statlistscollection'][0]['stats'][6]['groupproperties']['DisplayName'].  " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][7]['value'].  "</b> ".$people['statlistscollection'][0]['stats'][7]['groupproperties']['DisplayName']. " </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u> </u>" .$people['statlistscollection'][0]['stats'][8]['value'].  " </b> " .$people['statlistscollection'][0]['stats'][8]['groupproperties']['DisplayName']." </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][9]['value'].  "</b>  ".$people['statlistscollection'][0]['stats'][9]['groupproperties']['DisplayName']." </dt> ";
                            $output1 .= " <dt><b style=color:red;> <u>  </u>" .$people['statlistscollection'][0]['stats'][10]['value'].  " </b> ".$people['statlistscollection'][0]['stats'][10]['groupproperties']['DisplayName']. " </dt> ";
                                           
                        }                         
                          echo $output1;
                  
                    } 
                    else {
  
                      echo "Sorry Unable to find your title records?? :(";
                    }
                  }
                
            ?>
      </strong></li></p>
    </div>
  </div>
  <div id="navigation">
  <p><strong>My Channels</strong></p>
    <ul>
      <p><img src="DBZ.jpg" width="15" height="15"> <i><u><a href="https://silentlive.gq">My Site</a></u></i></p>
      <p><img src="DBZ.jpg" width="15" height="15"> <i><u><a href="https://www.youtube.com/channel/UCuK4sEzg06MouCp_iMzYN4g">Youtube</a></u></i></p>
    </ul>
  </div>
  <div id="extra">
    <p><strong></strong></p>
    <p></p>
  </div>
  <div id="footer">
  <p class="txtcenter copy">by <a href="DBZ.jpg">@Silent#1917</a><br/>see also <a href="https://silentlive.gq">This</a></p>
  </div>
</div>
</body>
</html>

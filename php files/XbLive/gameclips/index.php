<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>GameClips</title>
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
    include('../config.php'); 
    $ACH_XUID=@$_GET['ACHXUID'];

    
    $gameclips=@$_GET['gameclips'];

    $gameclipsByXUID=@$_GET['gameclipsByXUID'];


    /*GET varibles*/
    $newfilename =   "$ACH_XUID.json";
    $newfilename2 =   "gameclips.json";
    $newfilename3 =   "gameclipsByXUID.json";
    $local_path = $LocalVpsFolder."gameclips/files/";


    if(isset($gameclips)) {
    /*Json varibles*/ 
    $jsondata = file_get_contents($local_path.$newfilename2);
    $json = json_decode($jsondata, true);
    
    }

    if(isset($gameclipsByXUID)) {
    $jsondata2 = file_get_contents($local_path.$newfilename);
    $json2 = json_decode($jsondata2, true);

    }

?>


<body>
<div id="container">
<div id="header"><h1><a>GameClips List:</a></h1></div>
  <div id="wrapper">
    <div id="content">
      <p><li><strong>
            <?php 
              
              $output1;
              if(isset($gameclips)) 
              {
                if(!empty($json['gameClips'])) {

                  foreach ($json['gameClips'] as $people) {

                    $output1 .= " <dt><b><u> Current State: </b></u>"  .$people['state']. "</dt> ";
                    $output1 .= " <dt><b><u> DatePublished: </b></u>"  .$people['datePublished']. "</dt> ";
                    $output1 .= " <dt><b><u> DateRecorded: </b></u> "  .$people['dateRecorded']. "</dt>";
                    $output1 .= " <dt><b><u> LastModified: </b></u> "  .$people['lastModified']. "</dt> ";
                    $output1 .= " <dt><b><u> Type: </b></u> "  .$people['type']. "</dt> ";
                    $output1 .= " <dt><b><u> Title ID: </b></u> "  .$people['titleId']. "</dt> ";
                    $output1 .= " <dt><b><u> Clip Name: </b></u> "  .$people['clipName']. "</dt> ";
                    $output1 .= " <dt><b><u> Title Name: </b></u> "  .$people['titleName']. "</dt> ";
                    $output1 .= " <dt><b><u> Duration: </b></u> "  .$people['durationInSeconds']. " Seconds</dt> ";
                    $output1 .= " <dt><b><u> AchievementId: </b></u> "  .$people['achievementId']. "</dt> ";
                    $output1 .= " <dt><b><u> Greatest Moment Recorded! id: </b></u> "  .$people['greatestMomentId']. "</dt> ";
                    $output1 .= " <dt><b><u> Expires: </b></u> "  .$people['gameClipUris'][0]['expiration']. "</dt> ";
                    $output1 .= " <dt><b style=color:red;><u> GameClipId: " .$people['gameClipId'].  " <span href= '".$people['thumbnails'][1]['uri']." '> <img src= '".$people['thumbnails'][1]['uri']."'  width=350 height=250 border=0 ></span></b></u></dt>  " ;                   
                    $output1 .= " <dt><b><u> CLip: </b></u></dt> ";
                    $output1 .= "<a><span href= '".$people['gameClipUris'][0]['uri']." '>  <video width=350 height=250 controls>  <source src= '".$people['gameClipUris'][0]['uri']."' type=video/mp4> /> </video>  </span></a> ";
                    
  
                  }
                  echo $output1;
                    //echo "<div id='stars'></div>  <div id='stars2'></div> <div id='stars3'></div> <div id='title'></div> ";


                }else {

                  echo "Sorry Unable to find your records?? :(";
                }

              } 

              if(isset($gameclipsByXUID)) 
              {
                  if(!empty($json2['gameClips']))
                  {
                      foreach ($json2['gameClips'] as $people) {
                        $output1 .= " <dt><b><u> Current State: </b></u>"  .$people['state']. "</dt> ";
                        $output1 .= " <dt><b><u> DatePublished: </b></u>"  .$people['datePublished']. "</dt> ";
                        $output1 .= " <dt><b><u> DateRecorded: </b></u> "  .$people['dateRecorded']. "</dt>";
                        $output1 .= " <dt><b><u> LastModified: </b></u> "  .$people['lastModified']. "</dt> ";
                        $output1 .= " <dt><b><u> Type: </b></u> "  .$people['type']. "</dt> ";
                        $output1 .= " <dt><b><u> Title ID: </b></u> "  .$people['titleId']. "</dt> ";
                        $output1 .= " <dt><b><u> Clip Name: </b></u> "  .$people['clipName']. "</dt> ";
                        $output1 .= " <dt><b><u> Title Name: </b></u> "  .$people['titleName']. "</dt> ";
                        $output1 .= " <dt><b><u> Duration: </b></u> "  .$people['durationInSeconds']. " Seconds</dt> ";
                        $output1 .= " <dt><b><u> AchievementId: </b></u> "  .$people['achievementId']. "</dt> ";
                        $output1 .= " <dt><b><u> Greatest Moment Recorded! id: </b></u> "  .$people['greatestMomentId']. "</dt> ";
                        $output1 .= " <dt><b><u> Expires: </b></u> "  .$people['gameClipUris'][0]['expiration']. "</dt> ";
                        $output1 .= " <dt><b style=color:red;><u> GameClipId: " .$people['gameClipId'].  " <span href= '".$people['thumbnails'][1]['uri']." '> <img src= '".$people['thumbnails'][1]['uri']."'  width=350 height=250 border=0 ></span></b></u></dt>  " ;                   
                        $output1 .= " <dt><b><u> CLip: </b></u></dt> ";
                        $output1 .= "<a><span href= '".$people['gameClipUris'][0]['uri']." '>  <video width=350 height=250 controls>  <source src= '".$people['gameClipUris'][0]['uri']."' type=video/mp4> /> </video>  </span></a> ";
                      }
                      
                      echo $output1;
                  }
                  else {

                    echo "Sorry Unable to find your Friends gameclips? :(";
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

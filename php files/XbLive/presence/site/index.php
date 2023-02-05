<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<title>Presence</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<!--?php require_once('Mobile_Detect.php'); $detect = new Mobile_Detect(); if ($detect->isMobile()) header("Location: mobile/index.php"); ?-->
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
<link rel="stylesheet" type="text/css" href="styles.css" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

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

<?php

    include('../../config.php');
    include('../../stealth/sql/Conn.php'); 
    require __DIR__ . '/../../vendor/autoload.php';
    use \OpenXBL\Api;

    $CPUKEYForStats = $_GET["CPUKEYForStats"];
    $APIKEYForStats;

    /*Get API Key */
    if(isset($CPUKEYForStats)) 
    {
      $sql = "SELECT * FROM `OpenXbl` WHERE `CPUKEY`='" . $CPUKEYForStats . "' LIMIT 1";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) 
      {
          while($row = $result->fetch_assoc())
          { 		        
            $APIKEYForStats=($row["APIKEY"]);
          
          }
      } 
      else   
      {
        echo "Not Registered";
      }
    }


    /*GET varibles*/
    $presenceList = @$_GET['presenceList'];
    
    /*Json varibles*/ 
    $jsondata = file_get_contents('../presence.json');
    $json = json_decode($jsondata, true);
  
?>

<body>
<div style="background-color:black;" class="se-pre-con"> </div>
<div id="container">
<div id="header"><h1><a>Presence List:</a></h1></div>
  <div id="wrapper">
    <div id="content"></div>
    <!--div id='title'> </div-->
      <p><li><strong> <?php 
      
        if(isset($presenceList)) 
        {
          if(!empty($json)) 
          {
            foreach ($json as $people) {

              $output2 =  $people['xuid'];
              $xuidinfo = "account/$output2";
              $xbox = new Api($APIKEYForStats);
  
              $data = $xbox->get($xuidinfo);
              $newfilename = "profile.json";
              $local_path = $LocalVpsFolder."presence/";
      
              // Write the contents back to the file
              file_put_contents($local_path.$newfilename, $data);
              $jsondata5 = file_get_contents($local_path.$newfilename);
              $json5 = json_decode($jsondata5, true);
              
              $gamertag = $json5['profileUsers'][0]['settings'][2]['value'];

              $output1 .= " <dt><b>B============================================D  </b></dt> ";
              $output1 .= " <dt><b style=color:red;><u> GamerTag: </b></u>"  .$gamertag. "</dt> ";             
              $output1 .= " <dt><b style=color:red;><u> State: </b></u>"  .$people['state']. "</dt> ";
              $output1 .= " <dt><b style=color:red;><u> Last Device Played?: </b></u> "  .$people['lastSeen']['deviceType']. "</dt> ";
              $output1 .= "<dt><b style=color:red;><u> Title Id: </b></u> "  .$people['lastSeen']['titleId']. "</dt> ";
              $output1 .= " <dt><b style=color:red;><u> Last Game Played: </b></u>"  .$people['lastSeen']['titleName']. "</dt> ";
              $output1 .= " <dt><b style=color:red;><u> Player Timestamp: </b></u>"  .$people['lastSeen']['timestamp']. "\n</dt> ";
              
            }
            echo $output1;  
          } 
          else {

            echo "Sorry Unable to find your records?? :(";
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

</body>
</html>

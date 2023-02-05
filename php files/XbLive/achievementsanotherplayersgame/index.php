<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Achievement</title>
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
      <script>
      $(window).on("load",function() {

        $(".se-pre-con").fadeOut("slow")

      });
    </script>

</head>
<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    include('../config.php'); 
    $ACH_XUID=@$_GET['ACHXUID'];

    $achievementsanotherplayersgame=@$_GET['achievementsanotherplayersgame'];

    /*GET varibles*/
    $newfilename =   "$ACH_XUID.json";
    $local_path = $LocalVpsFolder."achievementsanotherplayersgame/files/";

    /*Json varibles*/ 
    $jsondata = file_get_contents($local_path.$newfilename);
    $json = json_decode($jsondata, true);
 
?>

<body>
<div style="background-color:black;" class="se-pre-con"> </div>
<div id="container">
<div id="header"><h1><a>Achievement List:</a></h1></div>
  <div id="wrapper">
    <div id="content">
      <p><li><strong>
        <?php 

                 if(isset($achievementsanotherplayersgame)) 
                  {

                      if(!empty($json['achievements'])) {
                            $output1 = "<ul>"; 
                            $GameName = "<b style=color:red;><u>  Game Name:\n" .$json['achievements'][0]['titleAssociations'][0]['name']. "\n</b></u>";
                            echo $GameName;
                            $titleId = "<b style=color:purple;><u>  [TitleId:" .$json['achievements'][0]['titleAssociations'][0]['id']. "]</b></u>";
                            echo $titleId;
                            $output2 = "<H4><b><i><u>Showing User Achievement List For </u></i></b></H4>";
                            echo $output2;
                            $UserName = "<i>XUID: $ACH_XUID</i>";
                            echo  $UserName;
                            //$output1 ="<H4><b><i><u> $output2 </u> </i></b></H4>";
  
                            $output3 = "";
                            $output4 = "<H3><b><i><u> $output3 </u> </i></b></H3>";
                          //$output2 = "<ul>";
                          foreach($json['achievements'] as $people) {
                          
                          //$output1 .= " <dt><b style=color:red;><u> " .$people['name'].  " <span href= '".$people['displayImage']." '> <img src= '".$people['displayImage']."'  width=100 height=100 border=25 ></span></b></u></dt>  " ;
                          $output1 .= "<li>" .$people['name']. "</li>";
                          $output1 .= " <span href= '".$people['mediaAssets'][0]['url']."' > <a> <img src= '".$people['mediaAssets'][0]['url']."' width=100 height=100 border=25> </a> </span>";    
                    
                          $output1 .= " <dt><b><u> ProgessSate: </b></u>"  .$people['progressState']. "</dt> ";
                          $output1 .= " <dt><b><u> Time Unlocked: </b></u>"  .$people['progression']['timeUnlocked']. "</dt> ";
  
                          $iSsecert = $people['isSecret'] ? "true":"false";
                          $output1 .= " <dt><b><u> isSecret?: </b></u> "  .$iSsecert. "</dt>";
  
                          $output1 .= " <dt><b><u> Description: </b></u> "  .$people['description']. "</dt> ";
                          $output1 .= " <dt><b><u> AchievementType: </b></u> "  .$people['achievementType']. "</dt> ";
                          //$output1 .= " <dt><b><u> Rare?: </b></u>"  .$people['rarity']['currentCategory']. "</dt> ";
                          //$output1 .= " <dt><b><u> Rare Percentage: </b></u>"  .$people['rarity']['currentPercentage']. "%</dt> ";
                          $output1 .= " <dt><b><u> GameScore: </b></u>"  .$people['rewards'][0]['value']. "</dt> ";
                        }
                        $output1 .= "</ul>"; 
                        $TotalRecords = "<b><u>  Total Number of Achievements:" .$json['pagingInfo']['totalRecords']. "</b></u>";

                        echo $output4;
                        echo $output1;
                        echo $TotalRecords; 
                       

                         
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

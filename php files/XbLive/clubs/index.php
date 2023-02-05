<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Clubs</title>
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
    include('../stealth/sql/Conn.php'); 
    require __DIR__ . '/../vendor/autoload.php';
    use \OpenXBL\Api;
    $ACH_XUID=@$_GET['ACHXUID'];

    
    $clubsowned=@$_GET['clubsowned'];
    $clubsummary=@$_GET['clubsummary'];


    /*GET varibles*/
    $newfilename =   "$ACH_XUID.json";
    $local_path = $LocalVpsFolder."clubs/files/";


    if(isset($clubsowned)) {
    /*Json varibles*/ 
    $jsondata = file_get_contents($local_path.$newfilename);
    $json = json_decode($jsondata, true);
    
    }

    if(isset($clubsummary)) {
      /*Json varibles*/ 
      $jsondata = file_get_contents($local_path.$newfilename);
      $json = json_decode($jsondata, true);
      
    }


    $CPUKEYForStats = $_GET["CPUKEYForStats"];
    $APIKEYForStats;
    /*Get API Key */
    if(isset($CPUKEYForStats)) {
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


?>


<body>
<div style="background-color:black;" class="se-pre-con"> </div>
<div id="container">
<div id="header"><h1><a>Club List:</a></h1></div>
  <div id="wrapper">
    <div id="content">
      <p><li><strong>
            <?php 
              
              $output1;
              if(isset($clubsowned)) 
              {
                if(!empty($json['clubs'])) {

                  $xbox = new Api($APIKEYForStats);
                  $data = $xbox->get('account');
                  $newfilename = "profile.json";
                  $local_path = "/var/www/html/XBLIO/ach/files/";

                  // Write the contents back to the file
                  file_put_contents($local_path.$newfilename, $data);
                  $jsondata5 = file_get_contents($local_path.$newfilename);
                  $json5 = json_decode($jsondata5, true);
                  
                  $gamertag = $json5['profileUsers'][0]['settings'][2]['value'];
                  $profilepicture = $json5['profileUsers'][0]['settings'][0]['value'];
                   
                   //echo "User Stats For: $gamertag";
                   echo " <dt><b style=color:red;><u> " .$gamertag.  " <span href= '".$profilepicture." '> <img src= '".$profilepicture."'  width=300 height=300 border=0 ></span></b></u></dt>  " ;

                  foreach ($json['clubs'] as $people) {
                    $output1 .= " <dt><b style=color:red;><u> Club: </b></u></dt> ";
                    $output1 .= " <dt><b><u> Name: </b></u>"  .$people['name']. "</dt> ";
                    $output1 .= " <dt><b><u> Created: </b></u>"  .$people['created']. "</dt> ";
                    $output1 .= " <dt><b><u> Genre: </b></u>"  .$people['genre']. "</dt> ";
                    $output1 .= " <dt><b><u> ClubId: </b></u>"  .$people['id']. "</dt> ";
                  }
                  echo $output1;
                    //echo "<div id='stars'></div>  <div id='stars2'></div> <div id='stars3'></div> <div id='title'></div> ";


                }else {

                  echo "Sorry Unable to find your records?? :(";
                }

              } 

              if(isset($clubsummary)) 
              {
                  if(!empty($json['clubs']))
                  {
                      foreach ($json['clubs'] as $people) {
                        $output1 .= " <dt><b style=color:red;><u> Club: </b></u></dt> ";
                        $output1 .= " <dt><b><u>  </b></u>"  .$people['profile']['name']['value']. "</dt> ";
                        $output1 .= " <dt><b><u> Private/Public/Hidden: </b></u>"  .$people['clubType']['type']. "</dt> ";
                        $output1 .= " <dt><b><u> CreationDate: </b></u>"  .$people['creationDateUtc']. "</dt> ";
                        $output1 .= " <dt><b><u> Member Count: </b></u>"  .$people['membersCount']. "</dt> ";                                        
                        $output1 .= "<dt><b><u> <span href= '".$people['profile']['displayImageUrl']['value']." '> <img src= '".$people['profile']['displayImageUrl']['value']."'  width=300 height=300 border=0 ></span></b></u></dt>  ";
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

<?php
    header('Content-type: text/plain');
    if(!isset($_SESSION))
    {
        session_start();
    }
    include('../stealth/sql/Conn.php'); 
    include('../config.php');
    require __DIR__ . '/../vendor/autoload.php';
    use \OpenXBL\Api;

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



    /*GET varibles*/
    $presenceList = @$_GET['presenceList'];
    $NumberOfpresence = @$_GET['NumberOfpresence'];

    /*Json varibles*/ 
    $jsondata = file_get_contents('presence.json');
    $json = json_decode($jsondata, true);

    if(isset($NumberOfpresence)) {

        echo count($json['people']), "\n";
    }

    if(isset($presenceList)) {

        $output1; $output2;
        $i = 0;
        foreach($json as $people) {
            $output1 =  $people['xuid'];
            $output2 =  $people['state'];
            $xuidinfo = "account/$output1";
            $xbox = new Api($APIKEYForStats);

            $data = $xbox->get($xuidinfo);
            $newfilename = "profile.json";
            $local_path = $LocalVpsFolder."presence/";
    
            // Write the contents back to the file
            file_put_contents($local_path.$newfilename, $data);
            $jsondata5 = file_get_contents($local_path.$newfilename);
            $json5 = json_decode($jsondata5, true);
            
            $gamertag = $json5['profileUsers'][0]['settings'][2]['value'];


            $i++;
            echo "Gamertag:", $gamertag,"  ", "($output2)", "\n";  
            if($i==30) break;
        }  
    }

?>
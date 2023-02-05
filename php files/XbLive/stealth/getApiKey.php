<?php
    include('sql/Conn.php'); 
    /* symbol @ will supress any warning messages */
    $CPUKEY = @$_GET["CPUKEY"];
    $APIKEY = @$_GET["APIKEY"];

    /*Get API Key */
    if(isset($APIKEY)) {
        $sql = "SELECT * FROM `OpenXbl` WHERE `CPUKEY`='" . $APIKEY . "' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {		        
                echo($row["APIKEY"]);
	        }
        }
        else   
        {
    	    echo "Not Registered";
        }
    }
    /*Check API Key */
    if(isset($CPUKEY)) {
        $sql = "SELECT * FROM `OpenXbl` WHERE `CPUKEY`='" . $CPUKEY . "' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
		        $row["APIKEY"];
                echo "APIKEY Already in database";
	        }
        }
        else   
        {
    	    echo "Not Registered";
        }
    }
?>
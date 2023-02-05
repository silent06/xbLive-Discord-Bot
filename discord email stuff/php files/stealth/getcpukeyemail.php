<?php
include('tps825664opaa/Conn.php'); 

$discordid = $_GET["Discord"];

$sql = "SELECT * FROM `authed-clients` WHERE `Username`='" . $discordid . "' LIMIT 1";
$result = $conn->query($sql);
            
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		echo($row["CPUKey"]);
	}
}else{
	echo "Not Registered";
}
?>
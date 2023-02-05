<?php
include('sql/Conn.php'); 

$discordid = $_GET["Discord"];

$sql = "SELECT * FROM `users` WHERE `discordid`='" . $discordid . "' LIMIT 1";
$result = $conn->query($sql);
            
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		echo($row["Username"]);
	}
}else{
	echo "Not Registered";
}
?>
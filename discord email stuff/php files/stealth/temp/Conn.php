<?php
//MySQLI
$conn = mysqli_connect("root.silent.hosted.nfoservers.com", "silentwebhost", "", "silentwebhost_dizzy");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
?>
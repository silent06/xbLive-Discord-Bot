<?php
if (!$socket = @fsockopen("192.99.58.184", 2000, $errno, $errstr, 1))
{
  echo "Server Offline :white_check_mark:";
  echo "XKE API Offline :white_check_mark:";
  echo "XOSC API Offline :white_check_mark:";
}
else 
{
  echo "Server Online :white_check_mark:";
  echo "XKE API Online :white_check_mark:";
  echo "XOSC API Online :white_check_mark:";
  fclose($socket);
}
?>
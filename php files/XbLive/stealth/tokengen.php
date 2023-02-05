<?php
include "sql/Conn.php";
// TURN OFF STRICT MYSQL MODE
$strict = "SET sql_mode = ''";
 mysqli_query($conn, $strict);
	function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
	{
		$str = '';
		$count = strlen($charset);
			while ($length--) {
			    $str .= $charset[mt_rand(0, $count-1)];
			}
			return $str;
	}

    $token_semi_quantity = 0;
    $token_combo = 1;
    while($token_semi_quantity < $token_combo)
    {
        $token = randString(12);
        $token_semi_quantity++;

        $token_time = (int) $_GET['days'];
        $timestamp = $token_time * 86400;
        $insert_token = mysqli_query($conn, "INSERT INTO `redeem_tokens`(`id`, `token`, `seconds_to_add`) VALUES ('NULL', '".$token."','".$timestamp."')");

        if($insert_token) {
            echo $token;
        }						
        else
        {
            echo "Failed!";
        }
    }
				
?>
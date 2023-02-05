<?php

    /*OpenXbl Api Variables */
    require __DIR__ . '/vendor/autoload.php';
    use \OpenXBL\Api;


	$xbox = new Api('ksg0wgwcwssskc488osgsskww4s80wowc0g');

	print_f $xbox->get('friends/add/2535424927066883');

?>
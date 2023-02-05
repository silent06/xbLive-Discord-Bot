# xbLive-Discord-Bot

Built using MS .NEt 2.1 https://dotnet.microsoft.com/en-us/download/dotnet/2.1 I dont have any plans to update this. 


Discord ApiKey goes here-
![image](https://user-images.githubusercontent.com/44829491/216850311-345dac86-f5a2-4d27-a28e-dcd0f96bbfb3.png)

Also provided openXbl support. Go to https://xbl.io/ to setup login & obtain APIkey. Put OpenXbl APIkey into config.ini.
![image](https://user-images.githubusercontent.com/44829491/216850391-2febab86-a68e-4db9-8f0b-83877947f8fb.png)




To use OpenXbl backend php files you'll need to setup your webserver using https://github.com/OpenXBL/OpenXBL-PHP


if you get a composer error could not find package matching minimum php version? 


This should fix it-
https://php.watch/articles/composer-ignore-platform-req


dont forget to set VPSString webstring found in config.php & set sql info in XbLive\stealth\sql\Conn.php



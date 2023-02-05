using System;
using System.Collections.Generic;
using System.Text;

namespace stealthbot
{
    class config
    {
        internal static class Global
        {
            internal static bool httpRequestA;
            internal static bool debug;

            //Bot Color
            internal static int RGB1 = 32;
            internal static int RGB2 = 82;
            internal static int RGG3 = 91;

            //Bot Settings
            internal static string BotName = "xblive";
            internal static string prefix = "$";
  
            /*OpenXbl API key*/
            internal static string ApiKey = "";

            /*Your VPS URL*/
            internal static string VPSString = "http://" + OpenXBL.VPS + "/";

            /*OpenXbl URL strings*/
            internal static string CheckXBLAccount = "account";
            internal static string XboxProfileSearch = "friends/search?gt=";
            internal static string GetScreenshots = "dvr/screenshots";
            internal static string ClubOwned = "clubs/owned";
            internal static string ClubSearch = "clubs/find?q=";
            internal static string ClubCreate = "clubs/create";
            internal static string ClubSummary = "clubs/";
            internal static string AddFriendCMD = "friends/add/";
            internal static string RemoveFriendCMD = "friends/remove/";

            /*OpenXbl Api Key*/
            internal static string OpebXblApiToken = "";

            /*Univesal stuff*/
            internal static string CPUKey = VPSString + "xblive/stealth/getcpukey.php?discordid=";
            internal static string CheckApiKey = VPSString + "xblive/stealth/getApiKey.php?CPUKEY=";
            internal static string GetApikey = VPSString + "xblive/stealth/getApiKey.php?APIKEY=";
            
            /*Embeded Images*/
            internal static string EmbededImage = "https://images.pexels.com/photos/3165335/pexels-photo-3165335.jpeg?cs=srgb&dl=pexels-lucie-liz-3165335.jpg&fm=jpg";

            /*ActivityFeed*/
            internal static string ActivityFeedDL = VPSString + "xblive/xbox.php?ActivityFeed=activity/feed&APIKEY=";
            internal static string ActivityFeedUserString = VPSString + "xblive/activity/?ActivityFeed&ACHXUID=";
            internal static string NumberoFPosts = VPSString + "xblive/activity/stats.php?NumberoFActivity&ACHXUID=";

            /*ActivityHistory*/
            internal static string ActivityHistoryDL = VPSString + "xblive/xbox.php?Activityhistory=activity/history&APIKEY=";
            internal static string ActivityHistoryUserString = VPSString + "xblive/activity/?ActivityHistory&ACHXUID=";
            internal static string NumberoFPostsh = VPSString + "xblive/activity/stats.php?NumberoFHistory&ACHXUID=";


            /*GameClips*/
            internal static string ClipListdownload = VPSString + "xblive/xbox.php?gameclips=dvr/gameclips";
            internal static string ClipUserString = VPSString + "xblive/gameclips/?gameclips";

            /*GameClips of Friends*/
            internal static string GameclipsByXUIDdownload = VPSString + "xblive/xbox.php?friendsgameclips=dvr/gameclips/?xuid=";
            internal static string GameclipsByXUIDUserString = VPSString + "xblive/gameclips/?gameclipsByXUID&ACHXUID=";

            /*AddFriend RemoveFriend*/
            internal static string AddFriend = VPSString + "xblive/xbox.php?AddFriend=friends/add/";
            internal static string RemoveFriend = VPSString + "xblive/xbox.php?RemoveFriend=friends/remove/";

            /*GetUserByXuid*/
            internal static string GetUserByXuid = VPSString + "xblive/xbox.php?userprofile=account/";
            internal static string GamerScoreS = VPSString + "xblive/xuidSearch.php?gamerscore";
            internal static string profilepictures = VPSString + "xblive/xuidSearch.php?profilepicture";
            internal static string gamertag = VPSString + "xblive/xuidSearch.php?gamertag";
            internal static string AccountTier = VPSString + "xblive/xuidSearch.php?AccountTier";
            internal static string XboxOneRep = VPSString + "xblive/xuidSearch.php?XboxOneRep";
            internal static string Bio = VPSString + "xblive/xuidSearch.php?Bio";

            /*XboxProfile*/
            internal static string xboxprofile = VPSString + "xblive/xbox.php?downloadinfo=friends/search?gt=";
            internal static string xboxprofileGamerScore = VPSString + "xblive/xbox.php?gamerscore";
            internal static string xuids = VPSString + "xblive/xbox.php?xuid";
            internal static string xboxprofileprofilepictures = VPSString + "xblive/xbox.php?profilepicture";
            internal static string xboxprofileGamertag = VPSString + "xblive/xbox.php?gamertag";
            internal static string xboxprofileAccountTier = VPSString + "xblive/xbox.php?AccountTier";
            internal static string xboxprofileXboxOneRep = VPSString + "xblive/xbox.php?XboxOneRep";
            internal static string xboxprofileBio = VPSString + "xblive/xbox.php?Bio";
            internal static string tenurelevel = VPSString + "xblive/xbox.php?tenurelevel";

            /*GetAchievementStats*/
            internal static string GetAchievementStatsD = VPSString + "xblive/xbox.php?achievementstats=achievements/stats/";
            internal static string GetAchievementStatsUserString = VPSString + "xblive/ach/?achievementstats&CPUKEYForStats=";

            /*GetPlayerAchievementTitle*/
            internal static string GetPlayerAchievementTitle = VPSString + "xblive/xbox.php?SpecificGameAchievements=/achievements/title/";
            internal static string GetPlayerUserString = VPSString + "xblive/ach/?achievementsSpecificlist";

            /*Requestfriendslist*/
            internal static string friendslistdownload = VPSString + "xblive/xbox.php?anotherfriendlist=friends?xuid=";
            internal static string friendslist = VPSString + "xblive/friendslist.php?anotherfriendlist";
            internal static string friendsNumberOfFriends = VPSString + "xblive/friendslist.php?FNumberOfFriends";

            /*friendslist from ApiKey*/
            internal static string Userfriendslistdownload = VPSString + "xblive/xbox.php?friendlist=friends&APIKEY=";
            internal static string Userfriendslist = VPSString + "xblive/friendslist.php?friendsList";
            internal static string NumberOfFriends = VPSString + "xblive/friendslist.php?NumberOfFriends";

            /*Send Msg*/
            internal static string sendmsg = VPSString + "xblive/xbox.php?sendaconversation=";

            /*Xbox Messages*/
            internal static string Conversationslistdownload = VPSString + "xblive/xbox.php?conversations=conversations&APIKEY=";
            internal static string Conversations = VPSString + "xblive/conversation.php?conversations";
            internal static string NumberOfConversations = VPSString + "xblive/conversation.php?NumberOfconversations";
            internal static string UnreadConversations = VPSString + "xblive/conversation.php?UnreadConversations";

            /*Xbox Message Requests*/
            internal static string RequestsConversationslistdownload = VPSString + "xblive/xbox.php?conversationsrequests=conversations/requests&APIKEY=";
            internal static string RequestsConversations = VPSString + "xblive/conversationRequests.php?conversationsrequests";
            internal static string RequestsNumberOfConversations = VPSString + "xblive/conversationRequests.php?NumberOfconversations";
            internal static string RequestsUnreadConversations = VPSString + "xblive/conversationRequests.php?UnreadConversations";

            /*Player Summary*/
            internal static string PlayerSummarydownload = VPSString + "xblive/xbox.php?playersummary=player/summary&APIKEY=";
            internal static string PlayerSummaryGamerScoreS = VPSString + "xblive/playersummary.php?gamerscore";
            internal static string PlayerSummaryprofilepictures = VPSString + "xblive/playersummary.php?profilepicture";
            internal static string PlayerSummarygamertag = VPSString + "xblive/playersummary.php?gamertag";
            internal static string PlayerSummaryxuid = VPSString + "xblive/playersummary.php?xuid";
            internal static string PlayerSummaryXboxOneRep = VPSString + "xblive/playersummary.php?XboxOneRep";
            internal static string PlayerSummarypresenceState = VPSString + "xblive/playersummary.php?presenceState";
            internal static string PlayerSummarypresenceText = VPSString + "xblive/playersummary.php?presenceText";
            internal static string PlayerSummarypresenceDevices = VPSString + "xblive/playersummary.php?presenceDevices";

            /*Presence*/
            internal static string Presencedownload = VPSString + "xblive/xbox.php?presence=Presence&APIKEY=";
            internal static string presence = VPSString + "xblive/presence/presence.php?presenceList&CPUKEYForStats=";
            internal static string presencelink = VPSString + "xblive/presence/site/?presenceList&CPUKEYForStats=";

            /*GetFriendsPresence*/
            internal static string GetFriendsPresencedownload = VPSString + "xblive/xbox.php?Multipeople=";
            internal static string GetFriendsPresence = VPSString + "xblive/presence/multipresence.php?Multipeople&ACHXUID=";

            /*Achievements*/
            internal static string Achievementdownload = VPSString + "xblive/xbox.php?achievements=/achievements/";
            internal static string AchievementsUserString = VPSString + "xblive/ach/?achievements";


            /*GetPlayerAchievement*/
            internal static string GetPlayerAchievementListdownload = VPSString + "xblive/xbox.php?achievementslist=achievements/player/";
            internal static string UserXUIDString = VPSString + "xblive/ach/?achievementslist&ACHXUID=";

            /*GetAchievementTitleHistory*/
            internal static string GetAchievementTitleHistorydownload = VPSString + "xblive/xbox.php?gameachievementshistory=/achievements/";
            internal static string lastUnlock = VPSString + "xblive/ach/history.php?gameachievementshistory&lastUnlock";
            internal static string titleId = VPSString + "xblive/ach/history.php?gameachievementshistory&titleId";
            internal static string titleType = VPSString + "xblive/ach/history.php?gameachievementshistory&titleType";
            internal static string GetAchievementTitleName = VPSString + "xblive/ach/history.php?gameachievementshistory&name";
            internal static string earnedAchievements = VPSString + "xblive/ach/history.php?gameachievementshistory&earnedAchievements";
            internal static string currentGamerscore = VPSString + "xblive/ach/history.php?gameachievementshistory&currentGamerscore";
            internal static string maxGamerscore = VPSString + "xblive/ach/history.php?gameachievementshistory&maxGamerscore";
            internal static string rarityCategory1 = VPSString + "xblive/ach/history.php?gameachievementshistory&rarityCategory1";
            internal static string isRarestCategory = VPSString + "xblive/ach/history.php?gameachievementshistory&isRarestCategory";
            internal static string rarityCategory2 = VPSString + "xblive/ach/history.php?gameachievementshistory&rarityCategory2";
            internal static string isRarestCategory2 = VPSString + "xblive/ach/history.php?gameachievementshistory&isRarestCategory2";
            internal static string totalOfUnlocks2 = VPSString + "xblive/ach/history.php?gameachievementshistory&totalOfUnlocks2";

            /*GetPlayersACHGame*/
            internal static string achievementsanotherplayersgamedownload = VPSString + "xblive/xbox.php?achievementsanotherplayersgame=achievements/player/";
            internal static string GetPlayersUserXUIDString = VPSString + "xblive/achievementsanotherplayersgame/?achievementsanotherplayersgame&ACHXUID=";

            /*RecentPlayers*/
            internal static string RecentPlayersdownload = VPSString + "xblive/xbox.php?recentplayers=recent-players&APIKEY=";
            internal static string RecentPlayers = VPSString + "xblive/recentplayers.php?recentplayers";

            /*ReserveClub*/
            internal static string resverClub = VPSString + "xblive/xbox.php?reserveClub=clubs/reserve&clubName=";


            /*ClubsIOwn*/
            internal static string ClubsIOwndownload = VPSString + "xblive/xbox.php?clubsowned=clubs/owned&ACHXUID=";
            internal static string ClubUserXUIDString = VPSString + "xblive/clubs/?clubsowned&ACHXUID=";

            /*ClubSummary*/
            internal static string ClubSummaryDL = VPSString + "xblive/xbox.php?clubs=clubs/";
            internal static string ClubSummaryUserString = VPSString + "xblive/clubs/?clubsummary&ACHXUID=";
        }

        public struct hookah
        {
            public string profileUsers { get; set; }
            public string settings { get; set; }
            public string value { get; set; }

        };
    }
}

using Discord;
using Discord.Commands;
using System;
using System.Net;
using System.Threading.Tasks;
using System.Linq;
using Discord.Net;
using Discord.WebSocket;
//using Discord.Interactions;
using stealthbot;
using System.IO;
using System.Collections.Generic;
using Newtonsoft.Json;
using System.Text.Json;
using Newtonsoft.Json.Linq;

namespace XbLiveDiscordBot
{

    public class OpenXbl : ModuleBase<SocketCommandContext>
    {
        EmbedBuilder Embed = new EmbedBuilder();
        EmbedBuilder Embed2 = new EmbedBuilder();

        [Command("account")]
        public async Task account()
        {

            try
            {

                string CPUKey = new WebClient().DownloadString(config.Global.CPUKey + "<@!" + Context.User.Id + ">");
                string GetApikey = new WebClient().DownloadString(config.Global.GetApikey + CPUKey);
                var httpResponse = OpenXblHttp.RestClient.makeRequestAsync(config.Global.CheckXBLAccount, "null", GetApikey, config.Global.httpRequestA = true);

                /*using (StreamReader r = new StreamReader("account.json")) {
                    string json = r.ReadToEnd();
                }*/
                string json = OpenXblHttp.RestClient.strResponseValue;
                var doc = JsonDocument.Parse(json);
                var xuid = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("hostId");
                var profilepicture = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[0].GetProperty("value");
                var gamerscore = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[1].GetProperty("value");
                var gamertag = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[2].GetProperty("value");
                var AccountTier = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[3].GetProperty("value");
                var XboxOneRep = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[4].GetProperty("value");
                //var PreferredColor = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[5].GetProperty("value");
                var RealName = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[6].GetProperty("value");
                var Bio = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[7].GetProperty("value");
                var tenurelevel = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[8].GetProperty("value");

                Embed.AddField("GamerScore:", gamerscore, true);
                Embed.AddField("XUID:", (xuid.GetString(), "HEX:", Tools.StringToHex(xuid.GetString())), true);
                Embed.WithImageUrl(profilepicture.GetString());
                Embed.AddField("gamertag:", gamertag + ".", true);
                Embed.AddField("AccountTier:", AccountTier + ".", true);
                Embed.AddField("XboxOneRep:", XboxOneRep + ".", true);
                Embed.AddField("Bio:", Bio + ".", true);/* period is for discords BS no empty string garbage"*/
                Embed.AddField("Tenurelevel:", tenurelevel + ".", true);
                Embed.WithThumbnailUrl(Context.User.GetAvatarUrl() ?? Context.User.GetDefaultAvatarUrl());
                await Context.Channel.SendMessageAsync("", false, Embed.Build());

            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message : "server is offline");/*Use for Debugging*/
            }

        }

        [Command("GetUserByXuid")]
        public async Task GetUserByXuiddownload(string XUID)
        {

            string GetUserByXuid = new WebClient().DownloadString(config.Global.GetUserByXuid + XUID);
            string GamerScoreS = new WebClient().DownloadString(config.Global.GamerScoreS);
            string profilepictures = new WebClient().DownloadString(config.Global.profilepictures);
            string gamertag = new WebClient().DownloadString(config.Global.gamertag);
            string AccountTier = new WebClient().DownloadString(config.Global.AccountTier);
            string XboxOneRep = new WebClient().DownloadString(config.Global.XboxOneRep);
            string Bio = new WebClient().DownloadString(config.Global.Bio);
            string download = null;

            try
            {
                download = GetUserByXuid;

                // check if download was successful
                if (download == null)
                {
                    await ReplyAsync("Failed to download Profile Info");
                    return;
                }

                if (GamerScoreS == "") { GamerScoreS = "Unknown"; }
                if (profilepictures == "") { profilepictures = "Unknown"; }
                if (gamertag == "") { gamertag = "Unknown"; }
                if (AccountTier == "") { AccountTier = "Unknown"; }
                if (XboxOneRep == "") { XboxOneRep = "Unknown"; }
                if (Bio == "") { Bio = "Unknown"; }

                Embed.AddField("GamerScore:", GamerScoreS, true);
                Embed.AddField("XUID:", (XUID, "HEX:", Tools.StringToHex(XUID)), true);
                Embed.WithImageUrl(profilepictures);
                Embed.AddField("gamertag:", gamertag, true);
                Embed.AddField("AccountTier:", AccountTier, true);
                Embed.AddField("XboxOneRep:", XboxOneRep, true);
                Embed.AddField("Bio:", Bio, true);
                Embed.WithThumbnailUrl(Context.User.GetAvatarUrl() ?? Context.User.GetDefaultAvatarUrl());
                await Context.Channel.SendMessageAsync("", false, Embed.Build());
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? "server is offline" : ex.Message);/*Use for Debugging*/
            }

        }

        [Command("XboxProfile")]
        public async Task xboxprofiledownload(string profile)
        {

            var httpResponse = OpenXblHttp.RestClient.makeRequestAsync(config.Global.XboxProfileSearch + profile, "null", config.Global.ApiKey, config.Global.httpRequestA = true);
            string json = OpenXblHttp.RestClient.strResponseValue;
            var doc = JsonDocument.Parse(json);
            var xuid = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("hostId");
            var profilepicture = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[0].GetProperty("value");
            var gamerscore = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[1].GetProperty("value");
            var gamertag = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[2].GetProperty("value");
            var AccountTier = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[3].GetProperty("value");
            var XboxOneRep = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[4].GetProperty("value");
            //var PreferredColor = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[5].GetProperty("value");
            var RealName = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[6].GetProperty("value");
            var Bio = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[7].GetProperty("value");
            var tenurelevel = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("settings")[8].GetProperty("value");


            try
            {
                Embed.AddField("GamerScore:", gamerscore, true);
                Embed.AddField("XUID:", (xuid.GetString(), "HEX:", Tools.StringToHex(xuid.GetString())), true);
                Embed.WithImageUrl(profilepicture.GetString());
                Embed.AddField("gamertag:", gamertag + ".", true);
                Embed.AddField("AccountTier:", AccountTier + ".", true);
                Embed.AddField("XboxOneRep:", XboxOneRep + ".", true);
                Embed.AddField("Bio:", Bio + ".", true);
                Embed.AddField("Tenurelevel:", tenurelevel + ".", true);
                Embed.WithThumbnailUrl(Context.User.GetAvatarUrl() ?? Context.User.GetDefaultAvatarUrl());
                await Context.Channel.SendMessageAsync("", false, Embed.Build());
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message : "server is offline");/*Use for Debugging*/
            }

        }

        [Command("AddFriend")]
        public async Task AddFriendCommand(string AddFriend)
        {
            string CPUKey = new WebClient().DownloadString(config.Global.CPUKey + "<@!" + Context.User.Id + ">");
            string CheckApiKey = new WebClient().DownloadString(config.Global.CheckApiKey + CPUKey);
            string GetApikey = new WebClient().DownloadString(config.Global.GetApikey + CPUKey);
            var httpResponse = OpenXblHttp.RestClient.makeRequestAsync(config.Global.XboxProfileSearch + AddFriend, "null", GetApikey, config.Global.httpRequestA = true);
            string json = OpenXblHttp.RestClient.strResponseValue;
            var doc = JsonDocument.Parse(json);
            var xuid = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("hostId");
            ClientInfo Client = new ClientInfo();
            bool Exists = mysql.GetClientData(CPUKey, ref Client);
            // OpenXBL getxbldata = new OpenXBL();
            EmbedBuilder Embed = new EmbedBuilder();
            try
            {
                if (CPUKey == "Not Registered")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Register yourself");
                    Embed.WithFooter(config.Global.BotName);
                    Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your cpukey with : **{config.Global.prefix}link CPUKey**.");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else
                {

                    if (CheckApiKey == "APIKEY Already in database")
                    {
                        var httpAddFriend = OpenXblHttp.RestClient.makeRequestAsync(config.Global.AddFriendCMD + xuid, "null", GetApikey, config.Global.httpRequestA = true);
                        Embed.AddField("Friend Added:", AddFriend, true);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else if (CheckApiKey == "Not Registered")
                    {

                        Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                        Embed.WithAuthor("Register yourself https://xbl.io then Message the bot to link key ");
                        Embed.WithFooter(config.Global.BotName);
                        Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your API_KEY with : **{config.Global.prefix}AddApiKey API_KEY**.");
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message : "server is offline");/*Use for Debugging*/
            }
        }

        [Command("RemoveFriend")]
        public async Task RemoveCommand(string RemoveFriend)
        {
            string CPUKey = new WebClient().DownloadString(config.Global.CPUKey + "<@!" + Context.User.Id + ">");
            string CheckApiKey = new WebClient().DownloadString(config.Global.CheckApiKey + CPUKey);
            string GetApikey = new WebClient().DownloadString(config.Global.GetApikey + CPUKey);
            var httpResponse = OpenXblHttp.RestClient.makeRequestAsync(config.Global.XboxProfileSearch + RemoveFriend, "null", GetApikey, config.Global.httpRequestA = true);
            string json = OpenXblHttp.RestClient.strResponseValue;
            var doc = JsonDocument.Parse(json);
            var xuid = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("hostId");

            ClientInfo Client = new ClientInfo();
            bool Exists = mysql.GetClientData(CPUKey, ref Client);
            EmbedBuilder Embed = new EmbedBuilder();
            try
            {
                if (CPUKey == "Not Registered")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Register yourself");
                    Embed.WithFooter(config.Global.BotName);
                    Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your cpukey with : **{config.Global.prefix}link CPUKey**.");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else
                {

                    if (CheckApiKey == "APIKEY Already in database")
                    {                       
                        var httpRemoveFriend = OpenXblHttp.RestClient.makeRequestAsync(config.Global.RemoveFriendCMD + xuid, "null", GetApikey, config.Global.httpRequestA = true);
                        Embed.AddField("Friend Removed:", RemoveFriend, true);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else if (CheckApiKey == "Not Registered")
                    {
                        Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                        Embed.WithAuthor("Register yourself https://xbl.io then Message the bot to link key ");
                        Embed.WithFooter(config.Global.BotName);
                        Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your API_KEY with : **{config.Global.prefix}AddApiKey API_KEY**.");
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message :"server is offline");/*Use for Debugging*/
            }
        }


        /*Need to make friendlist php Web Html*/
        [Command("Requestfriendslist")]
        public async Task friendslistdownload(string gamertag)
        {
            /*Get Keys*/
            string CPUKey = new WebClient().DownloadString(config.Global.CPUKey + "<@!" + Context.User.Id + ">");
            string CheckApiKey = new WebClient().DownloadString(config.Global.CheckApiKey + CPUKey);
            string GetApikey = new WebClient().DownloadString(config.Global.GetApikey + CPUKey);


            /*Get XUID*/
            var httpResponse = OpenXblHttp.RestClient.makeRequestAsync(config.Global.XboxProfileSearch + gamertag, "null", GetApikey, config.Global.httpRequestA = true);
            string json = OpenXblHttp.RestClient.strResponseValue;
            var doc = JsonDocument.Parse(json);
            var xuid = doc.RootElement.GetProperty("profileUsers")[0].GetProperty("hostId");

            /*Get Friend Info*/
            string friendslistdownload = new WebClient().DownloadString(config.Global.friendslistdownload + xuid + "&APIKEY=" + GetApikey);
            string friendslist = new WebClient().DownloadString(config.Global.friendslist);
            string NumberOfFriends = new WebClient().DownloadString(config.Global.friendsNumberOfFriends);

            string download = null;

            try
            {
                download = friendslistdownload;

                // check if download was successful
                if (download == null)
                {
                    await ReplyAsync("Failed to download friendslist Info");
                    return;
                }

                if (CheckApiKey == "APIKEY Already in database")
                {
                    if (friendslist == "") { friendslist = "Unknown"; }
                    Embed.AddField("Your Friends List(Shows up to 75):", friendslist, true);
                    Embed.AddField("Total Friends", NumberOfFriends, true);
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else if (CheckApiKey == "Not Registered")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Register yourself https://xbl.io then Message the bot to link key ");
                    Embed.WithFooter(config.Global.BotName);
                    Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your API_KEY with : **{config.Global.prefix}AddApiKey API_KEY**.");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }

            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message : "server is offline");/*Use for Debugging*/
            }

        }

        [Command("friendslist")]
        public async Task friendslistdownload()
        {

            string CPUKey = new WebClient().DownloadString(config.Global.CPUKey + "<@!" + Context.User.Id + ">");
            string CheckApiKey = new WebClient().DownloadString(config.Global.CheckApiKey + CPUKey);
            string GetApikey = new WebClient().DownloadString(config.Global.GetApikey + CPUKey);
            string friendslistdownload = new WebClient().DownloadString(config.Global.Userfriendslistdownload + GetApikey);
            string friendslist = new WebClient().DownloadString(config.Global.Userfriendslist);
            string NumberOfFriends = new WebClient().DownloadString(config.Global.NumberOfFriends);

            string download = null;

            try
            {
                download = friendslistdownload;

                // check if download was successful
                if (download == null)
                {
                    await ReplyAsync("Failed to download friendslist Info");
                    return;
                }

                if (CheckApiKey == "APIKEY Already in database")
                {
                    if (friendslist == "") { friendslist = "Unknown"; }
                    Embed.AddField("Current Friend List(Shows up to 75):", friendslist, true);
                    Embed.AddField("Total Friends", NumberOfFriends, true);
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else if (CheckApiKey == "Not Registered")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Register yourself https://xbl.io then Message the bot to link key ");
                    Embed.WithFooter(config.Global.BotName);
                    Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your API_KEY with : **{config.Global.prefix}AddApiKey API_KEY**.");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }

            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message : "server is offline");/*Use for Debugging*/
            }

        }

        [Command("Screenshots")]
        public async Task Screenshots()
        {
            try
            {

                string CPUKey = new WebClient().DownloadString(config.Global.CPUKey + "<@!" + Context.User.Id + ">");
                string CheckApiKey = new WebClient().DownloadString(config.Global.CheckApiKey + CPUKey);
                string GetApikey = new WebClient().DownloadString(config.Global.GetApikey + CPUKey);
                var httpResponse = OpenXblHttp.RestClient.makeRequestAsync(config.Global.GetScreenshots, "null", GetApikey, config.Global.httpRequestA = true);

                string json = OpenXblHttp.RestClient.strResponseValue;
                var obj = JObject.Parse(json);

                if (CheckApiKey == "APIKEY Already in database")
                {

                    Embed.WithDescription("Recent Screenshots:");

                    var gametitle = "";
                    var titleId = "";
                    var captureDate = "";
                    var screenshot = "";

                    foreach (var dataItem in obj["values"])
                    {


                        gametitle = dataItem["titleName"].Value<string>();
                        titleId = dataItem["titleId"].Value<string>();
                        captureDate = dataItem["captureDate"].Value<string>();

                        Embed.AddField("Title:", gametitle, true);
                        Embed.AddField("TitleId:", titleId, true);
                        Embed.AddField("CaptureDate:", captureDate, true);
                    }

                    await Context.Channel.SendMessageAsync("", false, Embed.Build());

                    foreach (var dataItem in obj["values"])
                    {

                        screenshot = dataItem["contentLocators"][0]["uri"].Value<string>();

                        Embed2.WithImageUrl(screenshot.ToString());
                        await Context.Channel.SendMessageAsync("", false, Embed2.Build());
                    }

                }
                else if (CheckApiKey == "Not Registered")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Register yourself [Link]https://xbl.io then Message the bot to link key ");
                    Embed.WithFooter(config.Global.BotName);
                    Embed.WithDescription($"Sorry {Context.User.Mention} \n you need to link your API_KEY with : **{config.Global.prefix}AddApiKey API_KEY**.");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }

            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(config.Global.debug ? ex.Message : "server is offline");/*Use for Debugging*/
            }

        }

    }

}

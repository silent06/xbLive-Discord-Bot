using Discord;
using Discord.Commands;
using System;
using System.Net;
using System.Threading.Tasks;
using System.Linq;
using Discord.Net;
using Discord.WebSocket;
namespace stealthbot
{
    public class Commands : ModuleBase<SocketCommandContext>
    {

        [Command(".ban")]
        [RequireContext(ContextType.Guild)]
        [RequireUserPermission(GuildPermission.Administrator)]
        public async Task BanAsync(IGuildUser user, [Remainder] string reason)
        {
            if (string.IsNullOrWhiteSpace(reason))
            {
                return;
            }

            var allBans = await Context.Guild.GetBansAsync();
            bool isBanned = allBans.Select(b => b.User).Where(u => u.Username == user.Username).Any();

            if (!isBanned)
            {
                var targetHighest = (user as SocketGuildUser).Hierarchy;
                var senderHighest = (Context.User as SocketGuildUser).Hierarchy;

                if (targetHighest < senderHighest)
                {
                    await Context.Guild.AddBanAsync(user);

                    await Context.Channel.SendMessageAsync($"**{Context.User}** Has Banned **{user.Username}** for ```{reason}```");

                    var dmChannel = await user.GetOrCreateDMChannelAsync();
                    await dmChannel.SendMessageAsync($"You were banned from **{Context.Guild.Name}** for ```{reason}```");
                }
            }
        }
        [Command("link"), Summary("register")]
        public async Task LinkCommand(string CPUKey)
        {
            try
            {
                EmbedBuilder Embed = new EmbedBuilder();

                mysql.Consoles Client = new mysql.Consoles();
                bool Exists = mysql.BotStuff(ref Client, CPUKey);

                if (Exists)
                {
                    if (Client.discordid == "0")
                    {
                        Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                        Embed.WithFooter(config.Global.BotName);
                        if (CPUKey.Length != 32)
                        {
                            Embed.WithAuthor("Wrong CPUKey Length");
                            Embed.WithDescription($"Your CPU Key needs to be 32 characters long {Context.User.Mention}.");
                        }
                        else
                        {
                            Embed.WithAuthor("Succesfully Registered");
                            mysql.SaveUserData(Context.User.ToString(), Context.User.Mention, CPUKey);
                            Embed.WithDescription($"You have successfully linked the CPUKey to {Context.User.Mention}.");
                        }
                    }
                    else
                    {

                        Embed.WithAuthor("CPUKey is already linked");
                        Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                        Embed.WithFooter(config.Global.BotName);

                        if (CPUKey.Length != 32)
                        {
                            Embed.WithAuthor("Wrong CPUKey Length");
                            Embed.WithDescription($"Your CPU Key needs to be 32 characters long {Context.User.Mention}.");
                        }
                        else
                        {
                            Embed.WithAuthor("CPUKey is already linked");
                            Embed.WithDescription($"CPUKey is already registered by another user {Context.User.Mention}.");
                        }
                    }

                }
                else
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithFooter(config.Global.BotName);
                    if (CPUKey.Length != 32)
                    {
                        Embed.WithAuthor("Wrong CPUKey Length");
                        Embed.WithDescription($"Your CPU Key needs to be 32 characters long {Context.User.Mention}.");
                    }
                    else
                    {
                        Embed.WithAuthor("CPUKey Error");
                        Embed.WithDescription($"This CPUKey dosent exist on our database {Context.User.Mention}.");
                    }
                }
                await Context.Channel.SendMessageAsync("", false, Embed.Build());
            }
            catch (Exception e)
            {
                await Context.Channel.SendMessageAsync(e.Message);
            }
        }
        public static string ConvertIntToHex(uint val)
        {
            return val.ToString("X");
        }

        internal static string[] GAME_HEX = { "FFFE07D1", "41560855", "4156081C", "415608C3",
            "4156091D", "41560929", "415607E6", "41560817", "415608CB", "41560914", "415608FC", "545408A7", "464F0803",
        "425307E6", "5841149E", "FFFE07DE","41560927","41560928","58411457","415608F8","454108E6","545408B8","45410950","454109BA","584111F7","58410A95","58480880",
        "5848085B", "545408B0", "58411420","315A07D1","423607D3","4B4E085E","4A3707D1","534307DB","464F0800","53510804","5841125A","545407F2","5841128F", "64569789", "69849798"};

        internal static string[] GAME_TITLE = { "[Dashboard]", "[Call of Duty®: WaW]", "[Black Ops I]", "[Black Ops II]",
            "[Black Ops III]", "[Black Ops III Bundle]", "[Modern Warfare I]", "[Modern Warfare II]", "[Modern Warfare III]", "[Advanced Warfare]", "[Ghosts]", "[Grand Theft Auto V]", "[Sniper Elite 3]",
        "[Skyrim]", "[Minecraft: Story Mode]", "[Account Creation Tool]","[Destiny: Legendary Edition]","[Destiny: Collectors Edition']","[MONOPOLY PLUS]","[Destiny]","[Skate 3]","[Grand Theft Auto: San Andreas]",
            "[Battlefield 3™]","[Battlefield 4™']","[Minecraft: Xbox 360 Edition]","[Iron Brigade]","[Internet Explorer]", "[Xbox Music and Video]", "[NBA 2K14]", "[Rekoil: Liberator]","['NBA 2K16]",
            "[YouTube]","[METAL GEAR SOLID V: THE PHANTOM PAIN]","[Crunchyroll]","[Hitman: Blood Money]","[PAYDAY 2]", "[Hitman: Absolution]","[Counter-Strike: GO]","[Grand Theft Auto IV]","[Terraria – Xbox 360 Edition]", "[Rainbow]", "[Shutting Down Console]" };


        public static string getTitle(string title)
        {
            for (int i = 0; i < GAME_HEX.Length; i++) if (title == GAME_HEX[i]) return GAME_TITLE[i];
            return "No Game Detected";
        }

        [Command("Token"), Summary("token")]
        public async Task TokenCommand(string token)
        {
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");
            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
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
                    if (Exists)
                    {
                        string Type = "Error";
                        int TokenT = mysql.TokenType(token);
                        if (TokenT == 0) { Type = "1 Day"; }
                        else if (TokenT == 1) { Type = "7 Days"; }
                        else if (TokenT == 2) { Type = "31 Days"; }
                        else if (TokenT == 3) { Type = "Lifetime"; }
                        else if (TokenT == 4) { Type = "Invalid"; }
                        Embed.AddField("Token:", Type, true);
                        mysql.RedeemToken(token, Client.ReserveDays, CPUKey);

                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("start"), Summary("Start Xbox 360 Game")]
        public async Task StartCommand(string qlaunch)
        {
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");

            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
            string hex = qlaunch; string game = getTitle(hex);
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
                    if (game == "No Game Detected")
                    {
                        Embed.AddField("Starting xbox 360 Title:", game, true);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else
                    {
                        if (Exists)
                        {
                            Embed.AddField("Starting xbox 360 Title:", game, true);
                            Embed.WithDescription($"Please allow 10-15 seconds to start {Context.User.Mention}.");
                            mysql.UpdateQuickLauncher(qlaunch, CPUKey);
                            await Context.Channel.SendMessageAsync("", false, Embed.Build());
                        }
                        else
                        {
                            await ReplyAsync("user is not in our Database");
                        }
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("Restart"), Summary("Restart")]
        public async Task ShutdownCommand()
        {
            string turnoff = new WebClient().DownloadString("http://192.99.58.184/reboot/index.php?Key=TJUZUrfun3kCCJBXhg4dNABdm018mjMO&reboot=12345678");
            EmbedBuilder Embed = new EmbedBuilder();
            try
            {
                if (turnoff == "Success")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Restarting Stealth Server");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Restart failed :(");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }


        [Command("MailFriend"), Summary("Email Friend")]
        public async Task EmailFriendCommand(string friend, string Subject, string Message)
        {
            string sender = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcurrentuser.php?Discord=" + "<@!" + Context.User.Id + ">");
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukeyemail.php?Discord=" + friend);
            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
            EmbedBuilder Embed = new EmbedBuilder();
            string sendmail = new WebClient().DownloadString("http://192.99.58.184/xdk/test/email.php?w3lrecipient=" + Client.email + "&w3lSubject=" + Subject + "&w3lMessage=" + Message + "&w3lSender=" + sender);
            try
            {
                if (CPUKey == "Not Registered")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("UnRegisterd User");
                    Embed.WithFooter(config.Global.BotName);
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else
                {

                    if (Exists)
                    {

                        if (sendmail == "Your mail has been sent successfully.")
                        {
                            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                            Embed.WithAuthor("Your mail has been sent successfully");
                            Embed.AddField("Email Sent to:", friend, true);
                            await Context.Channel.SendMessageAsync("", false, Embed.Build());
                        }
                        else
                        {
                            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                            Embed.WithAuthor("Unable to send email :( Please try again.");
                            await Context.Channel.SendMessageAsync("", false, Embed.Build());
                        }

                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("Sendmail"), Summary("Send Email")]
        public async Task SendEmailCommand(string Subject, string Message, string recipient)
        {

            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");
            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
            EmbedBuilder Embed = new EmbedBuilder();
            string sendmail = new WebClient().DownloadString("http://192.99.58.184/xdk/test/email.php?w3lrecipient=" + recipient + "&w3lSubject=" + Subject + "&w3lMessage=" + Message + "&w3lSender=" + Client.email);
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

                    if (Exists)
                    {

                        if (sendmail == "Your mail has been sent successfully.")
                        {
                            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                            Embed.WithAuthor("Your mail has been sent successfully");
                            Embed.AddField("Email Sent to:", recipient, true);
                            await Context.Channel.SendMessageAsync("", false, Embed.Build());
                        }
                        else
                        {
                            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                            Embed.WithAuthor("Unable to send email :( Please try again.");
                            await Context.Channel.SendMessageAsync("", false, Embed.Build());
                        }

                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("SetUser"), Summary("RegisterUser")]
        public async Task SetUserCommand(string SetUser)
        {
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");

            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
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

                    if (Exists)
                    {
                        Embed.AddField("User Set to:", SetUser, true);
                        mysql.UpdateUser(SetUser, CPUKey);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("SetEmail"), Summary("Link Email")]
        public async Task linkEmailCommand(string email)
        {
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");

            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
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

                    if (Exists)
                    {
                        Embed.AddField("Email Set to:", email, true);
                        mysql.UpdateEmail(email, CPUKey);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }


        [Command("Mail"), Summary("Mail")]
        public async Task MailCommand(string Subject, string Message, string Sender, string recipient)
        {
            string sendmail = new WebClient().DownloadString("http://192.99.58.184/xdk/test/email.php?w3lrecipient=" + recipient + "&w3lSubject=" + Subject + "&w3lMessage=" + Message + "&w3lSender=" + Sender);
            EmbedBuilder Embed = new EmbedBuilder();
            try
            {
                if (sendmail == "Your mail has been sent successfully.")
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Your mail has been sent successfully");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
                else
                {
                    Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                    Embed.WithAuthor("Unable to send email :( Please try again.");
                    await Context.Channel.SendMessageAsync("", false, Embed.Build());
                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }


        [Command("Color"), Summary("Adjust xbox 360 Color")]
        public async Task Color1Command(string primary, string secondary) {
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");

            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
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
                    if (Exists) {
                        Embed.AddField("Primary Color:", primary, true);
                        Embed.AddField("Secondary Color:", secondary, true);
                        mysql.UpdatePrimaryColor(primary, secondary, CPUKey);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("info"), Summary("Get your Current Info")]
        public async Task InfoCommand()
        {
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");

            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
            string hex = Client.TitleID; string game = getTitle(hex);
            bool Suspended = Client.Banned == 1 ? true : false;
            bool Expired = (Client.TimeRenaming <= DateTime.Now);
            EmbedBuilder Embed = new EmbedBuilder();
            TimeSpan ExpireTime = Client.TimeRenaming - DateTime.UtcNow;

            //string TimeRemaining = string.Format("{0}H {1}M", ExpireTime.Hours, ExpireTime.Minutes);
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
                    if (Exists)
                    {
                        Embed.AddField("Username", Client.Username, true);
                        Embed.AddField("Unbanned Time", Client.KVDays + "D  " + Client.KVTime.Hours + "H  " + Client.KVTime.Minutes + "M", true);
                        Embed.AddField("TimeRemaining", Client.ReserveDays + "D  " + ExpireTime.Hours + "H  " + ExpireTime.Minutes + "M", true);
                        //Embed.AddField("TimeRemaining", Client.ReserveDays + "D  " + TimeRemaining, true);
                        Embed.AddField("Reserve Days:", Client.ReserveDays, true);
                        Embed.AddField("Last Title", Client.TitleID, true);
                        Embed.AddField("Gamertag", Client.Gamertag, true);
                        Embed.AddField("Primary Color:", Client.PrimaryUIColor, true);
                        Embed.AddField("Secondary Color:", Client.SecondaryUIColor, true);
                        Embed.AddField("Registered Email:", Client.email, true);
                        Embed.AddField("User Banned From Service?", Suspended ? "(YES BANNED)" : "(NO)", true);
                        Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                        mysql.SaveUserDataUpdate(Context.User.ToString(), CPUKey);
                        await Context.Channel.SendMessageAsync("", false, Embed.Build());
                    }
                    else
                    {
                        await ReplyAsync("user is not in our Database");
                    }
                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }
        public static string ListenerAlpha() { return new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Listener.php"); }

        [Command("freemode"), Summary("Get your Current Info")]
        public async Task Freemode()
        {
            int FreeMode = mysql.GetFreemode() == true ? 1 : 0;

            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.AddField("**Freemode is **", FreeMode == 1 ? "Online" : "Offline");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("status"), Summary("Get your Current Info")]
        public async Task uptimecheck()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"***{ListenerAlpha()}***");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }
        [Command("Freemode"), Summary("FreeMode")]
        public async Task FreeModeSet(int freemode)
        {
            EmbedBuilder Embed = new EmbedBuilder();
            IGuildUser sender = Context.Message.Author as IGuildUser;

            if (sender.GuildPermissions.Administrator)
            {
                Embed.WithAuthor("[ADMIN] FreeMode Command");
                Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
                mysql.SetFreemode(freemode);
                Embed.WithFooter(config.Global.BotName);
                Embed.WithDescription(string.Format("Freemode has been {0}", freemode == 1 ? "Enabled" : "Disabled"));
                await Context.Channel.SendMessageAsync("", false, Embed.Build());
            }
            else
            {
                await Context.Channel.SendMessageAsync("You need Admin rights to use the command u dumby");
            }
        }

        [Command("SetEmail"), Summary("help Mail info")]
        public async Task SetMailhelp()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Format !SetEmail Email { Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("Mail"), Summary("help Mail info")]
        public async Task Mailhelp()
        {

            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Format: !Mail Subject Message Sender recipient { Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("MailFriend"), Summary("help Mail info")]
        public async Task MailFriendhelp()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Format !MailFriend Username Subject Message { Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("SendMail"), Summary("help Mail info")]
        public async Task SendMailhelp() {

            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Format: !SendMail Subject Message recipient {Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("OptionsMail"), Summary("help Mail info")]
        public async Task mailhelpoptions()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Mail options: !Mail, !SetEmail, !SendMail, !MailFriend Also put Message in quataions{Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("Token"), Summary("help info")]
        public async Task tokenhelp()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"token Format example: !Token AAAA-BBBB-CCCC, {Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("color"), Summary("help info")]
        public async Task colorhelp()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Color Format example: !color 122EE5 C2E512, {Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("start"), Summary("help info")]
        public async Task QuickLauncherHelp()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Start xbox 360 game Format example: !start 12345678 Find your xbox game titleId here: http://xboxunity.net/, {Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("titlelist"), Summary("TitleId info")]
        public async Task titlelisthelp()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.AddField("Title Numbers:", "FFFE07D1, 41560855, 4156081C, 415608C3, 4156091D, 41560929, 415607E6, 41560817, 415608CB, 41560914, 415608FC, 545408A7, 464F0803, 425307E6, 5841149E, FFFE07DE,41560927,41560928,58411457,415608F8,454108E6,545408B8,45410950,454109BA,584111F7,58410A95,58480880, 5848085B, 545408B0, 58411420,315A07D1,423607D3,4B4E085E,4A3707D1,534307DB,464F0800,53510804,5841125A,545407F2, 5841128F, 64569789, 69849798", true);
            Embed.AddField("Title IDs:", "[Dashboard], [Call of Duty®: WaW], [Black Ops I], [Black Ops II], [Black Ops III], [Black Ops III Bundle], [Modern Warfare I], [Modern Warfare II], [Modern Warfare III], [Advanced Warfare], [Ghosts], [Grand Theft Auto V], [Sniper Elite 3], [Skyrim], [Minecraft: Story Mode], [Account Creation Tool],[Destiny: Legendary Edition],[Destiny: Collectors Edition'],[MONOPOLY PLUS],[Destiny],[Skate 3],[Grand Theft Auto: San Andreas], [Battlefield 3™],[Battlefield 4™'],[Minecraft: Xbox 360 Edition],[Iron Brigade],[Internet Explorer], [Xbox Music and Video], [NBA 2K14], [Rekoil: Liberator],['NBA 2K16], [YouTube],[METAL GEAR SOLID V: THE PHANTOM PAIN],[Crunchyroll],[Hitman: Blood Money],[PAYDAY 2], [Hitman: Absolution],[Counter - Strike: GO],[Grand Theft Auto IV],[Terraria – Xbox 360 Edition],[Rainbow], [Shut Down Xbox]", true);
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }

        [Command("Shutdown xbox"), Summary("help info")]
        public async Task ShutdownXb()
        {
            string shutdown = "69849798";
            string CPUKey = new WebClient().DownloadString("http://root.silent.hosted.nfoservers.com/discord/Example/getcpukey.php?discordid=" + "<@!" + Context.User.Id + ">");
            mysql.Consoles Client = new mysql.Consoles();
            bool Exists = mysql.BotStuff(ref Client, CPUKey);
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

                   if (Exists)
                   {
                     Embed.WithDescription($"Your Xbox is shutting down...please allow 10-15 seconds to initiate {Context.User.Mention}.");
                     mysql.UpdateQuickLauncher(shutdown, CPUKey);
                     await Context.Channel.SendMessageAsync("", false, Embed.Build());
                   }
                   else
                   {
                     await ReplyAsync("user is not in our Database");
                   }
                    

                }
            }
            catch (Exception ex)
            {
                await Context.Channel.SendMessageAsync(ex.Message);
            }
        }

        [Command("help"), Summary("help info")]
        public async Task test()
        {
            EmbedBuilder Embed = new EmbedBuilder();
            Embed.WithColor(config.Global.RGB1, config.Global.RGB2, config.Global.RGG3);
            Embed.WithDescription($"Commands: !SetUser, !OptionsMail, !Shutdown xbox, !titlelist, !Start, !info, !Token, !status, !color, !Freemode, !freemode, !link {Context.User.Mention}.");
            await Context.Channel.SendMessageAsync("", false, Embed.Build());
        }
    }
}

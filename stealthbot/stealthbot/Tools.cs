using System;
using System.Collections.Generic;
using System.Text;
using System.Numerics;
using System.Runtime.InteropServices;
using System.IO;
using System.Reflection;

namespace stealthbot
{

    internal class IniParsing
    {
        private string path;
        string SettingsName = "config";
        string EXE = Assembly.GetExecutingAssembly().GetName().Name;

        [DllImport("kernel32")]
        private static extern long WritePrivateProfileString(string section, string key, string val, string filePath);
        [DllImport("kernel32")]
        private static extern int GetPrivateProfileString(string section, string key, string def, StringBuilder retVal, int size, string filePath);


        public IniParsing(string INIPath)
        {
            //path = INIPath;
            path = new FileInfo(INIPath ?? SettingsName + ".ini").FullName.ToString();
        }

        public void IniWriteValue(string Section, string Key, string Value)
        {
            WritePrivateProfileString(Section, Key, Value, this.path);
        }

        public string IniReadValue(string Section, string Key)
        {
            StringBuilder temp = new StringBuilder(255);
            int i = GetPrivateProfileString(Section, Key, "", temp, 255, this.path);
            return temp.ToString();
        }

    }


    class Tools
    {

        public static IniParsing LoadedIni;

        public static int GetPort()
        {
            return Convert.ToInt32(LoadedIni.IniReadValue("Settings", "Port"));
        }

        public static bool Getdebugmode()
        {
            string debug = LoadedIni.IniReadValue("Config", "DebugMode");
            bool status = false;
            if (debug == "true")
            {
                status = true;
            }
            else {

                status = false;
            }

            return status;
        }

        public static string GetOpenXblVPS()
        {
            return LoadedIni.IniReadValue("OpenXbl", "VPSTRING");
        }

        public static string GetOpenXblApiKey()
        {
            return LoadedIni.IniReadValue("OpenXbl", "APIKEY");
        }

        public static string GetSqlHostName()
        {
            return LoadedIni.IniReadValue("mysql", "host");
        }

        public static string GetSqlUserName()
        {
            return LoadedIni.IniReadValue("mysql", "username");
        }

        public static string GetSqlPassword()
        {
            return LoadedIni.IniReadValue("mysql", "password");
        }

        public static string GetSqlDatabase()
        {
            return LoadedIni.IniReadValue("mysql", "database");
        }

        public static string StringToHex(string hexstring)
        {
            string outputHex = BigInteger.Parse(hexstring).ToString("X");

            return outputHex;
        }

        public static string BytesToHexString(byte[] buffer)
        {
            string str = "";
            for (int i = 0; i < buffer.Length; i++) str += buffer[i].ToString("X2");
            return str;
        }
        public static long GetTimeStamp()
        {
            return DateTimeOffset.UtcNow.ToUnixTimeSeconds();
        }

        public static void SecondsToTime(int sec, ref int days, ref int hours, ref int minutes, ref int secnds)
        {
            string val = "";

            TimeSpan t = TimeSpan.FromSeconds(Convert.ToDouble(sec.ToString()));
            if (t.Days > 0)
                val = t.ToString(@"d\d\,\ hh\:mm\:ss");
            else val = t.ToString(@"hh\:mm\:ss");

            if (t.Days > 0)
            {
                days = int.Parse(val.Substring(0, val.IndexOf(',') - 1));
                hours = int.Parse(val.Substring(val.IndexOf(',') + 2, 2));
                minutes = int.Parse(val.Substring(val.IndexOf(':') + 1, 2));
                secnds = int.Parse(val.Substring(val.LastIndexOf(':') + 1));
            }
            else
            {
                hours = int.Parse(val.Substring(0, val.IndexOf(':')));
                minutes = int.Parse(val.Substring(val.IndexOf(':') + 1, 2));
                secnds = int.Parse(val.Substring(val.LastIndexOf(':') + 1));
            }
        }

        public static void AddStringToArray(ref char[] array, string err)
        {
            Array.Copy(err.ToCharArray(), 0, array, 0, err.Length);
        }

        public static byte[] GenerateRandomData(int count)
        {
            byte[] RandData = new byte[count];
            new Random().NextBytes(RandData);

            return RandData;
        }

        public static char[] GenerateRandomDataChars(int count)
        {
            byte[] RandData = new byte[count];
            new Random().NextBytes(RandData);

            return System.Text.Encoding.UTF8.GetString(RandData).ToCharArray();
        }

        public static string BytesToString(byte[] Buffer)
        {
            string str = "";
            for (int i = 0; i < Buffer.Length; i++) str = str + Buffer[i].ToString("X2");
            return str;
        }

        public static string BytesToStringSpaced(byte[] Buffer)
        {
            string str = "";
            for (int i = 0; i < Buffer.Length; i++) str = str + Buffer[i].ToString("X2") + " ";
            return str;
        }

        public static byte[] StringToBytes(string str)
        {
            Dictionary<string, byte> hexindex = new Dictionary<string, byte>();
            for (int i = 0; i <= 255; i++)
                hexindex.Add(i.ToString("X2"), (byte)i);

            List<byte> hexres = new List<byte>();
            for (int i = 0; i < str.Length; i += 2)
                hexres.Add(hexindex[str.Substring(i, 2)]);

            return hexres.ToArray();
        }


    }
}

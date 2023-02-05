using System;
using System.Diagnostics;

namespace stealthbot
{
    public static class ShellHelper
    {
        public static string Shell(this string cmd)
        {
            
            var escapedArgs = cmd.Replace("\"", "\\\"");
            Console.WriteLine("running cmd...");
            var process = new Process()
            {
                StartInfo = new ProcessStartInfo
                {
                    //FileName = "/bin/bash",/*For linx*/
                    //Arguments = $"-c \"{escapedArgs}\"",/*For linx*/

                    FileName = "cmd.exe",/*For Windows*/
                    Arguments = $"/c \"{escapedArgs}\"",/*For Windows*/
                    RedirectStandardOutput = true,
                    UseShellExecute = false,
                    CreateNoWindow = false,
                }
            };
            process.Start();
            string result = process.StandardOutput.ReadToEnd();
            process.WaitForExit();
            return result;
        }
    }

}

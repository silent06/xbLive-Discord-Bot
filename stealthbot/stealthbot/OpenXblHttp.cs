using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using MySql.Data.MySqlClient;
using Newtonsoft.Json.Linq;
using System.Net.Http;
using System.Net;
using System.IO;    // For StreamReader
using Newtonsoft.Json;
using System.Text.Json;
namespace XbLiveDiscordBot
{
    public static class OpenXblHttp
    {

        public static object DeserializeFromStream(string stream)
        {
            var serializer = new Newtonsoft.Json.JsonSerializer();

            using (var sr = new StreamReader(stream))
            using (var jsonTextReader = new JsonTextReader(sr))
            {
                return serializer.Deserialize(jsonTextReader);
            }
        }

        public enum httpVerb
        {
            GET,
            POST,
            PUT,
            DELETE
        }

        public enum authenticationType
        {
            Basic,
            NTLM
        }

        public enum autheticationTechnique
        {
            RollYourOwn,
            NetworkCredential
        }

        public static class RestClient
        {
            public static string endPoint { get; set; }
            public static httpVerb httpMethod { get; set; }
            public static authenticationType authType { get; set; }
            public static autheticationTechnique authTech { get; set; }
            public static string strResponseValue = string.Empty;
#pragma warning disable CS1998 
            public static async System.Threading.Tasks.Task<string> makeRequestAsync(string ApiString, string PostRequest, string APIKey, bool httpType)
#pragma warning restore CS1998 
            {
                endPoint = "https://xbl.io/api/v2/";

                byte[] byteArray = Encoding.UTF8.GetBytes(PostRequest);
                httpMethod = httpType ? httpVerb.GET : httpVerb.POST;
                if (httpType)/*Get Method*/
                {
                    HttpWebRequest request = (HttpWebRequest)WebRequest.Create(endPoint + ApiString);
                    request.Method = httpMethod.ToString();
                    request.Accept = "application/json";
                    request.Accept = "en-US";
                    request.Accept = "X-Contract: 100";
                    request.Accept = "image/*";
                    request.ContentType = "application/json";
                    request.Headers["X-Authorization"] = APIKey;/*APIKey Goes Here*/

                    HttpWebResponse response = null;
                    try
                    {
                        response = (HttpWebResponse)request.GetResponse();

                        if (stealthbot.config.Global.debug) Console.WriteLine("Get reponse status: " + response.StatusCode);
                        //Proecess the response stream... (could be JSON, XML or HTML etc..._

                        using (Stream responseStream = response.GetResponseStream())
                        {
                            if (responseStream != null)
                            {
                                using (StreamReader reader = new StreamReader(responseStream))
                                {
                                    strResponseValue = reader.ReadToEnd();

                                }
                            }
                        }
                    }
                    catch (Exception ex)
                    {
                        strResponseValue = "{\"errorMessages\":[\"" + ex.Message.ToString() + "\"],\"errors\":{}}";
                    }
                    finally
                    {
                        if (response != null)
                        {
                            ((IDisposable)response).Dispose();
                        }
                    }
                }
                else if (!httpType)/*Post Method*/
                {

                    HttpWebRequest request = (HttpWebRequest)WebRequest.Create(endPoint + ApiString);
                    request.Method = httpMethod.ToString();
                    request.Accept = "application/json";
                    request.Accept = "en-US";
                    request.Accept = "X-Contract: 100";
                    request.Accept = "image/*";
                    request.ContentType = "application/json";
                    request.ContentLength = PostRequest.Length;
                    var reqStream = request.GetRequestStream();
                    reqStream.Write(byteArray, 0, byteArray.Length);
                    request.Headers["X-Authorization"] = APIKey;/*APIKey Goes Here*/

                    HttpWebResponse response = null;
                    try
                    {
                        response = (HttpWebResponse)request.GetResponse();
                        if(stealthbot.config.Global.debug) Console.WriteLine("Post reponse status: " + response.StatusCode);
                        //Proecess the response stream... (could be JSON, XML or HTML etc...

                        using (Stream responseStream = response.GetResponseStream())
                        {
                            if (responseStream != null)
                            {
                                using (StreamReader reader = new StreamReader(responseStream))
                                {
                                    strResponseValue = reader.ReadToEnd();

                                }
                            }
                        }
                    }
                    catch (Exception ex)
                    {
                        strResponseValue = "{\"errorMessages\":[\"" + ex.Message.ToString() + "\"],\"errors\":{}}";
                    }
                    finally
                    {
                        if (response != null)
                        {
                            ((IDisposable)response).Dispose();
                        }
                    }
                }
                /*Left here for future Reference*/
                //Console.WriteLine(strResponseValue);
                /*try
                {
                    using (FileStream fileStream = File.Open(Filepath.filePath, FileMode.Create, FileAccess.ReadWrite, FileShare.Read))
                    {
                        StreamWriter writer = new StreamWriter(fileStream);
                        Console.WriteLine("Writing json file to folder");
                        await writer.WriteAsync(strResponseValue);
                        writer.Flush();
                        writer.Close();
                    }
                }
                catch (Exception ex)
                {
                    Console.WriteLine(ex.Message);
                }*/


                return strResponseValue;
            }


        }

    }
}



using System;
using System.Net;
using System.Web;
using System.IO;
using System.Runtime.Serialization;
using System.Runtime.Serialization.Json;
using System.Text;

namespace ConsoleApp2
{
    class Program
    {


        static void Main(string[] args)
        {
            string response = SendRequest("http://imprezpol.cba.pl/user_create.php?login=Pawel&password=Adamus");
            if (response != null)
            {
                //Console.WriteLine("RISPONS:");
                Console.WriteLine(response);
                Deserialize<object>(response);
            }
            else
            {
                Console.WriteLine("NUL XD :C");
            }

            Console.ReadLine();
        }

        static string SendRequest(string url)
        {
            try
            {
                using (WebClient client = new WebClient())
                {
                    return client.DownloadString(new Uri(url));
                }
            }
            catch (WebException ex)
            {

                return null;
            }
        }

        public static T Deserialize<T>(string json)
        {
            T obj = Activator.CreateInstance<T>();
            MemoryStream ms = new MemoryStream(Encoding.Unicode.GetBytes(json));
            DataContractJsonSerializer serializer = new DataContractJsonSerializer(obj.GetType());
            obj = (T)serializer.ReadObject(ms);
            ms.Close();
            Console.WriteLine(obj.ToString());
            return obj;
        }
    }
}

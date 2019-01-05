using System;
using System.Net;
using System.Web;
using System.IO;

namespace ConsoleApp1
{
    class Program
    {


        static void Main(string[] args)
        {
            string response = SendRequest("http://imprezpol.cba.pl/login.php?login=Jakub&password=Adamus");
            Console.ReadKey();
            if (response != null)
            {
                Console.WriteLine(response);
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
    }
}

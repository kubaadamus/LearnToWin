using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using System.Net;
using System.Web;
using System.IO;
using System.Runtime.Serialization;
using System.Runtime.Serialization.Json;
using System.Text;
using System.Reflection;


public static class SQLQueryClass
{
    public static string SqlQuery(string script, string query)
    {
        string response = SendRequest("http://imprezpol.cba.pl/"+script+"?"+query+"");
        if (response != null)
        {
            response = response.Replace("}", ",}");
            return response;
        }
        else
        {
            return "Response is NULL";
        }
    }
    public static string SendRequest(string url)
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


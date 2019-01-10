﻿
using System;
using System.Net;
using UnityEngine;
using UnityEngine.UI;



public static class SQLQueryClass
{
    public static event ClientSqlCompletedDelegate ClientSqlCompletedEvent;
    public delegate void ClientSqlCompletedDelegate(string response, string callbackFunctionName);
    public static string SqlQuery(string script, string query, string callbackFunctionName)
    {
        string response = SendRequest("http://imprezpol.cba.pl/"+script+"?"+query+"", callbackFunctionName);
        if (response != null)
        {
            return response;
        }
        else
        {
            return "Response is NULL";
        }
    }
    public static string SendRequest(string url, string callbackFunctionName)
    {
        try
        {
            using (WebClient client = new WebClient())
            {
                string StrToReturn = client.DownloadString(new Uri(url));

                    ClientSqlCompletedEvent(StrToReturn, callbackFunctionName);
                

                return StrToReturn;
            }
        }
        catch (WebException ex)
        {

            return null;
        }
    }

}

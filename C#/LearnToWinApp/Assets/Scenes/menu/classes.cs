
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
        string queryString = "http://imprezpol.cba.pl/" + script + "?" + query + "";
        Debug.Log("Query: " + queryString);
        string response = SendRequest(queryString, callbackFunctionName);
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
            Debug.Log(ex);
            return null;
        }
    }

}


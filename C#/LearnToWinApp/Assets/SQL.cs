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

public class SQL : MonoBehaviour {

    int argument = 0;
    int wartosc = 1;

	// Use int for initialization
	void Start () {   
    }
    // Update is called once per frame
    void Update()
    {
        if(Input.GetKeyDown(KeyCode.Space))
        {
            //RefreshCharacter();

            SQLQueryClass.SqlQuery("buy.php", "login=Jakub&password=Adamus&sellbuy=sell&item=perk1&id=1&autoPowrot=1&");
            Debug.Log(SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&"));
        }
        if (Input.GetKeyDown(KeyCode.LeftControl))
        {
            //RefreshCharacter();

            SQLQueryClass.SqlQuery("buy.php", "login=Jakub&password=Adamus&sellbuy=buy&item=perk1&id=1&autoPowrot=1&");
            Debug.Log(SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&"));
            Debug.Log(SQLQueryClass.SqlQuery("coins_update.php", "login=Jakub&password=Adamus&"));
        }
    }
    void RefreshCharacter()
    {
        string response = SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&");
        if (response != null)
        {
            response = response.Replace("}", ",}");
            Debug.Log(response);
            Uczen maciej = CreateCharacter(response);
            maciej.Wypisz();
        }
        else
        {
            Debug.Log("NUL XD :C");
        }
    }
    Uczen CreateCharacter(string response)
    {
        return new Uczen(returnShit(response,0), returnShit(response, 1), returnShit(response, 2), returnShit(response, 3), returnShit(response, 4), returnShit(response, 5), returnShit(response, 6), returnShit(response, 7), returnShit(response, 8), returnShit(response, 9), returnShit(response, 10), returnShit(response, 11), returnShit(response, 12), returnShit(response, 13));
    }
    int returnShit(string serialized,int what)
    {
        return Int32.Parse(serialized.Split(',')[what].Replace("{", "").Replace("\"", "").Split(':')[wartosc]);
    }

 
}

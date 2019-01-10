using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using System;

public class Rank : MonoBehaviour {

    List<Uczen> UczenRankList = new List<Uczen>();
    public GameObject Camera;
    void Start () {
        SQLQueryClass.ClientSqlCompletedEvent += SqlSkonczonyTest;  //Uruchamia funkcję SqlSkonczonyTest pełną callbacków
    }
	
	// Update is called once per frame
	void Update () {
		
	}

    public void ShowRank()
    {
        UczenRankList.Clear();
        string rank = "SELECT * FROM `uczniowie`"; // wysyłanie ucznia na serwer
        SQLQueryClass.SqlQuery("universal_query.php", "name1=" + SQL.login + "&name2=" + SQL.password + "&query=" + rank + "", "ShowRankCallback");
        Camera.GetComponent<CameraScript>().TargetPosition = Camera.GetComponent<CameraScript>().RankPos.transform.position;
    }

    public void SqlSkonczonyTest(string response, string callbackFunctionName)
    {
        if(callbackFunctionName=="ShowRankCallback")
        {
            Debug.Log(response);
            string replacedResponse = response.Replace("},{", "}|{").Replace("[", "").Replace("]", "");
            string[] ResponseArray = replacedResponse.Split('|');

            foreach(string a in ResponseArray)
            {
                UczenRankList.Add(JsonUtility.FromJson<Uczen>(a));
            }



            string StringToDisplay = "";
            foreach(Uczen u in UczenRankList)
            {
                StringToDisplay += u.name1 + "  " + u.name2 + " " + u.coins + Environment.NewLine;
            }
            GetComponent<Text>().text = StringToDisplay;

        }
    }
    }
// Character = JsonUtility.FromJson<Uczen>(CharacterJsonSql);
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;


public class Login : MonoBehaviour
{
    //Eventy
    public static event EnterMenuDelegate EnterMenuEvent; //Ustawia przyciski ekwipunku bohatera po lewej w momencie stworzenia bohatera
    public delegate void EnterMenuDelegate();
    
    public GameObject Camera;
    void Start()
    {
        SQLQueryClass.ClientSqlCompletedEvent += SqlSkonczonyTest;  //Uruchamia funkcję SqlSkonczonyTest pełną callbacków
        //Debug.Log("WHAT");

        SQL.login = "Jakub";
        SQL.password = "Adamus";
        EnterGame();
    }
    void Update()
    {
    }
    public void EnterGame()
    {



        //SQL.login = GameObject.Find("login").GetComponent<InputField>().text;
        //SQL.password = GameObject.Find("password").GetComponent<InputField>().text;


        SQLQueryClass.SqlQuery("user_create.php", "name1=" + SQL.login + "&name2=" + SQL.password + "&", "LoginCheck");



    }

    public void SqlSkonczonyTest(string response, string callbackFunctionName)
    {
        if (callbackFunctionName == "LoginCheck" && response != "null")
        {
            EnterMenuEvent();
            Camera.GetComponent<CameraScript>().TargetPosition = Camera.GetComponent<CameraScript>().MenuPos.transform.position;
        }
        else
        {
            //Debug.Log("NOPE XD");
            GameObject.Find("badpassword").GetComponent<Text>().enabled = true;
        }
    }
    }
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
            RefreshCharacter();

        }
    }
    void RefreshCharacter()
    {
        string response = SendRequest("http://imprezpol.cba.pl/user_create.php?login=Jakub&password=Adamus");
        if (response != null)
        {
            response = response.Replace("}", ",}");
            Debug.Log(response);
            uczen maciej = CreateCharacter(response);

            maciej.Wypisz();


        }
        else
        {
            Debug.Log("NUL XD :C");
        }
    }
	uczen CreateCharacter(string response)
    {
        
        return new uczen(returnShit(response,0), returnShit(response, 1), returnShit(response, 2), returnShit(response, 3), returnShit(response, 4), returnShit(response, 5), returnShit(response, 6), returnShit(response, 7), returnShit(response, 8), returnShit(response, 9), returnShit(response, 10), returnShit(response, 11), returnShit(response, 12), returnShit(response, 13));
    }
    int returnShit(string serialized,int what)
    {
        return Int32.Parse(serialized.Split(',')[what].Replace("{", "").Replace("\"", "").Split(':')[wartosc]);
    }

     string SendRequest(string url)
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

    public T Deserialize<T>(string json)
    {
        T obj = Activator.CreateInstance<T>();
        MemoryStream ms = new MemoryStream(Encoding.Unicode.GetBytes(json));
        DataContractJsonSerializer serializer = new DataContractJsonSerializer(obj.GetType());
        obj = (T)serializer.ReadObject(ms);
        ms.Close();
        Debug.Log(obj.ToString());
        return obj;
    }
}

public class uczen
{
    public int baza = 0;
    public int helmet = 0;
    public int torso = 0;
    public int gloves = 0;
    public int pants = 0;
    public int boots = 0;
    public int weapon = 0;
    public int weapon2 = 0;
    public int weapon3 = 0;
    public int weapon4 = 0;
    public int weapon5 = 0;
    public int perk1 = 0;
    public int perk2 = 0;
    public int perk3 = 0;
    public uczen(int _base= 0, int _helmet= 0, int _torso= 0, int _gloves= 0, int _pants= 0, int _boots= 0, int _weapon= 0, int _weapon2= 0, int _weapon3= 0, int _weapon4= 0, int _weapon5= 0, int _perk1= 0, int _perk2= 0, int _perk3= 0)
    {
        this.baza = _base;
        this.helmet = _helmet;
        this.torso = _torso;
        this.gloves = _gloves;
        this.pants = _pants;
        this.boots = _boots;
        this.weapon = _weapon;
        this.weapon2 = _weapon2;
        this.weapon3 = _weapon3;
        this.weapon4 = _weapon4;
        this.weapon5 = _weapon5;
        this.perk1 = _perk1;
        this.perk2 = _perk2;
        this.perk3 = _perk3;
    }
    public void Wypisz()
    {
        Debug.Log(nameof(this.baza) + " " + this.baza);
        Debug.Log(nameof(this.helmet) + " " + this.helmet);
        Debug.Log(nameof(this.torso) + " " + this.torso);
        Debug.Log(nameof(this.gloves) + " " + this.gloves);
        Debug.Log(nameof(this.pants) + " " + this.pants);
        Debug.Log(nameof(this.boots) + " " + this.boots);
        Debug.Log(nameof(this.weapon) + " " + this.weapon);
        Debug.Log(nameof(this.weapon2) + " " + this.weapon2);
        Debug.Log(nameof(this.weapon3) + " " + this.weapon3);
        Debug.Log(nameof(this.weapon4) + " " + this.weapon4);
        Debug.Log(nameof(this.weapon5) + " " + this.weapon5);
        Debug.Log(nameof(this.perk1) + " " + this.perk1);
        Debug.Log(nameof(this.perk2) + " " + this.perk2);
        Debug.Log(nameof(this.perk3) + " " + this.perk3);

        Debug.Log("==================================================================================");
    }


}
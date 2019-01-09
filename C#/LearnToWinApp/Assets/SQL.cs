
using UnityEngine;
using System.Web.Script.Serialization;
using System;
using System.Collections.Generic;
using System.Collections;
using UnityEngine.UI;
using System.IO;
using System.Runtime.Serialization.Formatters.Binary;
using System.Net;
public class SQL : MonoBehaviour
{
    //Eventy
    public static event CharacterGearItemButtonUpdateDelegate CharacterGearItemButtonUpdateEvent; //Ustawia przyciski ekwipunku bohatera po lewej w momencie stworzenia bohatera
    public delegate void CharacterGearItemButtonUpdateDelegate();


    public GameObject ShopContent;                                  //Content sklepu do którego będą dołączane przyciski
    public GameObject ShopItemButtonPrefab;                         //Prefab którym zostanie wyłożony content sklepu na podstawie armory
    public GameObject CharacterStatsText;                           //Tekst statystyk gracza czyli coinsy, spendy i wartość
    public static Uczen Character;                                  //Statyczny obiekt Character.
    //Zmienne czekające na uzupełnienie z SQL
    int CharacterCoinsSql = 0;
    string CharacterJsonSql = "";
    //Listy zbrojowni
    public List<Primary> PrimaryList = new List<Primary>();         
    public List<Secondary> SecondaryList = new List<Secondary>();
    public List<Throwable> ThrowableList = new List<Throwable>();
    public List<Med> MedList = new List<Med>();
    public List<Armor> ArmorList = new List<Armor>();
    public List<Perk> PerkList = new List<Perk>();

    void Start()
    {
        //Przypisania eventów
        SQLQueryClass.ClientSqlCompletedEvent += SqlSkonczonyTest;  //Uruchamia funkcję SqlSkonczonyTest pełną callbacków
        ShopSelectButton.ShopSelectButtonPressedEvent += DrawShop;

        // Zwykłe funkcje startowe
        CreateArmory();                                             // Tworzy listy primarów seconadrów itd i wypełnia je odpowiednimi obiektami                                      

        Invoke("CharacterDownload", 0.5f);                              // Updatuje i pobiera coinsy z serwera, potem pobiera ucznia, robi z niego obiekt i wypełnia ekwipunek z armory
        //DrawShop(ShopSelectionEnum.primary);                        // Na początku gry automatycznie rysujemy sklepik z primary 

        //ShopSelectButton.ShopSelectButtonPressed += DrawShop;       // Jeśli wybierzemy zakładkę sklepiku to uruchamia się DrawShop


    }
    public void CharacterDownload()
    {
        SQLQueryClass.SqlQuery("coins_update.php", "login=Jakub&password=Adamus&","CoinsUpdate").Replace(".", ","); // Pobierz ilość monet na podstawie ocen
        SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&", "CharacterCreate");
    }
    public void CharacterCreate()
    {
        Character = new JavaScriptSerializer().Deserialize<Uczen>(CharacterJsonSql);                                                        // pobieranie ucznia z serwera
        Character.Fill(PrimaryList, SecondaryList, ThrowableList, MedList, ArmorList, PerkList);
        CharacterStatsText.GetComponent<Text>().text = " Total Coins: " + Character.coins.ToString() + " Character Value: " + Character.CharacterValue.ToString() + " Spendable Coins: " + Character.SpendableCoins.ToString();
    }

    public void SqlSkonczonyTest(string response, string callbackFunctionName)
    {
        //Ta funkcja zostaje odpalona dopiero gdy web client bedzie miał dane.  
        Debug.Log(response + callbackFunctionName);
        //CharacterCreate();
        if(callbackFunctionName == "CoinsUpdate")
        {
            CharacterCoinsSql = Int32.Parse(response);
        }
        if(callbackFunctionName == "CharacterCreate")
        {
            CharacterJsonSql = response;
            CharacterCreate();
            CharacterGearItemButtonUpdateEvent(); // zaktualizuj UI ekwipunku
        }
        if(callbackFunctionName == "CharacterUpload")
        {
            CharacterDownload();
            CharacterCreate();
        }
    }

    public static void CharacterUpload(string ColumnToUpdate, int idToUpdate)
    {
        string apdejt = "UPDATE uczniowie SET " + ColumnToUpdate + " ='" + idToUpdate + "' WHERE imie = 'Jakub' AND nazwisko = 'Adamus'"; // wysyłanie ucznia na serwer
        SQLQueryClass.SqlQuery("universal_query.php", "login=Jakub&password=Adamus&query=" + apdejt + "", "CharacterUpload");
        //Debug.Log(apdejt);
    }
    public void DrawShop(ShopSelectionEnum ShopSelection)
    {
        foreach (Transform child in ShopContent.transform)
        {
            GameObject.Destroy(child.gameObject);
        }
        int col = 0;
        int row = 0;
        int id = 0;
        switch (ShopSelection)
        {
            case ShopSelectionEnum.primary:
                foreach (Primary i in PrimaryList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.primary;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                    id++;
                }
                break;
            case ShopSelectionEnum.secondary:
                foreach (Secondary i in SecondaryList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.secondary;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                    id++;
                }
                break;
            case ShopSelectionEnum.throwable:
                foreach (Throwable i in ThrowableList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.throwable;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                    id++;
                }
                break;
            case ShopSelectionEnum.mediikit:
                foreach (Med i in MedList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.mediikit;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                    id++;
                }
                break;
            case ShopSelectionEnum.armor:
                foreach (Armor i in ArmorList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.armor;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                    id++;
                }
                break;
            case ShopSelectionEnum.perk:
                foreach (Perk i in PerkList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.perk;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                    id++;
                }
                break;
        }

    }
    public void CreateArmory()
    {
        //Primary
        PrimaryList.Add(new Primary("Empty",0,0, LoadPNG("primary/doll.png")));
        PrimaryList.Add(new Primary("m1a1",50, 10, LoadPNG("primary/doll.png")));
        PrimaryList.Add(new Primary("m16", 70, 10, LoadPNG("primary/doll.png")));
        PrimaryList.Add(new Primary("m14", 80, 10, LoadPNG("primary/doll.png")));

        //Secondary
        SecondaryList.Add(new Secondary("Empty", 0, 0, LoadPNG("primary/doll.png")));
        SecondaryList.Add(new Secondary("glock", 25, 30, LoadPNG("secondary/doll.png")));

        //Throwable
        ThrowableList.Add(new Throwable("Empty", 0, 0, LoadPNG("primary/doll.png")));
        ThrowableList.Add(new Throwable("f1", 24, 90, LoadPNG("throwable/doll.png")));

        //Med
        MedList.Add(new Med("Empty", 0, 0, LoadPNG("primary/doll.png")));
        MedList.Add(new Med("firstaidkit", 25, 30, LoadPNG("med/doll.png")));

        //Armor
        ArmorList.Add(new Armor("Empty", 0, 0, LoadPNG("primary/doll.png")));
        ArmorList.Add(new Armor("BasicArmor", 16, 30, LoadPNG("armor/doll.png")));

        //Perk
        PerkList.Add(new Perk("Empty", 0, 0, LoadPNG("primary/doll.png")));
        PerkList.Add(new Perk("stamina+", 19, 30, LoadPNG("perk/doll.png")));
    }
    public Texture2D LoadPNG(string filePath)
    {
        filePath = Application.dataPath + "/tex/" +filePath;
        Texture2D tex = null;
        byte[] fileData;
        if (File.Exists(filePath))
        {
            fileData = File.ReadAllBytes(filePath);
            tex = new Texture2D(2, 2);
            tex.LoadImage(fileData); //..this will auto-resize the texture dimensions.
        }
        return tex;
    }
}
public class Uczen
{
    public string id;
    public string school;
    public string name1;
    public string name2;
    public string Class;
    public string primary;
    public string secondary;
    public string throwable;
    public string med;
    public string armor;
    public string perk;
    //ekwipunek
    public Primary primary_obj;
    public Secondary secondary_obj;
    public Throwable throwable_obj;
    public Med med_obj;
    public Armor armor_obj;
    public Perk perk_obj;
    //portfel i wrtość ucznia
    public int coins;
    public int CharacterValue=0;
    public int SpendableCoins = 0;
    public Uczen()
    {
    }
    public Uczen(string id, string school, string name1, string name2, string @class, string coins, string primary, string secondary, string throwable, string med, string armor, string perk)
    {
        this.id = id;
        this.school = school;
        this.name1 = name1;
        this.name2 = name2;
        Class = @class;
        this.coins = Int32.Parse(coins);
        this.primary = primary;
        this.secondary = secondary;
        this.throwable = throwable;
        this.med = med;
        this.armor = armor;
        this.perk = perk;
    }
    public void Fill(List<Primary> PriList, List<Secondary> SecList, List<Throwable> ThrList, List<Med> MedList, List<Armor> ArmorList, List<Perk> PerkList)
    {
        this.primary_obj = PriList[int.Parse(primary)];
        this.secondary_obj = SecList[int.Parse(secondary)];
        this.throwable_obj = ThrList[int.Parse(throwable)];
        this.med_obj = MedList[int.Parse(med)];
        this.armor_obj = ArmorList[int.Parse(armor)];
        this.perk_obj = PerkList[int.Parse(perk)];
        this.CharacterValue = primary_obj.price + secondary_obj.price + throwable_obj.price + med_obj.price + armor_obj.price + perk_obj.price;
        this.SpendableCoins = coins - CharacterValue;
        //Debug.Log("Uczen, primary:" + this.primary_obj.name + " secondary: " + this.secondary_obj.name + " throwable: " + this.throwable_obj.name + " med: " + this.med_obj.name + " armor: " + this.armor_obj.name + " perk: " + this.perk_obj.name + " CharacterValue: " + this.CharacterValue+ " coins: "+coins + " spendableCoins: " + SpendableCoins);

    }
}
public class Primary : Item
{
    public Primary(string name, int price, int damage, Texture2D texture)
    {
        this.name = name;
        this.price = price;
        this.damage = damage;
        this.texture = texture;
    }
}
public class Secondary : Item
{
    public Secondary(string name, int price, int damage, Texture2D texture)
    {
        this.name = name;
        this.price = price;
        this.damage = damage;
        this.texture = texture;
    }
}
public class Throwable : Item
{
    public Throwable(string name, int price, int damage, Texture2D texture)
    {
        this.name = name;
        this.price = price;
        this.damage = damage;
        this.texture = texture;
    }
}
public class Med : Item
{
    public Med(string name, int price, int damage, Texture2D texture)
    {
        this.name = name;
        this.price = price;
        this.damage = damage;
        this.texture = texture;
    }
}
public class Armor : Item
{
    public Armor(string name, int price, int damage, Texture2D texture)
    {
        this.name = name;
        this.price = price;
        this.damage = damage;
        this.texture = texture;
    }
}
public class Perk : Item
{
    public Perk(string name, int price, int damage, Texture2D texture)
    {
        this.name = name;
        this.price = price;
        this.damage = damage;
        this.texture = texture;
    }
}
public class Item
{
    public ShopSelectionEnum type;
    public int id;
    public string name;
    public int price;
    public int damage;
    public Texture2D texture;
}
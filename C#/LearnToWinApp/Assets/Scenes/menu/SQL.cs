﻿
using UnityEngine;
using System;
using System.Collections.Generic;
using UnityEngine.UI;
using System.IO;
using System.Linq;

public enum ShopSelectionEnum { primary, secondary, throwable, mediikit, armor, perk };
public class SQL : MonoBehaviour
{
    
    //Eventy
    public static event CharacterGearItemButtonUpdateDelegate CharacterGearItemButtonUpdateEvent; //Ustawia przyciski ekwipunku bohatera po lewej w momencie stworzenia bohatera
    public delegate void CharacterGearItemButtonUpdateDelegate();
    public GameObject ShopItemsParent;
    public static string login = "";
    public static string password = "";
    public static int ShopItemsCount = 0;                                      //Ilość itemów w sklepiku 
    public GameObject ShopItemButtonPrefab;                         //Prefab którym zostanie wyłożony content sklepu na podstawie armory
    public GameObject CharacterStatsText;                           //Tekst statystyk gracza czyli coinsy, spendy i wartość
    public static Uczen Character;                                  //Statyczny obiekt Character.
    public Scrollbar ProcentScrollbar;
    public CharacterGearItemButtonType LastShopSelect = CharacterGearItemButtonType.Primary;
    //Zmienne czekające na uzupełnienie z SQL
    int CharacterCoinsSql = 0;
    public static string CharacterJsonSql = "";
    //Listy zbrojowni
    public List<Primary> PrimaryList = new List<Primary>();         
    public List<Secondary> SecondaryList = new List<Secondary>();
    public List<Throwable> ThrowableList = new List<Throwable>();
    public List<Med> MedList = new List<Med>();
    public List<Armor> ArmorList = new List<Armor>();
    public List<Perk> PerkList = new List<Perk>();
    //Lista Ocen
    public List<Ocena> NoteList = new List<Ocena>();
    public List<string> PrzedmiotList = new List<string>(); // lista przedmiotów
    public List<Chart> ChartList = new List<Chart>();
    public GameObject ChartRoot; // empty który jest początkiem układu charta
    public GameObject ChartCube; // Słupek wykresu
    public GameObject ChartText;

    //Textures
    public Texture2D empty_tex;

    public Texture2D m4a1_tex;
    public Texture2D m16_tex;
    public Texture2D m60_tex;


    public Texture2D mauser_tex;
    public Texture2D spas12_tex;
    public Texture2D gatling_tex;
    public Texture2D barrett_tex;

    public Texture2D colt_tex;
    public Texture2D glock_tex;
    public Texture2D _1911_tex;
    public Texture2D smg_tex;

    public Texture2D f1_tex;
    public Texture2D m67_tex;
    public Texture2D german_tex;
    public Texture2D flash_tex;

    public Texture2D syringe_tex;
    public Texture2D pills_tex;
    public Texture2D firstaid_tex;

    public Texture2D cardboard_tex;
    public Texture2D steel_tex;
    public Texture2D kevlar_tex;
    public Texture2D space_tex;

    public Texture2D stamina_tex;
    public Texture2D strength_tex;
    public Texture2D agility_tex;

    void Start()
    {
        //Przypisania eventów
        SQLQueryClass.ClientSqlCompletedEvent += SqlSkonczonyTest;  //Uruchamia funkcję SqlSkonczonyTest pełną callbacków
        CharacterGearItemButton.ShopSelectButtonPressedEvent += DrawShop;
        CharacterGearItemButton.ShopSelectButtonPressedEvent += LastSelectShopUpdate;
        Login.EnterMenuEvent += SqlClassStart;
        CreateArmory();

    }
    public void SqlClassStart()
    {
        
        GameObject.Find("loading").GetComponent<Text>().enabled = true;
        // Zwykłe funkcje startowe
                                                     // Tworzy listy primarów seconadrów itd i wypełnia je odpowiednimi obiektami                                      
        Invoke("CharacterDownload", 1.5f);                          // Updatuje i pobiera coinsy z serwera, potem pobiera ucznia, robi z niego obiekt i wypełnia ekwipunek z armory
    }
    public void LastSelectShopUpdate(CharacterGearItemButtonType type)
    {
        LastShopSelect = type;
        //Debug.Log("Zmieniam typ na  " + LastShopSelect);
    }
    public void CharacterDownload()
    {
        SQLQueryClass.SqlQuery("coins_update.php", "name1="+login+ "&name2=" + password + "&coinsOrNotes=coins", "CoinsUpdate").Replace(".", ","); // Pobierz ilość monet na podstawie ocen
        SQLQueryClass.SqlQuery("user_create.php", "name1=" + login + "&name2=" + password + "&", "CharacterCreate");
        //NOETES
        SQLQueryClass.SqlQuery("coins_update.php", "name1=" + login + "&name2=" + password + "&coinsOrNotes=notes", "NotesUpdate"); // Pobierz tablicę ocen
    }
    public void CharacterCreate()
    {
        Character = JsonUtility.FromJson<Uczen>(CharacterJsonSql);
        Debug.Log(CharacterJsonSql);
        Character.Fill(PrimaryList, SecondaryList, ThrowableList, MedList, ArmorList, PerkList);
        float Procent = (float)Math.Round(((float)Character.CharacterValue/ (float)Character.coins),2);
        ProcentScrollbar.size = Procent;
        CharacterStatsText.GetComponent<Text>().text = " Total Coins: " + Character.coins.ToString() + Environment.NewLine + " Character Value: " + Character.CharacterValue.ToString() + Environment.NewLine + " Spendable Coins: " + Character.SpendableCoins.ToString() + Environment.NewLine + "Procent wykorzystania postaci: " + Procent*100 + "%";
    }
    public void SqlSkonczonyTest(string response, string callbackFunctionName)
    {
        //Ta funkcja zostaje odpalona dopiero gdy web client bedzie miał dane.  
        if(callbackFunctionName == "CoinsUpdate")
        {
            CharacterCoinsSql = Int32.Parse(response);
        }
        if(callbackFunctionName == "CharacterCreate")
        {
            CharacterJsonSql = response;
            CharacterCreate();
            CharacterGearItemButtonUpdateEvent(); // zaktualizuj UI ekwipunku
            GameObject.Find(LastShopSelect + "Btn").GetComponent<Button>().onClick.Invoke();

        }
        if(callbackFunctionName == "CharacterUpload")
        {
            CharacterDownload();
            CharacterCreate();
            DrawShop(LastShopSelect);
            GameObject.Find(LastShopSelect + "Btn").GetComponent<Button>().onClick.Invoke();
            GameObject.Find("ShopItemsParent").transform.GetChild(0).GetComponent<Button>().onClick.Invoke();


        }
        if(callbackFunctionName== "NotesUpdate")
        {
            NotesUpdate(response);
        }
        
    }
    public void NotesUpdate(string response)
    {
        //Dodać niszczenie wszystkich wykresów, zerowanie list i usuwanie rootów z childrenami 

        string replacedResponse = response.Replace("},{", "}|{").Replace("[", "").Replace("]", "");
        string[] ResponseArray = replacedResponse.Split('|');

        foreach (string a in ResponseArray)
        {
            NoteList.Add(JsonUtility.FromJson<Ocena>(a));
            Debug.Log(a);

        }
        foreach(Ocena o in NoteList)
        {
            if (!PrzedmiotList.Contains(o.type))
            {
                PrzedmiotList.Add(o.type);
                Debug.Log("Dodaję przedmiot: " + o.type);
                ChartList.Add(new Chart(o.type));
            }
        }

        //przeszukaj oceny pod kątem każdego z przedmiotów i zrób z tego x,y + komentarz
        foreach(string przedmiot in PrzedmiotList)
        {
            foreach(Ocena o in NoteList)
            {
                if(o.type==przedmiot)
                {
                    Debug.Log("ocena z przedmiotu: " + przedmiot + " nota: " + o.value + " data: " + o.date);
                }
            }
        }

        foreach(Chart C in ChartList)
        {
            foreach(Ocena o in NoteList)
            {
                if(o.type==C.chartType)
                {
                    C.chartNotes.Add(o);
                }
            }

            Debug.Log("Chart: " + C.chartType);

            foreach(Ocena o in C.chartNotes)
            {
                Debug.Log("Ocena w charcie " + o.value);

                o.data = DateTime.ParseExact(o.date, "yyyy-MM-dd",
                System.Globalization.CultureInfo.InvariantCulture);
                Debug.Log("DATA: " + o.data);
            }
        }

        //na tym etapie mamy obiekty typu Chart o określonym typie, np mat pl fiz itd. Kazdy z tych wykresów ma swoją listę ocen. Teraz wystarczy zrobić reprezentację graficzną tego

        int ChartX = 25;
        foreach(Chart C in ChartList)
        {
            GameObject chartRoot = Instantiate(ChartRoot,new Vector3(ChartX,0,0),Quaternion.Euler(0,0,0));
            chartRoot.name = C.chartType;
            int OcenaX = 0;

            C.chartNotes = C.chartNotes.OrderBy(o => o.date).ToList();
            GameObject ChartName = Instantiate(ChartText, new Vector3(OcenaX + ChartX, 0, 0), Quaternion.Euler(0, 0, 0));
            ChartName.transform.SetParent(chartRoot.transform);
            ChartName.GetComponent<TextMesh>().text = C.chartType;
            foreach (Ocena o in C.chartNotes)
            {
                GameObject Cube = Instantiate(ChartCube, new Vector3(OcenaX+ChartX, float.Parse(o.value.Replace(".", ","))/2.0f, 0), Quaternion.Euler(0, 0, 0));
                Cube.transform.SetParent(chartRoot.transform);
                Cube.name = o.value + " " + o.date;
                GameObject Text = Instantiate(ChartText, new Vector3(OcenaX + ChartX, 0, 0), Quaternion.Euler(0, 0, -90));
                Text.GetComponent<TextMesh>().text = o.data.ToString().Replace("00:00:00", "");
                Text.transform.localScale /= 2.0f;
                Cube.transform.localScale = new Vector3(0.5f, float.Parse(o.value.Replace(".",",")), 0.5f);
                OcenaX += 1;

 
            }
            ChartX += 5;
        }


    }
    public static void CharacterUpload(string ColumnToUpdate, int idToUpdate)
    {
        string apdejt = "UPDATE uczniowie SET " + ColumnToUpdate + " ='" + idToUpdate + "' WHERE name1 = '" + login + "' AND name2 = '" + password + "'"; // wysyłanie ucznia na serwer
        SQLQueryClass.SqlQuery("universal_query.php", "name1=" + login + "&name2=" + password + "&query=" + apdejt + "", "CharacterUpload");
        //Debug.Log(apdejt);
    }
    public void DrawShop(CharacterGearItemButtonType ShopSelection)
    {
        foreach (Transform child in ShopItemsParent.transform)
        {
            GameObject.Destroy(child.gameObject);
        }
        ShopItemsCount = 0;
        int id = 0;
        int spacing = 140;
        switch (ShopSelection)
        {
            case CharacterGearItemButtonType.Primary:
                foreach (Primary i in PrimaryList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopItemsParent.transform);
                    button.transform.localPosition += new Vector3(spacing * ShopItemsCount, 0, 0);
                    //button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.primary;
                    ShopItemsCount++;
                    id++;
                }
                break;
            case CharacterGearItemButtonType.Secondary:
                foreach (Secondary i in SecondaryList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopItemsParent.transform);
                    button.transform.localPosition += new Vector3(spacing * ShopItemsCount, 0, 0);
                    //button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.secondary;
                    ShopItemsCount++;
                    id++;
                }
                break;
            case CharacterGearItemButtonType.Throwable:
                foreach (Throwable i in ThrowableList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopItemsParent.transform);
                    button.transform.localPosition += new Vector3(spacing * ShopItemsCount, 0, 0);
                    //button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.throwable;
                    ShopItemsCount++;
                    id++;
                }
                break;
            case CharacterGearItemButtonType.Med:
                foreach (Med i in MedList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopItemsParent.transform);
                    button.transform.localPosition += new Vector3(spacing * ShopItemsCount, 0, 0);
                    //button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.mediikit;
                    ShopItemsCount++;
                    id++;
                }
                break;
            case CharacterGearItemButtonType.Armor:
                foreach (Armor i in ArmorList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopItemsParent.transform);
                    button.transform.localPosition += new Vector3(spacing * ShopItemsCount, 0, 0);
                    //button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.armor;
                    ShopItemsCount++;
                    id++;
                }
                break;
            case CharacterGearItemButtonType.Perk:
                foreach (Perk i in PerkList)
                {
                    GameObject button = Instantiate(ShopItemButtonPrefab, ShopItemsParent.transform);
                    button.transform.localPosition += new Vector3(spacing * ShopItemsCount, 0, 0);
                    //button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    button.GetComponent<ShopItemButton>().Item.id = id;
                    button.GetComponent<ShopItemButton>().Item.type = ShopSelectionEnum.perk;
                    ShopItemsCount++;
                    id++;
                }
                break;
        }
        
    }
    public void CreateArmory()
    {
        //Primary
        PrimaryList.Add(new Primary("Empty",0,0, empty_tex));
        PrimaryList.Add(new Primary("m4a1",20, 10, m4a1_tex));
        PrimaryList.Add(new Primary("m16", 30, 20, m16_tex));
        PrimaryList.Add(new Primary("m14", 60, 30, m4a1_tex));
        PrimaryList.Add(new Primary("m14", 80, 50, m60_tex));

        PrimaryList.Add(new Primary("mauser", 100, 50, mauser_tex));
        PrimaryList.Add(new Primary("spas12", 120, 60, spas12_tex));
        PrimaryList.Add(new Primary("gatling", 130, 30, gatling_tex));
        PrimaryList.Add(new Primary("barrett", 140, 150, barrett_tex));
        //Secondary
        SecondaryList.Add(new Secondary("Empty", 0, 0, empty_tex));
        SecondaryList.Add(new Secondary("colt", 20, 30, colt_tex));
        SecondaryList.Add(new Secondary("glock", 30, 0, glock_tex));
        SecondaryList.Add(new Secondary("1911", 40, 30, _1911_tex));
        SecondaryList.Add(new Secondary("smg", 50, 0, smg_tex));

        //Throwable
        ThrowableList.Add(new Throwable("Empty", 0, 0, empty_tex));
        ThrowableList.Add(new Throwable("f1", 24, 90, f1_tex));
        ThrowableList.Add(new Throwable("m67", 34, 90, m67_tex));
        ThrowableList.Add(new Throwable("german", 44, 90, german_tex));
        ThrowableList.Add(new Throwable("flash", 54, 90, flash_tex));

        //Med
        MedList.Add(new Med("Empty", 0, 0, empty_tex));
        MedList.Add(new Med("adrenaline", 25, 30, syringe_tex));
        MedList.Add(new Med("grabbingPillsxD", 45, 30, pills_tex));
        MedList.Add(new Med("firstaidkit", 55, 30, firstaid_tex));

        //Armor
        ArmorList.Add(new Armor("Empty", 0, 0, empty_tex));
        ArmorList.Add(new Armor("cardboard", 16, 30, cardboard_tex));
        ArmorList.Add(new Armor("steel", 26, 30, steel_tex));
        ArmorList.Add(new Armor("kevlar", 46, 30, kevlar_tex));
        ArmorList.Add(new Armor("space", 56, 30, space_tex));

        //Perk
        PerkList.Add(new Perk("Empty", 0, 0, empty_tex));
        PerkList.Add(new Perk("stamina", 19, 30, stamina_tex));
        PerkList.Add(new Perk("strength", 29, 30, strength_tex));
        PerkList.Add(new Perk("agility", 49, 30, agility_tex));

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
public class Ocena
{
    public string type = "";
    public string date = "";
    public DateTime data;
    public string value = "";
    public Ocena(string _type, string _date, string _value)
    {
        this.type = _type;
        this.date = _date;
        this.value = _value;



    }
}
public class Chart
{
    public string chartType = "";
    public List<Ocena> chartNotes = new List<Ocena>();

    public Chart(string _chartType)
    {
        this.chartType = _chartType;
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
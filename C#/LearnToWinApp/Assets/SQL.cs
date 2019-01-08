
using UnityEngine;
using System.Web.Script.Serialization;
using System;
using System.Collections.Generic;
using System.Collections;
using UnityEngine.UI;
using System.IO;
using System.Runtime.Serialization.Formatters.Binary;
public class SQL : MonoBehaviour
{
    float TotalCoins = 0;
    float CoinsToSpend = 0;
    public GameObject ShopContent;
    public GameObject ShopButtonPrefab;
    public GameObject CharacterCoins;
    public static Uczen Character;
    public List<Primary> PrimaryList = new List<Primary>();
    public List<Secondary> SecondaryList = new List<Secondary>();
    public List<Throwable> ThrowableList = new List<Throwable>();
    public List<Med> MedList = new List<Med>();
    public List<Armor> ArmorList = new List<Armor>();
    public List<Perk> PerkList = new List<Perk>();

    //Event
    public static event UpdateThingsDelegate UpdateThingsEvent;
    public delegate void UpdateThingsDelegate();

    public Texture2D ahaha;
    void Start()
    {
        CreateArmory();
        CharacterDownload();
        DrawShop(ShopSelectionEnum.primary);
        ShopItemButton.ShopItemButtonPressed += ShopItemButtonPressedHandler;
        ShopSelectButton.ShopSelectButtonPressed += ShopSelectButtonPressedHandler;
        UpdateThingsEvent();
        CharacterCoins.GetComponent<Text>().text = " Total Coins: " + Character.coins.ToString() + " Character Value: "+Character.CharacterValue.ToString() + " Spendable Coins: " + Character.SpendableCoins.ToString();
        //SpriteRenderer renderer;
        //renderer = GetComponent<SpriteRenderer>();
        //Texture2D hehehe = PrimaryList[0].texture;
        //renderer.sprite = Sprite.Create(hehehe, new Rect(0.0f, 0.0f, hehehe.width, hehehe.height), new Vector2(0.5f, 0.5f), 100.0f);

        

    }

    public void DrawShop(ShopSelectionEnum ShopSelection)
    {

        foreach (Transform child in ShopContent.transform)
        {
            GameObject.Destroy(child.gameObject);
        }
        int col = 0;
        int row = 0;
        switch (ShopSelection)
        {
            case ShopSelectionEnum.primary:
                foreach (Primary i in PrimaryList)
                {
                    GameObject button = Instantiate(ShopButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                }
                break;
            case ShopSelectionEnum.secondary:
                foreach (Secondary i in SecondaryList)
                {
                    GameObject button = Instantiate(ShopButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                }
                break;
            case ShopSelectionEnum.throwable:
                foreach (Throwable i in ThrowableList)
                {
                    GameObject button = Instantiate(ShopButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                }
                break;
            case ShopSelectionEnum.mediikit:
                foreach (Med i in MedList)
                {
                    GameObject button = Instantiate(ShopButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                }
                break;
            case ShopSelectionEnum.armor:
                foreach (Armor i in ArmorList)
                {
                    GameObject button = Instantiate(ShopButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                }
                break;
            case ShopSelectionEnum.perk:
                foreach (Perk i in PerkList)
                {
                    GameObject button = Instantiate(ShopButtonPrefab, ShopContent.transform);
                    button.transform.localPosition += new Vector3(70 * col, 70 * row, 0);
                    button.transform.SetParent(ShopContent.transform);
                    button.GetComponent<ShopItemButton>().Item = i;
                    col++;
                    if (col == 3)
                    {
                        col = 0;
                        row--;
                    }
                }
                break;
        }

    }
    public void CharacterDownload()
    {
        TotalCoins = float.Parse(SQLQueryClass.SqlQuery("coins_update.php", "login=Jakub&password=Adamus&").Replace(".", ","));                     // Pobierz ilość monet na podstawie ocen
        var json = SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&");
        Debug.Log(json);
        Character = new JavaScriptSerializer().Deserialize<Uczen>(json);       // pobieranie ucznia z serwera
        Character.Fill(PrimaryList,SecondaryList,ThrowableList,MedList,ArmorList,PerkList);
    }
    public void CharacterUpload()
    {
        string apdejt = "UPDATE uczniowie SET uczen_object ='" + new JavaScriptSerializer().Serialize(Character) + "' WHERE imie = 'Jakub' AND nazwisko = 'Adamus'"; // wysyłanie ucznia na serwer
        SQLQueryClass.SqlQuery("universal_query.php", "login=Jakub&password=Adamus&query=" + apdejt + "");

    }
    public void CreateArmory()
    {
        //Primary
        PrimaryList.Add(new Primary("m1a1",20, 10, LoadPNG("primary/doll.png")));
        PrimaryList.Add(new Primary("m16", 30, 10, LoadPNG("primary/doll.png")));
        PrimaryList.Add(new Primary("m14", 40, 10, LoadPNG("primary/doll.png")));

        //Secondary
        SecondaryList.Add(new Secondary("glock", 25, 30, LoadPNG("secondary/doll.png")));
        ThrowableList.Add(new Throwable("f1", 24, 90, LoadPNG("throwable/doll.png")));
        MedList.Add(new Med("firstaidkit", 25, 30, LoadPNG("med/doll.png")));
        ArmorList.Add(new Armor("BasicArmor", 16, 30, LoadPNG("armor/doll.png")));
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
    public void ShopItemButtonPressedHandler(GameObject button)
    {
        Debug.Log("Wciśnięto przycisk" + button.GetComponent<ShopItemButton>().Item.name);
        
    }
    public void ShopSelectButtonPressedHandler(ShopSelectionEnum typ)
    {
        DrawShop(typ);
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
        Debug.Log("Uczen, primary:" + this.primary_obj.name + " secondary: " + this.secondary_obj.name + " throwable: " + this.throwable_obj.name + " med: " + this.med_obj.name + " armor: " + this.armor_obj.name + " perk: " + this.perk_obj.name + " CharacterValue: " + this.CharacterValue+ " coins: "+coins + " spendableCoins: " + SpendableCoins);
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
    public string name;
    public int price;
    public int damage;
    public Texture2D texture;
}
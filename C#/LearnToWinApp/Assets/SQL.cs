
using UnityEngine;
using System.Web.Script.Serialization;
using System;
using System.Collections.Generic;
public enum ItemType { pistol, rifle, grenade, armor, ammo, medikit, perk };
public class SQL : MonoBehaviour {

    float TotalCoins = 0;
    float CharacterValue = 0;
    float CoinsToSpend = 0;
    public static Uczen Character;
    public static event Delegat SqlFinished;
    public delegate void Delegat(object sender, EventArgs eventargs);

    void Start() {

        //rifles
        Item m4a1 = new Item(ItemType.rifle, 12, "m4a1", "assets/m4a1");
        //pistols
        Item desertEagle = new Item(ItemType.pistol, 32, "desertEagle", "assets/desertEagle");
        //throwable
        Item F1Grenade = new Item(ItemType.grenade, 10, "F1Grenade", "assets/F1Grenade");
        //medikits
        Item FirstAidKit = new Item(ItemType.medikit, 20, "FirstAidKit", "assets/firstAidKit");
        //armors
        Item BasicArmor = new Item(ItemType.armor, 50, "BasicArmor", "assets/BasicArmor");

        //Uczen Character = new Uczen("Jakub", "Adamus", m4a1, desertEagle, F1Grenade, FirstAidKit, BasicArmor, new List<Item>());
        //Character.ItemList.Add(new Item(ItemType.rifle, 20, "aaa", "aaabbb"));
        //Debug.Log(SQLQueryClass.SqlQuery("universal_query.php", "login=Jakub&password=Adamus&query=SELECT * FROM pants UNION SELECT * FROM torso UNION SELECT * FROM helmet")); // pobieranie z wielu tabel jednocześnie * muszą mieć te same ilości kolumn
        //testuczen.ItemList.RemoveAll(s => s.name == "kupa"); // usuwa wszystkie itemy których name to kupa
        //var json = new JavaScriptSerializer().Serialize(Character);
        //Debug.Log(json);


        CharacterDownload();
        CharacterUpload();




    }
    float CalculateCharacterValue(Uczen Character)
    {
        int _CharacterValue = Character.primary.price + Character.secondary.price + Character.throwable.price + Character.medikit.price + Character.armor.price;

        foreach (Item i in Character.ItemList)
        {
            _CharacterValue += i.price;
        }

        return _CharacterValue;

    }
    public void CharacterDownload()
    {

        Character = new JavaScriptSerializer().Deserialize<Uczen>(SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&"));       // pobieranie ucznia z serwera
        TotalCoins = float.Parse(SQLQueryClass.SqlQuery("coins_update.php", "login=Jakub&password=Adamus&").Replace(".", ","));                     // Pobierz ilość monet na podstawie ocen
        CharacterValue = CalculateCharacterValue(Character);                                                                                        //Oblicz wartość postaci
        CoinsToSpend = TotalCoins - CharacterValue;                                                                                                 //Obliczamy dostępne środki

        Debug.Log("Totalna ilość dostępnych coinsów to: " + TotalCoins);
        Debug.Log("Wartość ucznia to: " + CharacterValue);
        Debug.Log("Możesz wydać: " + CoinsToSpend);

        SqlFinished(this, EventArgs.Empty);
    }
    public void CharacterUpload()
    {
        string apdejt = "UPDATE uczniowie SET uczen_object ='" + new JavaScriptSerializer().Serialize(Character) + "' WHERE imie = 'Jakub' AND nazwisko = 'Adamus'"; // wysyłanie ucznia na serwer
        SQLQueryClass.SqlQuery("universal_query.php", "login=Jakub&password=Adamus&query=" + apdejt + "");
    }
    void CharacterAddItem()
    {
        //Character.perk = (new Item(ItemType.perk, 2, "perkxDD", "assets/perklolzz"));
        //Character.ItemList.RemoveAll(s => s.name == "ammo"); // usuwa wszystkie itemy których name to kupa
    }
    void Update()
    {
        if(Input.GetKeyDown(KeyCode.Alpha1))
        {
            CharacterDownload();
        }
        if (Input.GetKeyDown(KeyCode.Alpha2))
        {
            CharacterUpload();
        }
        if(Input.GetKeyDown(KeyCode.Alpha3))
        {
            CharacterAddItem();
        }
    }
}



public class Uczen
{
    public string imie;
    public string nazwisko;

    //ekwipunek
    public Item primary;
    public Item secondary;
    public Item throwable;
    public Item medikit;
    public Item armor;
    public Item perk;

    public List<Item> ItemList;

    public Uczen()
    {

    }

    public Uczen(string imie, string nazwisko, Item primary, Item secondary, Item throwable, Item medikit, Item armor, Item perk, List<Item> itemList)
    {
        this.imie = imie;
        this.nazwisko = nazwisko;
        this.primary = primary;
        this.secondary = secondary;
        this.throwable = throwable;
        this.medikit = medikit;
        this.armor = armor;
        this.perk = perk;
        ItemList = itemList;
    }
}
public class Item
{
    public ItemType type;
    public int price;
    public string name;
    public string thumbnail;

    public Item()
    {

    }
    public Item(ItemType type, int price, string name, string thumbnail)
    {
        this.type = type;
        this.price = price;
        this.name = name;
        this.thumbnail = thumbnail;
    }
}



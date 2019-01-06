
using UnityEngine;
using System.Web.Script.Serialization;
using System;
using System.Collections.Generic;

public class SQL : MonoBehaviour {

    void Start() {

        //rifles
        Item m4a1 = new Item(ItemType.rifle, 120, "m4a1", "assets/m4a1");
        //pistols
        Item desertEagle = new Item(ItemType.pistol, 60, "desertEagle", "assets/desertEagle");
        //throwable
        Item F1Grenade = new Item(ItemType.grenade, 70, "F1Grenade", "assets/F1Grenade");
        //medikits
        Item FirstAidKit = new Item(ItemType.medikit, 20, "FirstAidKit", "assets/firstAidKit");
        //armors
        Item BasicArmor = new Item(ItemType.armor, 40, "BasicArmor", "assets/BasicArmor");

        //Uczen Character = new Uczen("Jakub", "Adamus", m4a1, desertEagle, F1Grenade, FirstAidKit, BasicArmor, new List<Item>());
        //Character.ItemList.Add(new Item(ItemType.rifle, 20, "aaa", "aaabbb"));


        //var json = new JavaScriptSerializer().Serialize(Character);
        //Debug.Log(json);

        
        Uczen testuczen = new JavaScriptSerializer().Deserialize<Uczen>(SQLQueryClass.SqlQuery("user_create.php", "login=Jakub&password=Adamus&")); // pobieranie ucznia z serwera

        //Debug.Log(testuczen.primary.price+=10); // jakaś operacja zmiany na uczniu

        int wartoscUcznia = testuczen.primary.price + testuczen.secondary.price + testuczen.throwable.price + testuczen.medikit.price + testuczen.armor.price;

        foreach(Item i in testuczen.ItemList)
        {
            wartoscUcznia += i.price;
        }

        Debug.Log("Wartość ucznia to: " + wartoscUcznia);
        //Debug.Log(SQLQueryClass.SqlQuery("universal_query.php", "login=Jakub&password=Adamus&query=SELECT * FROM pants UNION SELECT * FROM torso UNION SELECT * FROM helmet")); // pobieranie z wielu tabel jednocześnie * muszą mieć te same ilości kolumn

        string apdejt = "UPDATE uczniowie SET uczen_object ='" + new JavaScriptSerializer().Serialize(testuczen) + "' WHERE imie = 'Jakub' AND nazwisko = 'Adamus'"; // wysyłanie ucznia na serwer

        Debug.Log(SQLQueryClass.SqlQuery("universal_query.php", "login=Jakub&password=Adamus&query="+apdejt+""));


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

    public List<Item> ItemList;

    public Uczen()
    {

    }
    public Uczen(string imie, string nazwisko, Item primary, Item secondary, Item throwable, Item medikit, Item armor, List<Item> itemList)
    {
        this.imie = imie;
        this.nazwisko = nazwisko;
        this.primary = primary;
        this.secondary = secondary;
        this.throwable = throwable;
        this.medikit = medikit;
        this.armor = armor;
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

public enum ItemType {pistol, rifle, grenade, armor, ammo, medikit};
